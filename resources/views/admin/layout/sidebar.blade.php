
<style>
    .nav-link.active {
    background: rgba(255,255,255,.1) !important;
    color: #fff !important;
}
</style>
<?php
    use Illuminate\Support\Facades\Auth; // Ensure correct import
    $user = Auth::user()->type_role;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('dashboard')}}" class="brand-link">
        <img src="{{asset('backend/img/AdminLTELogo.png')}}" alt="Car And Bike" class="brand-image"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Car And Bike</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('add-category', 'manage-category') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Category
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('add-category')}}" class="nav-link {{ request()->routeIs('add-category') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manage-category')}}" class="nav-link {{ request()->routeIs('manage-category') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Manage Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('add-pages', 'manage-pages') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Pages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('add-pages')}}" class="nav-link {{ request()->routeIs('add-pages') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Add Pages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manage-pages')}}" class="nav-link {{ request()->routeIs('manage-pages') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Manage Pages</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('add-banner', 'manage-banner') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Banner
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('add-banner')}}" class="nav-link {{ request()->routeIs('add-banner') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Add Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manage-banner')}}" class="nav-link {{ request()->routeIs('manage-banner') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Manage Banner</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('add-brands', 'manage-brands') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                           Brands
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('add-brands')}}" class="nav-link {{ request()->routeIs('add-brands') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Add Brands</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manage-brands')}}" class="nav-link {{ request()->routeIs('manage-brands') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Manage Brands</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('add-product', 'manage-product') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                           Product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('add-product')}}" class="nav-link {{ request()->routeIs('add-product') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manage-product')}}" class="nav-link {{ request()->routeIs('manage-product') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Manage Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('add-faq', 'manage-faq') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                           FAQ
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('add-faq')}}" class="nav-link {{ request()->routeIs('add-faq') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Add FAQ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manage-faq')}}" class="nav-link {{ request()->routeIs('manage-faq') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Manage FAQ</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('add-video', 'manage-video') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                           Video
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('add-video')}}" class="nav-link {{ request()->routeIs('add-video') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Add Video</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manage-video')}}" class="nav-link {{ request()->routeIs('manage-video') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Manage Video</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ request()->routeIs('add-news-reviews', 'manage-news-reviews') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                           News & Reviews
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('add-news-reviews')}}" class="nav-link {{ request()->routeIs('add-news-reviews') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Add News & Reviews</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('manage-news-reviews')}}" class="nav-link {{ request()->routeIs('manage-news-reviews') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Manage News & Reviews</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('global')}}" class="nav-link {{ request()->routeIs('global') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Global</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('user-register')}}" class="nav-link {{ request()->routeIs('user-register') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>User Registered</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('visitor')}}" class="nav-link {{ request()->routeIs('visitor') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Visitor</p>
                    </a>
                </li>


                @if ($user == 0)
                    <li class="nav-item">
                        <a href="{{route('register')}}" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Add admin</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link">
                        <i class=" nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>



            </ul>
        </nav>

    </div>

</aside>
