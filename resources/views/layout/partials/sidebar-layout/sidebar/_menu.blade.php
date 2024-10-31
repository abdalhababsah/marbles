<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
         data-kt-scroll-activate="true" data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
         data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->


        <div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu"
             data-kt-menu="true" data-kt-menu-expand="false">

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}">
                    <span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
                    <span class="menu-title">Dashboards</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('user-management.users.*') ? 'active' : '' }}"
                   href="{{ route('user-management.users.index') }}">
                    <span class="menu-icon">{!! getIcon('user', 'fs-2') !!}</span>
                    <span class="menu-title">User</span>
                </a>
            </div>

            <div data-kt-menu-trigger="click"
                 class="menu-item menu-accordion {{ request()->routeIs('catalog.*') ? 'here show' : '' }}">
                <span class="menu-link">
					<span class="menu-icon">{!! getIcon('lots-shopping', 'fs-2') !!}</span>
					<span class="menu-title">Catalog</span>
					<span class="menu-arrow"></span>
				</span>

                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('catalog.products.*') ? 'active' : '' }}"
                           href="{{ route('catalog.products.index') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Products</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('catalog.variant-types.*') ? 'active' : '' }}"
                           href="{{ route('catalog.variant-types.index') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Variants</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('catalog.categories.*') ? 'active' : '' }}"
                           href="{{ route('catalog.categories.index') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">categories</span>
                        </a>
                    </div>

                </div>
            </div>
            <div data-kt-menu-trigger="click"
                 class="menu-item menu-accordion {{ request()->routeIs('home.*') ? 'here show' : '' }}">
                <span class="menu-link">
					<span class="menu-icon">{!! getIcon('lots-shopping', 'fs-2') !!}</span>
					<span class="menu-title">Home Page</span>
					<span class="menu-arrow"></span>
				</span>

                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('home.home-images.*') ? 'active' : '' }}"
                           href="{{ route('home.home-images.index') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">Home Images</span>
                        </a>
                    </div>
                    <!-- Add Variant Type Menu Item Here -->

                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('home.about-us.*') ? 'active' : '' }}"
                           href="{{ route('home.about-us.index') }}">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
                            <span class="menu-title">About Us</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ request()->routeIs('home.contact-us.*') ? 'active' : '' }}"
                           href="{{ route('home.contact-us.index') }}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Contact</span>
                        </a>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
