<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="overflow-y: auto; overflow-x: hidden">
    <div class="app-brand demo">
        <a href="#" class="navbar-brand d-flex align-items-center gap-3 ">
            <img src="{{ asset('storage/img/logo.png') }}" class="img-fluid" width="70" alt="">
            <p class="m-0 p-0 text-dark fw-bold fs-5 text-primary">Dashboard</p>
        </a>
        <a class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            {{-- <i class="bx bx-chevron-left bx-sm align-middle"></i> --}}
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Dashboard</span>
        </li>
        <li
            class="menu-item {{ Route::CurrentRouteName() == 'jneawbcenter' || Route::CurrentRouteName() == 'create' ? 'active' : '' }}">
            <a href="{{ route('jneawbcenter') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-plane-alt"></i>
                <div data-i18n="JNE Awb Center">JNE Awb Center</div>
            </a>
        </li>
        @if (auth()->user()->role == 'A')
            <li class="menu-item {{ Route::CurrentRouteName() == 'pameran' ? 'active' : '' }}">
                <a href="{{ route('pameran') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-food-menu"></i>
                    <div data-i18n="Pameran">Pameran</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Data</span>
            </li>
            <li class="menu-item {{ Route::CurrentRouteName() == 'product' ? 'active' : '' }}">
                <a href="{{ route('product') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-cart"></i>
                    <div data-i18n="Product">Product</div>
                </a>
            </li>
            <li class="menu-item {{ Route::CurrentRouteName() == 'payment' ? 'active' : '' }}">
                <a href="{{ route('payment') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-wallet"></i>
                    <div data-i18n="Metode Pembayaran">Metode Pembayaran</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Home Page</span>
            </li>
            <li class="menu-item {{ Route::CurrentRouteName() == 'aboutus' ? 'active' : '' }}">
                <a href="{{ route('aboutus') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-info-circle"></i>
                    <div data-i18n="About Us">About Us</div>
                </a>
            </li>
            <li class="menu-item {{ Route::CurrentRouteName() == 'storelocations' ? 'active' : '' }}">
                <a href="{{ route('storelocations') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-store-alt"></i>
                    <div data-i18n="Store Locations">Store Locations</div>
                </a>
            </li>
            <li class="menu-item {{ Route::CurrentRouteName() == 'brands' ? 'active' : '' }}">
                <a href="{{ route('brands') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-package"></i>
                    <div data-i18n="Brands">Brands</div>
                </a>
            </li>
            <li class="menu-item {{ Route::CurrentRouteName() == 'otherlinks' ? 'active' : '' }}">
                <a href="{{ route('otherlinks') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-link"></i>
                    <div data-i18n="Other Links">Other Links</div>
                </a>
            </li>
            <li class="menu-item {{ Route::CurrentRouteName() == 'events' ? 'active' : '' }}">
                <a href="{{ route('events') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-calendar"></i>
                    <div data-i18n="Exhibitions">Exhibitions</div>
                </a>
            </li>
        @endif
    </ul>
</aside>
<!-- / Menu -->
