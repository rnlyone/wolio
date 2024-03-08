<div class="modal sidebarMenu -left fade" id="mdllSidebar-connected" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            @auth
            <div class="modal-header d-block pb-1">

                <!-- un-user-profile -->
                <div class="un-user-profile">
                    <div class="image_user">
                        <picture>
                            <source srcset="/storage/public/avatar/{{auth()->user()->avatar}}" type="image/png">
                            <img src="images/avatar/11.jpg" alt="image">
                        </picture>
                    </div>
                    <div class="text-user">
                        <h3>{{auth()->user()->nama}}</h3>
                        <p>{{auth()->user()->role}}</p>
                    </div>
                </div>

                <button type="button" class="btn btnClose" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-fill"></i>
                </button>

                <!-- cover-balance -->
                <div class="cover-balance">
                    <div class="un-balance">
                        <div class="content-balance">
                            <div class="head-balance">
                                <h4></h4>
                            </div>
                            <p class="no-balance"> </p>
                        </div>
                    </div>
                    <a href="{{route('logout')}}" class="btn btn-sm-size bg-white text-dark rounded-pill">
                        Logout
                    </a>
                </div>
            </div>
            @endauth
            @guest
                <div class="modal-header">
                    <div class="welcome_em">
                        <h5>{{$stgs['nama_aplikasi']}}<span>.</span></h5>
                        <p>
                            Selamat datang di Aplikasi {{$stgs['deskripsi_app']}}
                        </p>
                        <a href="/login" class="btn btn-md-size bg-primary text-white rounded-pill">
                            login
                        </a>
                    </div>
                    <button type="button" class="btn btnClose" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ri-close-fill"></i>
                    </button>
                </div>
                @endguest
            <div class="modal-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{$homebar ?? ''}}" href="/">
                            <div class="icon_current">
                                <i class="ri-home-5-line"></i>
                            </div>
                            <div class="icon_active">
                                <i class="ri-home-5-fill"></i>
                            </div>
                            <span class="title_link">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$materibar ?? ''}}" href="{{route('kategori.index')}}">
                            <div class="icon_current">
                                <i class="ri-book-open-line"></i>
                            </div>
                            <div class="icon_active">
                                <i class="ri-book-open-fill"></i>
                            </div>
                            <span class="title_link">Materi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$gamesbar ?? ''}}" href="{{route('kategori.index', ['kuis' => 1])}}">
                            <div class="icon_current">
                                <i class="ri-gamepad-line"></i>
                            </div>
                            <div class="icon_active">
                                <i class="ri-gamepad-fill"></i>
                            </div>
                            <span class="title_link">Games</span>

                            {{-- <div class="badge-circle">
                                <span class="doted_item"></span>
                            </div> --}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{$profilbar ?? ''}}" href="{{route('user.index')}}">
                            <div class="icon_current">
                                <i class="ri-user-line"></i>
                            </div>
                            <div class="icon_active">
                                <i class="ri-user-fill"></i>
                            </div>
                            <span class="title_link">Profil Saya</span>

                        </a>
                    </li>

                    @auth
                        @if(auth()->user()->role == "guru")
                        <label class="title__label">halaman guru</label>

                        <li class="nav-item">
                            <a class="nav-link {{$kelolamateribar ?? ''}}" href="{{route('materi.kategori')}}">
                                <div class="icon_current">
                                    <i class="ri-book-open-line"></i>
                                </div>
                                <div class="icon_active">
                                    <i class="ri-book-open-fill"></i>
                                </div>
                                <span class="title_link">Kelola Materi</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{$kelolagamesbar ?? ''}}" href="{{route('kuis.kategori')}}">
                                <div class="icon_current">
                                    <i class="ri-gamepad-line"></i>
                                </div>
                                <div class="icon_active">
                                    <i class="ri-gamepad-fill"></i>
                                </div>
                                <span class="title_link">Kelola Games</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{$settingbar ?? ''}}" href="{{route('setting.index')}}">
                                <div class="icon_current">
                                    <i class="ri-file-info-line"></i>
                                </div>
                                <div class="icon_active">
                                    <i class="ri-file-info-fill"></i>
                                </div>
                                <span class="title_link">Other</span>
                            </a>
                        </li>
                        @endif
                    @endauth
                </ul>
            </div>
            <div class="modal-footer">
                <div class="em_darkMode_menu">
                    <label class="text" for="switchDark">
                        <h3>Dark Mode</h3>
                        <p>Browsing in night mode</p>
                    </label>
                    <label class="switch_toggle toggle_lg theme-switch" for="switchDark">
                        <input type="checkbox" class="switchDarkMode theme-switch" id="switchDark"
                            aria-describedby="switchDark">
                        <span class="handle"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===================================
START THE MODAL SIDEBAR MENU - guest
==================================== -->

