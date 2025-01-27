<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>

                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>


                <a class="nav-link" href="{{ route('menuitem.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                    menuitems
                </a>

                <a class="nav-link" href="{{ route('ingredient.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Ingredients
                </a>

                <a class="nav-link" href="{{ route('table.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    tables
                </a>

                <a class="nav-link" href="{{ route('tag.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Tag
                </a>


                <a class="nav-link" href="{{ route('order.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    orders
                </a>

                <!-- removed because we do not need to add categories -->
                {{--
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Categories
                </a>
                --}}

            </div>
            <div class="sb-sidenav-footer" style="position: fixed; bottom: 0; width: 100%;">
                <div class="small">Logged in as:</div>
                {{ Auth::user()->name }}
            </div>
    </nav>
</div>
