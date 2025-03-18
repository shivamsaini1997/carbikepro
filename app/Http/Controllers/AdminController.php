<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AllUser;
use App\Models\Banner;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Faq;
use App\Models\GlobalSetting;
use App\Models\NewsDetails;
use App\Models\NewsReviewPages;
use App\Models\Pages;
use App\Models\Product;
use App\Models\User;
use App\Models\Video;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\returnSelf;

class AdminController extends Controller
{
    public function login(){
        return view('admin.login');
    }
    public function adminLogin(Request $request): RedirectResponse{
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin/dashboard')->with('success', 'You have successfully logged in.');
        }
        return redirect("/admin")->with('error', 'Oops! You have entered invalid credentials.');
    }
    public function register(){
        $register = User::get();
        $data = compact('register');
        // dd( $data);
        return view('admin.register')->with($data);
    }

    public function adminRegister(Request $request){
        // Validate incoming data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:250',
            'email' => 'required|string|email|max:250|unique:users,email', // Corrected table name to 'users'
            'password' => 'required|min:8',
            'password-confir' => 'required|same:password',
            'role_type' => 'required|in:1,2', // Adjust roles as per your logic
        ]);

        // Create new admin user
        $admin = User::create([
            'name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'type_role' => $validatedData['role_type'],
        ]);

        return redirect()->route('admin-register')->with('success', 'Admin successfully registered');
    }

    public function deleteRegister($id){
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Prevent deletion if the user ID is less than 2
        if ($user->id < 2) {

            return redirect()->back()->with('error', 'Super Admin cannot be deleted');
        }

        // Delete the user if the ID is 2 or greater
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
    public function forgetPassword(){
        return view('admin.forgetPassword');
    }
    public function forgetPasswordSubmit(Request $request){
        $request->validate([
            'email' => 'email|required|exists:admin',
        ]);

        $token = Str::random(64);
        $url = route('reset.password.get',encrypt($request->email));
        // dd($url);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.reset_password_email', ['url' => $url], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('success', 'We have e-mailed your password reset link!');

    }
    public function showResetPasswordForm($email) {
        // dd(decrypt($email));
        $data['email']=decrypt($email);
        return view('auth.forgetPasswordLink',$data);
    }
    public function submitResetPasswordForm(Request $request){
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);


        return redirect('/admin')->with('success', 'Your password has been changed!');
    }
    public function logout(Request $request): RedirectResponse{
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();

        return redirect('/admin')->with('success', 'You have successfully logged out.');
    }

    public function dashboard(){
        $userregister = AllUser::get();
        $product = Product::get();
        $brands = Brands::get();
        $visitorCount = Visitor::count();
        
        // dd($visitorCount);
        $data = compact('userregister','product','brands','visitorCount');
        return view('admin.Dashboard.dashboard')->with($data);
    }

    public function addBanner(){
        $category = Category::get();
        $title = "Add Banner";
        $url = url("/admin/add-banner");
        $data = compact('title', 'url','category');
        return view('admin.Banner.add-banner')->with($data);
    }
    public function manageBanner(){
        $category = Category::get();
        $banner_page_name = Banner::get();
        $banner = Banner::orderBy('created_at', 'desc')->paginate(6);
        $data = compact('banner' ,'category','banner_page_name');
        // dd($data);
        return view('admin.Banner.manage-banner')->with($data);
    }
    public function storeBanner(Request $request) {
        $banner = new Banner();
        $request->validate([
            'pages_name' => 'required|string',
            'banner_url' => 'url|nullable',
            'banner' => 'required|image|mimes:jpg,jpeg,webp|max:200',
        ], [
            'pages_name.required' => 'The page name is required.',
            'pages_name.string' => 'The page name must be a valid string.',
            'banner_url.url' => 'The banner URL must be a valid URL.',
            'banner.required' => 'Please upload a banner.',
            'banner.image' => 'The banner must be an image file.',
            'banner.mimes' => 'Only JPG, webp files are allowed.',
            'banner.max' => 'The banner image must not exceed 200KB.',
        ]);

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');

            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/banners'), $fileName);
            $banner->banner = 'uploads/banners/' . $fileName;

            $banner->pages_name = $request->input('pages_name');
            $banner->banner_url = $request->input('banner_url');
            $banner->save();
        }

        return redirect()->route('manage-banner')->with('success', 'Banner uploaded successfully.');
    }
    public function editbanner($id){
        $category = Category::get();
        $banner = Banner::find($id);
        $title = "Manage Banner";
        $url = url('/admin/manage-banner/update') . "/" . $id;
        $data = compact('banner' , 'title' , 'url','category');
        // dd($data);
        return view('admin.Banner.add-banner')->with($data);
    }
    public function updateBanner(Request $request, $id){
        $banner = Banner::find($id);
        $request->validate([
            'pages_name' => 'required|string',
            'banner_url' => 'url|nullable',
            'banner' => 'image|mimes:jpg,jpeg,webp|max:200',
        ], [
            'pages_name.required' => 'The page name is required.',
            'pages_name.string' => 'The page name must be a valid string.',
            'banner_url.url' => 'The banner URL must be a valid URL.',
            'banner.required' => 'Please upload a banner.',
            'banner.image' => 'The banner must be an image file.',
            'banner.mimes' => 'Only JPG, webp files are allowed.',
            'banner.max' => 'The banner image must not exceed 200KB.',
        ]);

        if ($request->hasFile('banner')) {
            if ($banner->banner && file_exists(public_path($banner->banner))) {
                unlink(public_path($banner->banner));
            }
            $file = $request->file('banner');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/banners'), $fileName);
            $banner->banner = 'uploads/banners/' . $fileName;
        }

        $banner->pages_name = $request->input('pages_name');
        $banner->banner_url = $request->input('banner_url');
        $banner->save();
        return redirect('/admin/manage-banner')->with('success', 'Banner updated successfully.');
    }
    public function deleteBanner($id){
        $banner = Banner::find($id);
        if ($banner->banner && file_exists(public_path($banner->banner))) {
            unlink(public_path($banner->banner));
        }
        $banner->delete();
        return back();
    }
    public function statusBanner($id, $status){
        $banner = Banner::find($id);
        $banner->status = $status;
        $banner->save();
        return back();
    }

    public function category(){
        $category = Category::get();
        $title = "Add Category / Subcategory";
        $url1 = "/admin/category";
        $url2 = "/admin/category/sub-category";
        $data = compact('category','title','url1','url2');
        return view('admin.Category.category')->with($data);
    }
    public function manageCategory(){
        $category = Category::get();
        $data = compact('category');
        return view('admin.Category.manage-category')->with($data);
    }
    public function storeCategory(Request $request){
        $category = new Category();
        $request->validate([
            'category' => 'required|string|unique:category',
            'slug' => 'required|unique:category,slug',
           
        ], [
            'category.required' => 'Please enter a category name.',
            'category.string' => 'The category name must be a string.',
            'category.unique' => 'This category already exists.',
            'slug.required' => 'Please enter a slug for the category.',
            'slug.unique' => 'The slug must be unique, please choose another one.',
        ]);
        $category->category = $request->input('category');
        $category->slug = $request->input('slug');
        $category->save();
        return redirect()->route('manage-category')->with('success', 'Category Added Successfully');
    }
    public function updateCategory(Request $request, $id){
        $category = Category::find($id);
        $request->validate([
            'category' => 'required|string',
            'slug' => 'required',
        ]);
        $category->category = $request->input('category');
        $category->slug = $request->input('slug');
        $category->save();
        return redirect()->route('manage-category')->with('success', 'Category  Updated Successfully');
    }
    public function storeSubCategory(Request $request){
        $request->validate([
            'parent_id' => 'required|exists:category,id',
            'scategory' => 'required|string|max:255',
            'page_type' => 'required|string', // This checks if page_type is selected
            'sub_category_slug' => 'required|string|max:255|unique:category,slug',
            'meta_description' => 'required|string',
            'meta_tags' => 'required|string',
        ], [
            'parent_id.required' => 'Please select a category.',
            'parent_id.exists' => 'The selected category is invalid.',
            'scategory.required' => 'Please enter a sub category name.',
            'scategory.string' => 'The sub category name must be a string.',
            'page_type.required' => 'Please select a page type.', // This will show if no page type is selected
            'sub_category_slug.required' => 'Please enter a slug for the sub category.',
            'sub_category_slug.unique' => 'The slug must be unique, please choose another one.',
        ]);

        // Creating a new sub-category
        $category = new Category();
        $category->parent_id = $request->input('parent_id');
        $category->category = $request->input('scategory');
        $category->slug = $request->input('sub_category_slug');
        $category->page_type = $request->input('page_type');
        $category->meta_description = $request->input('meta_description');
        $category->meta_tags = $request->input('meta_tags');
        $category->save();

        // Redirect with success message
        return redirect()->route('manage-category')->with('success', 'Sub Category Added Successfully');
    }
    public function updateSubCategory(Request $request,$id){
        $request->validate([
            'parent_id' => 'required',
            'scategory' => 'nullable|string|max:255',
            'page_type' => 'required|string', // This checks if page_type is selected
            'sub_category_slug' => 'required|string',
            'meta_description' => 'required|string',
            'meta_tags' => 'required|string',
        ]);

        // Creating a new sub-category
        $category =  Category::find($id);
        $category->parent_id = $request->input('parent_id');
        $category->category = $request->input('scategory');
        $category->slug = $request->input('sub_category_slug');
        $category->page_type = $request->input('page_type');
        $category->meta_description = $request->input('meta_description');
        $category->meta_tags = $request->input('meta_tags');
        $category->save();
        // Redirect with success message
        return redirect()->route('manage-category')->with('success', 'Sub Category Updated Successfully');
    }
    public function editSubCategory($id) {
        $category = Category::all();  // Fetch all categories
        $singelcategoryes = Category::findOrFail($id);  // Use findOrFail to handle invalid IDs
        $title = "Edit Category / Subcategory";
        $url1 = "/admin/category/update/{$id}";
        $url2 = "/admin/category/sub-category/update/{$id}";
        // dd($singelcategoryes);
        return view('admin.Category.category', compact('category', 'singelcategoryes', 'title', 'url1','url2'));
    }
    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        return back();
    }
    public function deleteSubCategory($id){
        $subcategory = Category::find($id);
        $categoryName = $subcategory->category;
        $pages = Pages::where('pages_name', $categoryName)->get();
        $banners = Banner::where('pages_name', $categoryName)->get();
        if (!$subcategory) {
            return back()->with('error', 'sub category not found.');
        }
        if ($pages->isNotEmpty()) {
            foreach ($pages as $page) {
                $page->delete();
            }
        }
        if ($banners->isNotEmpty()) {
            foreach ($banners as $banner) {
                $banner->delete();
                if ($banner->banner && file_exists(public_path($banner->banner))) {
                    unlink(public_path($banner->banner));
                }
            }
        }
        $subcategory->delete();
        return back()->with('success', 'Sub Category and associated Pages deleted successfully.');
    }

    public function addPages(){
        $category = Category::get();
        $title = "Add Pages";
        $url = "/admin/add-pages";
        $data = compact('category','title','url');
        return view('admin.Pages.add-pages')->with($data);
    }
    public function storePages(Request $request){
        $request->validate([
            'pages_name' => 'required|string|unique:pages,pages_name',
            'slug' => 'required|string',
            'page_detail' => 'required|string',
        ], [
            'pages_name.required' => 'The page name field is required.',
            'pages_name.string'   => 'The page name must be a string.',
            'pages_name.unique'   => 'The page name has already been taken.',
            'page_detail.required' => 'The page detail is required.',
            'page_detail.string'   => 'The page detail must be a string.',
        ]);
        $pages = new Pages();
        $pages->pages_name = $request->input('pages_name');
        $pages->slug = $request->input('slug');
        $pages->page_detail = $request->input('page_detail');
        $pages->save();
        return redirect()->route('manage-pages')->with('success', 'Page details added successfully');
    }
    public function editPages($id){
        $category = Category::get();
        $pages = Pages::find($id);
        $title = "Edit Pages";
        $url = "/admin/manage-pages/update" . "/" . $id;
        $data = compact('category','pages','title','url');
        return view('admin.Pages.add-pages')->with($data);
    }
    public function managePages(){
        $pages = Pages::orderBy('created_at', 'desc')->paginate(6);
        $data = compact('pages');
        // dd($pages);
        return view('admin.Pages.manage-pages')->with($data);
    }
    public function updatePages(Request $request, $id){
        $pages = Pages::find($id);
        $request->validate([
            'pages_name' => 'required|string',
            'slug' => 'required|string',
            'page_detail' => 'required|string',
        ], [
            'pages_name.required' => 'The page name field is required.',
            'pages_name.string'   => 'The page name must be a string.',
            'pages_name.unique'   => 'The page name has already been taken.',
            'page_detail.required' => 'The page detail is required.',
            'page_detail.string'   => 'The page detail must be a string.',
        ]);

        // Create new Pages instance and save
        $pages->pages_name = $request->input('pages_name');
        $pages->slug = $request->input('slug');
        $pages->page_detail = $request->input('page_detail');
        $pages->save();
        return redirect('/admin/manage-pages')->with('success', 'Page details updated successfully');
    }
    public function deletePages($id){
        $pages = Pages::find($id);
        $pages->delete();
        return back();
    }

    public function addBrands(){
        $category = Category::get();
        $title = "Add Brands";
        $url = url('/admin/add-brands');
        $data = compact('title' , 'url','category');
        return view('admin.Brands.add-brands')->with($data);
    }
    public function storeBrands(Request $request){
        $brands = new Brands();
        $request->validate([
            'category' => 'required|string',
            'brands_image' => 'required|image|mimes:jpg,jpeg,webp|max:200',
            'brands_name' => 'required|string',
            'brands_url' => 'required|string',
            'brand_page_detail' => 'required|string',
            'meta_description' => 'required|string',
            'meta_tags' => 'required|string',
        ], [
            'category.required' => 'The category type is required.',
            'category.string' => 'The brand type must be a valid string.',

            'brands_image.required' => 'The brand image is required.',
            'brands_image.image' => 'The file must be an image.',
            'brands_image.mimes' => 'Only JPG, JPEG, and WEBP formats are allowed for the image.',
            'brands_image.max' => 'The image size must not exceed 200KB.',

            'brands_name.required' => 'The brand name is required.',
            'brands_name.string' => 'The brand name must be a valid string.',

            'brands_url.required' => 'The brand URL is required.',
            'brands_url.string' => 'The brand URL must be a valid string.',
        ]);

        if ($request->hasFile('brands_image')) {
            $file = $request->file('brands_image');
            $fileName = time() . '_brands.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/brands'), $fileName);
            $brands->brands_image = 'uploads/brands/' . $fileName;
        }
        $brands->category = $request->input('category');
        $brands->brands_name = $request->input('brands_name');
        $brands->brands_url = $request->input('brands_url');
        $brands->brands_details = $request->input('brand_page_detail');
        $brands->meta_description = $request->input('meta_description');
        $brands->meta_tags = $request->input('meta_tags');
        $brands->save();
        return redirect('/admin/manage-brands')->with('success', 'Brand added successfully.');
    }
    public function manageBrands(){

        $brands = Brands::orderBy('created_at', 'desc')->paginate(6);
        $data = compact('brands');
        return view('admin.Brands.manage-brands')->with($data);
    }
    public function editBrands($id){
        $category = Category::get();
        $brands = Brands::find($id);
        $title = "Edit Brands";
        $url = url('/admin/manage-brands/update') . "/" . $id;
        $data = compact('title' , 'url','category','brands');
        // dd($data);
        return view('admin.Brands.add-brands')->with($data);
    }
    public function updateBrands(Request $request, $id){
        $brands =  Brands::find($id);
        $request->validate([
            'category' => 'required|string',
            'brands_image' => 'image|mimes:jpg,jpeg,webp|max:200',
            'brands_name' => 'required|string',
            'brands_url' => 'required|string',
            'brand_page_detail' => 'required|string',
            'meta_description' => 'required|string',
            'meta_tags' => 'required|string',
        ], [
            'category.required' => 'The category type is required.',
            'category.string' => 'The brand type must be a valid string.',

            'brands_image.required' => 'The brand image is required.',
            'brands_image.image' => 'The file must be an image.',
            'brands_image.mimes' => 'Only JPG, JPEG, and WEBP formats are allowed for the image.',
            'brands_image.max' => 'The image size must not exceed 200KB.',

            'brands_name.required' => 'The brand name is required.',
            'brands_name.string' => 'The brand name must be a valid string.',

            'brands_url.required' => 'The brand URL is required.',
            'brands_url.string' => 'The brand URL must be a valid string.',
        ]);

        if ($request->hasFile('brands_image')) {
            $file = $request->file('brands_image');
            $fileName = time() . '_brands.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/brands'), $fileName);
            $brands->brands_image = 'uploads/brands/' . $fileName;
        }
        $brands->category = $request->input('category');
        $brands->brands_name = $request->input('brands_name');
        $brands->brands_url = $request->input('brands_url');
        $brands->brands_details = $request->input('brand_page_detail');
        $brands->meta_description = $request->input('meta_description');
        $brands->meta_tags = $request->input('meta_tags');
        $brands->save();
        return redirect('/admin/manage-brands')->with('success', 'Brand Updated successfully.');
    }
    public function statusBrands($id, $status){
        $brands =  Brands::find($id);
        $brands->status = $status;
        $brands->save();
        return back();
    }
    public function deleteBrands($id){
        $brands =  Brands::find($id);
        $brands->delete();
        return back();
    }

    public function addNewsReviews(){
        $brands = Brands::get();
        $category = Category::get();
        $newspages = NewsReviewPages::get();
        $product =  Product::get();

        $title = "Add News and Reviews";
        $url = url('/admin/add-news-reviews');
        $data = compact('newspages','title','url','brands','category','product');
        // dd($data);   
        return view('admin.NewsReview.add-news-reviews')->with($data);
    }
    public function storeNewsReviews(Request $request){
        $request->validate([
            'news_page' => 'required|string',
            'category' =>  'nullable|string|required_if:news_page,Product News',
            'brands' =>  'nullable|string|required_if:news_page,Product News',
            'product_name' =>  'nullable|string|required_if:news_page,Product News',
            'news_image' => 'required|image|mimes:jpg,jpeg,webp|max:200',
            'title' => 'required|string',
            'slug' => 'required|string',
            'news_details' => 'required|string',
            'meta_description' => 'required|string',
            'meta_tags' => 'required|string',
        ], [
            'news_page.required' => 'Please enter the news page name.',
            'news_page.string' => 'The news page name must be a valid string.',
            'news_image.required' => 'Please upload an image for the news.',
            'news_image.image' => 'The file must be an image.',
            'news_image.mimes' => 'The image must be a file of type: jpg, jpeg, or webp.',
            'news_image.max' => 'The image must not be larger than 200 KB.',
            'title.required' => 'Please enter a title for the news.',
            'title.string' => 'The title must be a valid string.',
            'slug.required' => 'Please enter a slug for the news.',
            'slug.string' => 'The slug must be a valid string.',
            'news_details.required' => 'Please provide the news details.',
            'news_details.string' => 'The news details must be a valid string.',
        ]);

        $newsdetail = new NewsDetails();
        $newsdetail->news_page = $request->input('news_page');
        $newsdetail->category = $request->input('category');
        $newsdetail->brands = $request->input('brands');
        $newsdetail->product_name = $request->input('product_name');
        $newsdetail->meta_description = $request->input('meta_description');
        $newsdetail->meta_tags = $request->input('meta_tags');
        if ($request->hasFile('news_image')) {
            $file = $request->file('news_image');
            $fileName = time() . '_news' . $file->getClientOriginalName();
            $file->move(public_path('uploads/news/'), $fileName);
            $newsdetail->news_image = 'uploads/news/' . $fileName;
        }
        $newsdetail->title = $request->input('title');
        $newsdetail->slug = $request->input('slug');
        $newsdetail->news_details = $request->input('news_details');
        $newsdetail->save();
        return redirect()->route('add-news-reviews')->with('success', 'News details added successfully');
    }
    public function manageNewsReviews(){
        $newsdetail = NewsDetails::orderBy('created_at', 'desc')->paginate(6);
        $data = compact('newsdetail');
        return view('admin.NewsReview.manage-news-reviews')->with($data);
    }
    public function editNewsReviews($id){
        $newsreview = NewsDetails::find($id);
        $newspages = NewsReviewPages::get();
        $product =  Product::get();
        $brands = Brands::get();
        $category = Category::get();
        $title = "Edit News Review";
        $url = url('/admin/manage-news-reviews/update/') . "/" . $id;
        $data = compact('newsreview','title','url','newspages','product','brands','category');
        // dd($newsreview);
        return view('admin.NewsReview.add-news-reviews')->with($data);
    }
    public function updateNewsReviews(Request $request, $id){
        $request->validate([
            'news_page' => 'required|string',
            'category' =>  'nullable|string|required_if:news_page,Product News',
            'brands' =>  'nullable|string|required_if:news_page,Product News',
            'product_name' =>  'nullable|string|required_if:news_page,Product News',
            'news_image' => 'image|mimes:jpg,jpeg,webp|max:200',
            'title' => 'required|string',
            'slug' => 'required|string',
            'news_details' => 'required|string',
            'meta_description' => 'required|string',
            'meta_tags' => 'required|string',
        ], [
            'news_page.required' => 'Please enter the news page name.',
            'news_page.string' => 'The news page name must be a valid string.',
            'news_image.image' => 'The file must be an image.',
            'news_image.mimes' => 'The image must be a file of type: jpg, jpeg, or webp.',
            'news_image.max' => 'The image must not be larger than 200 KB.',
            'title.required' => 'Please enter a title for the news.',
            'title.string' => 'The title must be a valid string.',
            'slug.required' => 'Please enter a slug for the news.',
            'slug.string' => 'The slug must be a valid string.',
            'news_details.required' => 'Please provide the news details.',
            'news_details.string' => 'The news details must be a valid string.',
        ]);

        $newsdetail =  NewsDetails::find($id);
        $newsdetail->news_page = $request->input('news_page');
        $newsdetail->category = $request->input('category');
        $newsdetail->brands = $request->input('brands');
        $newsdetail->product_name = $request->input('product_name');
        $newsdetail->meta_description = $request->input('meta_description');
        $newsdetail->meta_tags = $request->input('meta_tags');
        if ($request->hasFile('news_image')) {
            $file = $request->file('news_image');
            $fileName = time() . '_news' . $file->getClientOriginalName();
            $file->move(public_path('uploads/news/'), $fileName);
            $newsdetail->news_image = 'uploads/news/' . $fileName;
        }
        $newsdetail->title = $request->input('title');
        $newsdetail->slug = $request->input('slug');
        $newsdetail->news_details = $request->input('news_details');
        $newsdetail->save();
        return redirect()->route('manage-news-reviews')->with('success', 'News details updated successfully');
    }
    public function statusNewsReviews($id,$status){
        $newsreview = NewsDetails::find($id);
        $newsreview->status = $status;
        $newsreview->save();
        return back();
    }
    public function deleteNewsReviews($id){
        $newsreview = NewsDetails::find($id);
        $newsreview->delete();
        return back();
    }

    public function addProduct(){
        $brands = Brands::get();
        $category = Category::get();
        $title = "Add Product";
        $url = url('/admin/add-product');
        $data = compact('brands','category','title','url');
        // dd($data);
        return view('admin.Product.add-product')->with($data);
    }
    public function storeProduct(Request $request){
        $product = new Product();
        $request->validate([
            'category' => 'required|string',
            'electric_sub_category' => 'nullable|string|required_if:category,Electric',
            'brands' => 'required|string',
            'pages_name' => 'required|string',
            'product_label' => 'nullable|string',
            'product_name' => 'required|string',
            'product_url' => 'required|string',
            'showroom_price' => 'required|string',
            'on_road_price' => 'required|string',
            'emi' => 'required|string',
            'productimage1' => 'required|image|mimes:jpg,jpeg,webp|max:500',
            'productimage2' => 'required|image|mimes:jpg,jpeg,webp|max:500',
            'productimage3' => 'required|image|mimes:jpg,jpeg,webp|max:500',
            'productimage4' => 'required|image|mimes:jpg,jpeg,webp|max:500',
            'productimage5' => 'image|mimes:jpg,jpeg,webp|max:500',
            'productimage6' => 'image|mimes:jpg,jpeg,webp|max:500',
            'productimage7' => 'image|mimes:jpg,jpeg,webp|max:500',
            'productimage8' => 'image|mimes:jpg,jpeg,webp|max:500',
            'body_types' => 'nullable|string',
            'color' => 'nullable|string',
            'mileage' => 'nullable|string',
            'displacement' => 'nullable|string',
            'fule-tank-capacity' => 'nullable|string',
            'kerb-weight' => 'nullable|string',
            'height' => 'nullable|string',
            'top-speed' => 'nullable|string',
            'engine' => 'nullable|string',
            'fuel-type' => 'nullable|string',
            'transmission-type' => 'nullable|string',
            'seating-capacity' => 'nullable|string',
            'safety' => 'nullable|string',
            'driving-range' => 'nullable|string',
            'charging-time' => 'nullable|string',
            'highlights' => 'required|string',
            'meta_tags' => 'required|string',
            'meta_description' => 'required|string',
        ]
        , [
            'category.required' => 'The category field is required.',
            'electric_sub_category.required_if' => 'The electric sub-category field is required when the category is Electric.',
            'brands.required' => 'The brand field is required.',
            'pages_name.required' => 'The page name field is required.',
            'product_name.required' => 'The product name field is required.',
            'product_url.required' => 'The product URL field is required.',
            'showroom_price.required' => 'The showroom price field is required.',
            'on_road_price.required' => 'The on-road price field is required.',
            'productimage1.required' => 'Product image 1 is required.',
            'productimage1.image' => 'Product image 1 must be an image file.',
            'productimage1.mimes' => 'Product image 1 must be a file of type: jpg, jpeg, webp.',
            'productimage1.max' => 'Product image 1 must not be greater than 200 KB.',
            'highlights.required' => 'The highlights field is required.',
        ]);
        $product->category = $request->input('category');
        $product->brands = $request->input('brands');
        $product->ev_sub_category = $request->input('electric_sub_category');
        $product->pages_name = $request->input('pages_name');
        $product->product_label = $request->input('product_label');
        $product->product_name = $request->input('product_name');
        $product->product_url = $request->input('product_url');
        $product->showroom_price = $request->input('showroom_price');
        $product->on_road_price = $request->input('on_road_price');
        $product->emi = $request->input('emi');
        if($request->hasFile('productimage1')){
            $file = $request->file('productimage1');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage1 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage2')){
            $file = $request->file('productimage2');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage2 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage3')){
            $file = $request->file('productimage3');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage3 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage4')){
            $file = $request->file('productimage4');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage4 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage5')){
            $file = $request->file('productimage5');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage5 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage6')){
            $file = $request->file('productimage6');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage6 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage7')){
            $file = $request->file('productimage7');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage7 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage8')){
            $file = $request->file('productimage8');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage8 = 'uploads/productimage/' . $fileName;
        }

        $product->body_types = $request->input('body_types');
        $product->color = $request->input('color');
        $product->mileage = $request->input('mileage');
        $product->displacement = $request->input('displacement');
        $product->fule_tank_capacity = $request->input('fule-tank-capacity');
        $product->kerb_weight = $request->input('kerb-weight');
        $product->height = $request->input('height');
        $product->top_speed = $request->input('top-speed');
        $product->engine = $request->input('engine');
        $product->fuel_type = $request->input('fuel-type');
        $product->transmission_type = $request->input('transmission-type');
        $product->seating_capacity = $request->input('seating-capacity');
        $product->safety = $request->input('safety');
        $product->driving_range = $request->input('driving-range');
        $product->charging_time = $request->input('charging-time');
        $product->highlights = $request->input('highlights');
        $product->meta_tags = $request->input('meta_tags');
        $product->meta_description = $request->input('meta_description');
        $product->save();
        return redirect()->route('manage-product')->with('success', 'New Product added successfully');
    }
    public function updateProduct(Request $request, $id){
        $product =  Product::find($id);
        $request->validate([
            'category' => 'required|string',
            'electric_sub_category' => 'nullable|string|required_if:category,Electric',
            'brands' => 'required|string',
            'pages_name' => 'required|string',
            'product_label' => 'nullable|string',
            'product_name' => 'required|string',
            'product_url' => 'required|string',
            'showroom_price' => 'required|string',
            'on_road_price' => 'required|string',
            'emi' => 'required|string',
            'productimage1' => 'nullable|image|mimes:jpg,jpeg,webp|max:500',
            'productimage2' => 'nullable|image|mimes:jpg,jpeg,webp|max:500',
            'productimage3' => 'nullable|image|mimes:jpg,jpeg,webp|max:500',
            'productimage4' => 'nullable|image|mimes:jpg,jpeg,webp|max:500',
            'productimage5' => 'nullable|image|mimes:jpg,jpeg,webp|max:500',
            'productimage6' => 'nullable|image|mimes:jpg,jpeg,webp|max:500',
            'productimage7' => 'nullable|image|mimes:jpg,jpeg,webp|max:500',
            'productimage8' => 'nullable|image|mimes:jpg,jpeg,webp|max:500',
            'body_types' => 'nullable|string',
            'color' => 'nullable|string',
            'mileage' => 'nullable|string',
            'displacement' => 'nullable|string',
            'fule-tank-capacity' => 'nullable|string',
            'kerb-weight' => 'nullable|string',
            'height' => 'nullable|string',
            'top-speed' => 'nullable|string',
            'engine' => 'nullable|string',
            'fuel-type' => 'nullable|string',
            'transmission-type' => 'nullable|string',
            'seating-capacity' => 'nullable|string',
            'safety' => 'nullable|string',
            'driving-range' => 'nullable|string',
            'charging-time' => 'nullable|string',
            'highlights' => 'required|string',
            'meta_tags' => 'required|string',
            'meta_description' => 'required|string',
        ], [
            'category.required' => 'The category field is required.',
            'electric_sub_category.required_if' => 'The electric sub-category field is required when the category is Electric.',
            'brands.required' => 'The brand field is required.',
            'pages_name.required' => 'The page name field is required.',
            'product_name.required' => 'The product name field is required.',
            'product_url.required' => 'The product URL field is required.',
            'showroom_price.required' => 'The showroom price field is required.',
            'on_road_price.required' => 'The on-road price field is required.',
            'productimage1.required' => 'Product image 1 is required.',
            'productimage1.image' => 'Product image 1 must be an image file.',
            'productimage1.mimes' => 'Product image 1 must be a file of type: jpg, jpeg, webp.',
            'productimage1.max' => 'Product image 1 must not be greater than 200 KB.',
            'highlights.required' => 'The highlights field is required.',
        ]);
        $product->category = $request->input('category');
        $product->brands = $request->input('brands');
        $product->ev_sub_category = $request->input('electric_sub_category');
        $product->pages_name = $request->input('pages_name');
        $product->product_label = $request->input('product_label');
        $product->product_name = $request->input('product_name');
        $product->product_url = $request->input('product_url');
        $product->showroom_price = $request->input('showroom_price');
        $product->on_road_price = $request->input('on_road_price');
        $product->emi = $request->input('emi');
        if($request->hasFile('productimage1')){
            $file = $request->file('productimage1');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage1 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage2')){
            $file = $request->file('productimage2');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage2 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage3')){
            $file = $request->file('productimage3');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage3 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage4')){
            $file = $request->file('productimage4');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage4 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage5')){
            $file = $request->file('productimage5');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage5 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage6')){
            $file = $request->file('productimage6');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage6 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage7')){
            $file = $request->file('productimage7');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage7 = 'uploads/productimage/' . $fileName;
        }
        if($request->hasFile('productimage8')){
            $file = $request->file('productimage8');
            $fileName = time() . '_product' . $file->getClientOriginalName();
            $file->move(public_path('uploads/productimage'), $fileName);
            $product->productimage8 = 'uploads/productimage/' . $fileName;
        }
        $product->body_types = $request->input('body_types');
        $product->color = $request->input('color');
        $product->mileage = $request->input('mileage');
        $product->displacement = $request->input('displacement');
        $product->fule_tank_capacity = $request->input('fule-tank-capacity');
        $product->kerb_weight = $request->input('kerb-weight');
        $product->height = $request->input('height');
        $product->top_speed = $request->input('top-speed');
        $product->engine = $request->input('engine');
        $product->fuel_type = $request->input('fuel-type');
        $product->transmission_type = $request->input('transmission-type');
        $product->seating_capacity = $request->input('seating-capacity');
        $product->safety = $request->input('safety');
        $product->driving_range = $request->input('driving-range');
        $product->charging_time = $request->input('charging-time');
        $product->highlights = $request->input('highlights');
        $product->meta_tags = $request->input('meta_tags');
        $product->meta_description = $request->input('meta_description');
        $product->save();
        return redirect()->route('manage-product')->with('success', ' Product updated successfully');
    }
    public function editProduct($id){
        $product =  Product::find($id);
        $brands = Brands::get();
        $category = Category::get();
        $title = "Edit Product";
        $url = url('/admin/manage-product/update'). "/" . $id;
        $data = compact('product', 'title' , 'url','brands','category');
        // dd($data);

        return view('admin.Product.add-product')->with($data);
    }
    public function manageProduct(){
        $product =  Product::orderBy('created_at', 'desc')->paginate(5);
        // dd($product);
        $data = compact('product');
        return view('admin.Product.manage-product')->with($data);
    }
    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
        return back();
    }
    public function statusProduct($id,$status){
        $product =  Product::find($id);
        $product->status = $status;
        $product->save();
        return back();
    }

    public function addFaq(){
        $product = Product::get();

        $title = "Add FAQ";
        $url = url('/admin/add-faq');
        $data = compact('title','url','product');
        return view('admin.Faq.add-faq')->with($data);
    }
    public function storeFaq(Request $request){
        $request->validate([
            'product' => 'required|string',
            'faq_questions' => 'required|array|min:1',
            'faq_questions.*' => 'required|string',
            'faq_answer' => 'required|array|min:1',
            'faq_answer.*' => 'required|string',
        ]);
    
        foreach ($request->faq_questions as $key => $question) {
                $faq = new Faq();
                $faq->product = $request->input('product');
                $faq->faq_questions = $question;
                $faq->faq_answer = $request->faq_answer[$key];
                $faq->save();
        }
        return redirect()->route('manage-faq')->with('success', 'FAQs added successfully!');
    }   
    public function manageFaq(){
        $product = Product::get();
        $faq = Faq::orderBy('created_at', 'desc')->paginate(5);
        $data = compact('faq','product');
        // dd($data);
        return view('admin.Faq.manage-faq')->with($data);
    }
    public function statusFaq($id, $status){
        $faq = Faq::find($id);
        $faq->status = $status;
        $faq->save();
        return back();
    }
    public function deleteFaq($id){
        $faq = Faq::find($id);
        $faq->delete();
        return back();
    }
    public function editFaq($id){
        $faq = Faq::find($id);
        $product = Product::get();

        $title = "Edit FAQ";
        $url = url('/admin/manage-faq/update'). "/" . $id;
        $data = compact('title' , 'url','faq','product');
        return view('admin.Faq.add-faq')->with($data);

    }
    public function updateFaq(Request $request, $id){
        $request->validate([
            'product' => 'required|string',
            'faq_questions' => 'required|array|min:1',
            'faq_questions.*' => 'required|string',
            'faq_answer' => 'required|array|min:1',
            'faq_answer.*' => 'required|string',
        ]);
    
        foreach ($request->faq_questions as $key => $question) {
                $faq =  Faq::find($id);
                $faq->product = $request->input('product');
                $faq->faq_questions = $question;
                $faq->faq_answer = $request->faq_answer[$key];
                $faq->save();
        }
        return redirect()->back()->with('success', 'FAQs updated successfully!');
    }

    public function addVideo(){
        $title = 'Add Video';
        $product = Product::get();
        $url = url('/admin/add-video');
        $data = compact('title','url','product');
        return view('admin.Video.add-video')->with($data);
    }
    public function storevideo(Request $request){
        $video = new Video();
        $request->validate([
            'product' => 'required|string|max:255',
            'wheeler' => 'required|string|max:255',
            'video_thanmbnail' => 'required|image|mimes:jpg,jpeg,webp|max:2048', 
            'video_url' => 'required|url', 
            'video_title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'channelslug' => 'required|string|max:255', 
        ], [
            'product.required' => 'The product field is required.',
            'product.string' => 'The product must be a valid string.',
            'product.max' => 'The product must not exceed 255 characters.',
            
            'wheeler.required' => 'The wheeler field is required.',
            'wheeler.string' => 'The wheeler must be a valid string.',
            'wheeler.max' => 'The wheeler must not exceed 255 characters.',
            
            'video_thanmbnail.required' => 'The video thumbnail is required.',
            'video_thanmbnail.image' => 'The video thumbnail must be an image file.',
            'video_thanmbnail.mimes' => 'The video thumbnail must be a file of type: jpg, jpeg,webp.',
            'video_thanmbnail.max' => 'The video thumbnail must not exceed 2MB.',
            
            'video_url.required' => 'The video URL is required.',
            'video_url.url' => 'The video URL must be a valid URL.',
            
            'video_title.required' => 'The video title is required.',
            'video_title.string' => 'The video title must be a valid string.',
            'video_title.max' => 'The video title must not exceed 255 characters.',
            
            'slug.required' => 'The slug is required.',
            'slug.string' => 'The slug must be a valid string.',
            'slug.regex' => 'The slug can only contain lowercase letters, numbers, and hyphens.',
            'slug.max' => 'The slug must not exceed 255 characters.',
            
            'channelslug.required' => 'The channel slug is required.',
            'channelslug.string' => 'The channel slug must be a valid string.',
            'channelslug.regex' => 'The channel slug can only contain lowercase letters, numbers, and hyphens.',
            'channelslug.max' => 'The channel slug must not exceed 255 characters.',
        ]);
        $video->product = $request->input('product');
        $video->wheeler = $request->input('wheeler');
        if($request->hasFile('video_thanmbnail')){
            $file = $request->file('video_thanmbnail');
            $fileName = time() . '_thambnail' . $file->getClientOriginalName();
            $file->move(public_path('uploads/video_thambnail'), $fileName);
            $video->video_thanmbnail = 'uploads/video_thambnail/' . $fileName;
        }

        $video->video_url = $request->input('video_url');
        $video->video_title = $request->input('video_title');
        $video->slug = $request->input('slug');
        $video->channelslug = $request->input('channelslug');
        $video->save();
        return redirect()->route('manage-video')->with('success', 'Video added successfully!');
    }
    public function manageVideo(){
        $product = Product::get();
        $video = video::orderBy('created_at', 'desc')->paginate(5);
        $data = compact('video','product');
        // dd($data);
        return view('admin.Video.manage-video')->with($data);
    }
    public function statusVideo($id, $status){
        $video = video::find($id);
        $video->status = $status;
        $video->save();
        return back();
    }
    public function deleteVideo($id){
        $video = video::find($id);
        $video->delete();
        return back();
    }

    public function global(Request $request){
        $data_id = $request->data_id;
        if ($request->isMethod('GET')) {
            $global = GlobalSetting::first();
            $data = compact('global');
            // dd($data);
            return view('admin.Global.global')->with($data);
        } else {
            // Validation rules
            $request->validate([
                'header_logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'favicon' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'footer_logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'instagram_link' => 'required|url',
                'youtube_link' => 'required|url',
                'facebook_link' => 'required|url',
                'linkedin_link' => 'required|url',
                'phone' => 'required|numeric|digits:10',
                'email' => 'required|email',
                'office_address' => 'required|string|max:255'
            ], [
                'phone.digits' => 'The phone number must be exactly 10 digits.',
                'email.email' => 'Please provide a valid email address.',
                'header_logo.mimes' => 'Header logo must be a file of type: jpeg, png, jpg, gif, svg.',
                'favicon.mimes' => 'Favicon must be a file of type: jpeg, png, jpg, gif, svg.',
                'footer_logo.mimes' => 'Footer logo must be a file of type: jpeg, png, jpg, gif, svg.'
            ]);

            // Fetch existing global settings or create a new instance
            $global = $data_id ? GlobalSetting::find($data_id) : new GlobalSetting();

              // Handle file uploads
            if ($request->hasFile('header_logo')) {
                $file = $request->file('header_logo');
                $filename = time() . '_header.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload'), $filename);
                $global->headerlogo = 'upload/' . $filename;
            }

            if ($request->hasFile('favicon')) {
                $file = $request->file('favicon');
                $filename = time() . '_favicon.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload'), $filename);
                $global->favicon = 'upload/' . $filename;
            }

            if ($request->hasFile('footer_logo')) {
                $file = $request->file('footer_logo');
                $filename = time() . '_footer.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload'), $filename);
                $global->footerlogo = 'upload/' . $filename;
            }

            // Assign other fields
            $global->instagramlink = $request->input('instagram_link');
            $global->youtubelink = $request->input('youtube_link');
            $global->facebooklink = $request->input('facebook_link');
            $global->linkedinlink = $request->input('linkedin_link');
            $global->phone = $request->input('phone');
            $global->email = $request->input('email');
            $global->address = $request->input('office_address');
            // Save the global settings
            if($global->save()){

                return redirect()->back()->with('success', 'Global settings updated successfully.');
            }

        }
    }
    public function deleteHeaderLogo($id) {
        $globalSetting = GlobalSetting::find($id);
        if ($globalSetting->headerlogo) {
            Storage::delete($globalSetting->headerlogo);
            $globalSetting->headerlogo = null;
            $globalSetting->save();
        }
        return redirect()->back()->with('success', 'Header logo deleted successfully.');
    }
    public function deleteFavicon($id) {
        $globalSetting = GlobalSetting::find($id);
        if ($globalSetting->favicon) {
            Storage::delete($globalSetting->favicon);
            $globalSetting->favicon = null;
            $globalSetting->save();
        }
        return redirect()->back()->with('success', 'Favicon deleted successfully.');
    }
    public function deleteFooterLogo($id) {
        $globalSetting = GlobalSetting::find($id);
        if ($globalSetting->footerlogo) {
            Storage::delete($globalSetting->footerlogo);
            $globalSetting->footerlogo = null;
            $globalSetting->save();
        }
        return redirect()->back()->with('success', 'Footer logo deleted successfully.');
    }

    public function userRegister(){
        $userregister = AllUser::orderBy('created_at', 'desc')->paginate(5);
        $data = compact('userregister');
        return view('admin.UserRegister.user_register')->with($data);
    }

    public function visitor(Request $request){
        $todayVisitors = Visitor::whereDate('created_at', Carbon::today())->count();
        $yesterdayVisitors = Visitor::whereDate('created_at', Carbon::yesterday())->count();
        $weekVisitors = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $monthVisitors = Visitor::whereMonth('created_at', Carbon::now()->month)->count();

        // Aggregate monthly visitors
        $monthlyVisitors = Visitor::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'asc')
        ->get();

        // Aggregate yearly visitors
        $yearlyVisitors = Visitor::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('year')
        ->orderBy('year', 'desc')
        ->get();

        // Get available years for filtering
        $years = $yearlyVisitors->pluck('year')->toArray();

        return view('admin.Visitors.visitors', compact(
            'todayVisitors', 
            'yesterdayVisitors', 
            'weekVisitors', 
            'monthVisitors', 
            'monthlyVisitors', 
            'yearlyVisitors',
            'years' // Pass the years array for the filter
        ));
    }
}
