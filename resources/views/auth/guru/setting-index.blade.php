@include('layouts.header')
@include('layouts.pagetitle')

<div class="un-navMenu-default without-visit py-3 bg-white">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link visited" href="{{route('kelas.index')}}">
                <div class="item-content-link">
                    <div class="icon bg-blue-1 color-blue">
                        <i class="ri-team-line"></i>
                    </div>
                    <h3 class="link-title">Manajemen Kelas</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link visited" href="{{route('user.manage')}}">
                <div class="item-content-link">
                    <div class="icon bg-orange-1 color-orange">
                        <i class="ri-user-3-line"></i>
                    </div>
                    <h3 class="link-title">Manajemen User</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link visited" href="{{route('kategori.manage')}}">
                <div class="item-content-link">
                    <div class="icon bg-red-1 color-red">
                        <i class="ri-list-check"></i>
                    </div>
                    <h3 class="link-title">Manajemen Kategori</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link visited" href="{{route('materi.kategori')}}">
                <div class="item-content-link">
                    <div class="icon bg-green-1 color-green">
                        <i class="ri-book-open-line"></i>
                    </div>
                    <h3 class="link-title">Manajemen Materi</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link visited" href="{{route('kuis.kategori')}}">
                <div class="item-content-link">
                    <div class="icon bg-pink-1 color-pink">
                        <i class="ri-file-list-2-line"></i>
                    </div>
                    <h3 class="link-title">Manajemen Games</h3>
                </div>
                <div class="other-cc">
                    <span class="badge-text"></span>
                    <div class="icon-arrow">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </div>
            </a>
        </li>
    </ul>
</div>

@include('layouts.footer')
