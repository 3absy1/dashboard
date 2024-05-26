<nav class="navbar navbar-vertical navbar-expand-lg" style="display:none;">
    <script>
        var navbarStyle = localStorage.getItem("phoenixNavbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
        document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
        <ul class="navbar-nav flex-column" id="navbarVerticalNav">
            <li class="nav-item">
            <!-- parent pages-->
            <span class="nav-item-wrapper">
                <a class="nav-link label-1 {{Request::url() == route('dashboard')? 'active':''}}" href="/dashboard" role="button"  >
                <div class="d-flex align-items-center"><div class="dropdown-indicator-icon">
                </div><span class="nav-link-icon"><i class="fa-solid fa-display mt-1"></i></span><span class="nav-link-text">Dashboard</span>
            </div></a>
        </span>
        </li>
        <li class="nav-item">
            <!-- parent pages-->
            <span class="nav-item-wrapper">
                <a class="nav-link label-1 {{Request::url() == route('search')? 'active':''}}" href="/search" role="button"  >
                <div class="d-flex align-items-center"><div class="dropdown-indicator-icon">
                </div><span class="nav-link-icon"><i class="fa-solid fa-display mt-1"></i></span><span class="nav-link-text">Searchs</span>
            </div></a>
        </span>
        </li>


        </ul>
        <ul class="navbar-nav flex-column" id="navbarVerticalNav">
            <li class="nav-item">

            <!-- parent pages-->
            <span class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1 collapsed" href="#events" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="events"><div class="d-flex align-items-center"><div class="dropdown-indicator-icon"><svg class="svg-inline--fa fa-caret-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M118.6 105.4l128 127.1C252.9 239.6 256 247.8 256 255.1s-3.125 16.38-9.375 22.63l-128 127.1c-9.156 9.156-22.91 11.9-34.88 6.943S64 396.9 64 383.1V128c0-12.94 7.781-24.62 19.75-29.58S109.5 96.23 118.6 105.4z"></path></svg><!-- <span class="fas fa-caret-right"></span> Font Awesome fontawesome.com --></div><span class="nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg></span><span class="nav-link-text">Names Management </span></div></a>
            <div class="parent-wrapper label-1">
                <ul class="nav parent collapse" data-bs-parent="#navbarVerticalCollapse" id="events" style="">
                <p class="collapsed-nav-item-title d-none">Names Management </p>
                <li class="nav-item"><a class="nav-link {{Request::url() == route('reference')? 'active':''}}" href="reference" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-text">References Table</span></div>
                    </a><!-- more inner pages-->
                </li>
                <li class="nav-item"><a class="nav-link {{Request::url() == route('related')? 'active':''}} " href="related" data-bs-toggle="" aria-expanded="false">
                    <div class="d-flex align-items-center"><span class="nav-link-text">Related Table</span></div>
                    </a><!-- more inner pages-->
                </li>
                </ul>
            </div></span>
        </li>
        </ul>
</div>
</div>
<div class="navbar-vertical-footer"><button onclick="toggleNavArrow()" class="btn navbar-vertical-toggle border-0 fw-semi-bold w-100 text-start white-space-nowrap"><span id="toggleArrow" class="fas fa-arrow-right d-none fs-0"></span><span class="navbar-vertical-footer-text ms-2"> <span class="fas fa-arrow-left  ms-2"></span> Collapsed View </span></span></button></div>
</nav>
