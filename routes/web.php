<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Frontend\BikeController;
use App\Http\Controllers\Frontend\BlogPostController;
use App\Http\Controllers\Frontend\Brandscontroller;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewCarsController;
use App\Http\Controllers\Frontend\ScootersController;
use App\Http\Controllers\Frontend\SubCategoryController;
use App\Http\Controllers\Frontend\VideoController;
use App\Http\Controllers\Frontend\NewsReviewController;
use App\Http\Controllers\Frontend\OtpController;
use App\Http\Controllers\Frontend\ProductController;

use App\Models\Brands;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\VehicleController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache-all', function () {
    // Clear route cache
    Artisan::call('route:clear');
    
    // Clear config cache
    Artisan::call('config:clear');
    
    // Clear application cache
    Artisan::call('cache:clear');
    
    // Optional: Clear view cache if needed
    Artisan::call('view:clear');

    return "All caches cleared!";
});
// Backend
Route::middleware('authadminlogin')->group(function(){
    Route::get('/admin',[AdminController::class, 'login'])->name('login');
    Route::post('/admin',[AdminController::class, 'adminLogin'])->name('admin-login');
    Route::get('/admin/forget-password', [AdminController::class, 'forgetPassword'])->name('forgetpassword');
    Route::post('/admin/forget-password', [AdminController::class, 'forgetPasswordSubmit'])->name('forgetpasswordsubmit');
    Route::get('/admin/reset-password/{token}', [AdminController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/admin/reset-password', [AdminController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

Route::middleware('auth')->group(function(){
    Route::middleware('superadmin')->group(function(){
        Route::get('/admin/register',[AdminController::class, 'register'])->name('register');
        Route::post('/admin/register', [AdminController::class, 'adminRegister'])->name('admin-register');
        Route::get('/admin/register/{id}', [AdminController::class, 'deleteRegister'])->name('delete-register');
    });

    Route::get('/admin/dashboard',[AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/logout',[AdminController::class, 'logout'])->name('logout');

    Route::get('/admin/category',[AdminController::class, 'category'])->name('add-category');
    Route::post('/admin/category',[AdminController::class, 'storeCategory'])->name('store-category');
    Route::get('/admin/manage-category',[AdminController::class,'manageCategory'])->name('manage-category');
    Route::post('/admin/category/sub-category',[AdminController::class, 'storeSubCategory'])->name('store-sub-category');
    Route::get('/admin/category/sub-category/edit/{id}',[AdminController::class,'editSubCategory'])->name('edit-subcategory');
    Route::post('/admin/category/update/{id}',[AdminController::class,'updateCategory'])->name('update-category');
    Route::post('/admin/category/sub-category/update/{id}',[AdminController::class,'updateSubCategory'])->name('update-subcategory');
    Route::get('/admin/category/delete/{id}',[AdminController::class,'deleteCategory'])->name('delete-category');
    Route::get('/admin/sub-category/delete/{id}',[AdminController::class,'deletesubCategory'])->name('delete-subcategory');

    Route::get('/admin/add-pages',[AdminController::class, 'addPages'])->name('add-pages');
    Route::post('/admin/add-pages',[AdminController::class, 'storePages'])->name('store-pages');
    Route::get('/admin/manage-pages',[AdminController::class, 'managePages'])->name('manage-pages');
    Route::get('/admin/manage-pages/edit/{id}',[AdminController::class,'editPages'])->name('edit-pages');
    Route::post('/admin/manage-pages/update/{id}',[AdminController::class,'updatePages'])->name('update-pages');
    Route::get('/admin/manage-pages/delete/{id}',[AdminController::class,'deletePages'])->name('delete-pages');

    Route::get('/admin/add-banner',[AdminController::class,'addBanner'])->name('add-banner');
    Route::post('/admin/add-banner',[AdminController::class,'storeBanner'])->name('store-banner');
    Route::get('/admin/manage-banner',[AdminController::class,'manageBanner'])->name('manage-banner');
    Route::get('/admin/manage-banner/edit/{id}',[AdminController::class,'editBanner'])->name('edit-banner');
    Route::post('/admin/manage-banner/update/{id}',[AdminController::class,'updateBanner'])->name('update-banner');
    Route::get('/admin/manage-banner/delete/{id}',[AdminController::class,'deleteBanner'])->name('delete-banner');
    Route::get('/admin/manage-banner/status/{id}/{status}',[AdminController::class,'statusBanner'])->name('status-banner');

    Route::get('/admin/add-brands',[AdminController::class,'addBrands'])->name('add-brands');
    Route::post('/admin/add-brands',[AdminController::class,'storeBrands'])->name('store-brands');
    Route::get('/admin/manage-brands',[AdminController::class,'manageBrands'])->name('manage-brands');
    Route::get('/admin/manage-brands/edit/{id}',[AdminController::class,'editBrands'])->name('edit-brands');
    Route::post('/admin/manage-brands/update/{id}',[AdminController::class,'updateBrands'])->name('update-brands');
    Route::get('/admin/manage-brands/delete/{id}',[AdminController::class,'deleteBrands'])->name('delete-brands');
    Route::get('/admin/manage-brands/status/{id}/{status}',[AdminController::class,'statusBrands'])->name('status-brands');

    Route::get('/admin/add-product',[AdminController::class,'addProduct'])->name('add-product');
    Route::post('/admin/add-product',[AdminController::class,'storeProduct'])->name('store-product');
    Route::get('/admin/manage-product',[AdminController::class,'manageProduct'])->name('manage-product');
    Route::get('/admin/manage-product/edit/{id}',[AdminController::class,'editProduct'])->name('edit-product');
    Route::post('/admin/manage-product/update/{id}',[AdminController::class,'updateProduct'])->name('update-product');
    Route::get('/admin/manage-product/delete/{id}',[AdminController::class,'deleteProduct'])->name('delete-product');
    Route::get('/admin/manage-product/status/{id}/{status}',[AdminController::class,'statusProduct'])->name('status-product');

    Route::get('/admin/add-news-reviews',[AdminController::class,'addNewsReviews'])->name('add-news-reviews');
    Route::post('/admin/add-news-reviews',[AdminController::class,'storeNewsReviews'])->name('store-news-reviews');
    Route::get('/admin/manage-news-reviews',[AdminController::class,'manageNewsReviews'])->name('manage-news-reviews');
    Route::get('/admin/manage-news-reviews/edit/{id}',[AdminController::class,'editNewsReviews'])->name('edit-news-reviews');
    Route::post('/admin/manage-news-reviews/update/{id}',[AdminController::class,'updateNewsReviews'])->name('update-news-reviews');
    Route::get('/admin/manage-news-reviews/delete/{id}',[AdminController::class,'deleteNewsReviews'])->name('delete-news-reviews');
    Route::get('/admin/manage-news-reviews/status/{id}/{status}',[AdminController::class,'statusNewsReviews'])->name('status-news-reviews');

    Route::get('/admin/add-faq',[AdminController::class,'addFaq'])->name('add-faq');
    Route::post('/admin/add-faq',[AdminController::class,'storeFaq'])->name('store-faq');
    Route::get('/admin/manage-faq',[AdminController::class,'manageFaq'])->name('manage-faq');
    Route::get('/admin/manage-faq/edit/{id}',[AdminController::class,'editFaq'])->name('edit-faq');
    Route::post('/admin/manage-faq/update/{id}',[AdminController::class,'updateFaq'])->name('update-faq');
    Route::get('/admin/manage-faq/delete/{id}',[AdminController::class,'deleteFaq'])->name('delete-faq');
    Route::get('/admin/manage-faq/status/{id}/{status}',[AdminController::class,'statusFaq'])->name('status-faq');

    Route::get('/admin/add-video',[AdminController::class,'addVideo'])->name('add-video');
    Route::post('/admin/add-video',[AdminController::class,'storeVideo'])->name('store-video');
    Route::get('/admin/manage-video',[AdminController::class,'manageVideo'])->name('manage-video');
    Route::get('/admin/manage-video/edit/{id}',[AdminController::class,'editVideo'])->name('edit-video');
    Route::post('/admin/manage-video/update/{id}',[AdminController::class,'updateVideo'])->name('update-video');
    Route::get('/admin/manage-video/delete/{id}',[AdminController::class,'deleteVideo'])->name('delete-video');
    Route::get('/admin/manage-video/status/{id}/{status}',[AdminController::class,'statusVideo'])->name('status-video');
    
    Route::match(['GET','POST'], '/admin/global', [AdminController::class, 'global'])->name('global');
    Route::get('/admin/global/delete-header-logo/{id}', [AdminController::class, 'deleteHeaderLogo'])->name('delete-header-logo');
    Route::get('/admin/global/delete-favicon/{id}', [AdminController::class, 'deleteFavicon'])->name('delete-favicon');
    Route::get('/admin/global/delete-footer-logo/{id}', [AdminController::class, 'deleteFooterLogo'])->name('delete-footer-logo');

    Route::get('/admin/user-register',[AdminController::class,'userRegister'])->name('user-register');
    Route::get('/admin/visitor',[AdminController::class,'visitor'])->name('visitor');
    
});

// frontend
Route::middleware(['track.visitors'])->group(function () {
    
            Route::post('/search/vehicle', [VehicleController::class, 'searchProduct'])->name('search.product');
            Route::get('/', [HomeController::class, 'homePage'])->name('homepage');
            Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
            Route::get('/news/{slug}', [NewsReviewController::class, 'newsReviewPage'])->name('news-reviews-pages');
            Route::get('/news/{page_name}/{slug}', [NewsReviewController::class, 'newsDetails'])->name('news-details');
            Route::get('/videos', [VideoController::class, 'videos'])->name('videos');
            Route::get('/videos/{slug}', [VideoController::class, 'videosDetail'])->name('videos-detail');
            Route::get('/up', [WebsiteController::class, 'bringWebsiteUp']);
            Route::get('/down', [WebsiteController::class, 'takeWebsiteDown']);
            Route::get('/compare/{product_url1}/{product_url2}', [CompareController::class, 'compare'])->name('compare');
            Route::get('find-{category}', [productController::class, 'findProduct'])->name('findProduct');
            
             ///Search
             Route::get('autocomplete', [HomeController::class, 'autocomplete'])->name('autocomplete'); 
             Route::get('search', [HomeController::class, 'search'])->name('search'); 
             Route::get('products/{product_name}', [HomeController::class, 'show'])->name('products.show');
             
             
             

            Route::group([], function () {
                $categories = Category::get();
                if($categories){
                    foreach ($categories as $category) {
                        if ($category->page_type == 1) {
                            Route::get('/{slug}', function ($slug) use ($category) {
                                $categoryFound = Category::where('slug', $slug)->where('page_type', 1)->first();
                                if ($categoryFound) {
                                    return app(CategoryController::class)->CategoryPage($slug);
                                }
                                return app(SubCategoryController::class)->subCategoryPage($slug);
                            })->name('category-' . $category->slug);
                        }
                        
                        if ($category->page_type == 2) {
                            Route::get('/{slug}', function ($slug) use ($category) {
                                $subcategoryFound = Category::where('slug', $slug)->where('page_type', 2)->first();
                                if ($subcategoryFound) {
                                    return app(SubCategoryController::class)->subCategoryPage($slug);
                                }
                                return app(CategoryController::class)->CategoryPage($slug);
                            })->name('subcategory-' . $category->slug);
                        }
                    }
                }
            });
            

            Route::post('/generate/generate-otp', [OtpController::class, 'generateOtp'])->name('generate.otp');
            Route::post('/verify/verify-otp', [OtpController::class, 'verifyOtp'])->name('verify.otp');
            Route::post('/users/register', [OtpController::class, 'usersRegister'])->name('users.register');
            Route::post('/users/login', [OtpController::class, 'usersLogin'])->name('users.login');
            Route::post('/users/logout', [OtpController::class, 'logoutAllUser'])->name('users.logout');
            Route::get('/{category}/brands', [Brandscontroller::class, 'brands'])->name('brands');
            Route::get('/{category}/{slug}', [Brandscontroller::class, 'brandsProduct'])->name('brands-brand-product');
            Route::get('/{slug}/{brands_url}/{product_url}', [ProductController::class, 'productDetail'])->name('product-detail');     
            
        });
        
        
       

?>

