<footer class="un-bottom-navigation filter-blur">
    <div class="em_body_navigation border-0">
        <div class="item_link  {{$homenav ?? ''}}">
            <a href="/" class="btn btn_navLink" aria-label="btnNavigation">
                <div class="icon_current">
                    <i class="ri-home-5-line"></i>
                </div>
                <div class="icon_active">
                    <i class="ri-home-5-fill"></i>
                </div>
            </a>
        </div>
        <div class="item_link {{$materinav ?? ''}}">
            <a href="{{route('kategori.index')}}" class="btn btn_navLink" aria-label="btnNavigation">
                <div class="icon_current">
                <i class="ri-book-open-line"></i>
                </div>
                <div class="icon_active">
                <i class="ri-book-open-fill"></i>
                </div>
            </a>
        </div>
        <div class="item_link {{$gamesnav ?? ''}}">
            <a href="{{route('kategori.index', ['kuis' => 1])}}" class="btn btn_navLink" aria-label="btnNavigation">
                <div class="icon_current">
                    <i class="ri-gamepad-line"></i>
                </div>
                <div class="icon_active">
                    <i class="ri-gamepad-fill"></i>
                </div>
            </a>
        </div>
        <div class="item_link {{$usernav ?? ''}}">
            <a href="{{route('user.index')}}" class="btn btn_navLink" aria-label="btnNavigation">
                <div class="icon_current">
                    <i class="ri-user-4-line"></i>
                </div>
                <div class="icon_active">
                    <i class="ri-user-4-fill"></i>
                </div>
            </a>
        </div>
    </div>
</footer>
