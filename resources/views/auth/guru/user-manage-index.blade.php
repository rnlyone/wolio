@include('layouts.headersub')

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>{{$stgs['pagetitle']}}</h2>
            <p>{{$stgs['subtitle'] ?? $stgs['pagetitle']}}</p>
        </div>
        <div class="un-block-right">
            <a href="{{route('user.create')}}" class="icon-back visited" aria-label="iconBtn">
                <i class="ri-add-line"></i>
            </a>
        </div>
    </div>
</section>

<div class="unList-creatores bg-white mb-3">
    <div class="content-list-creatores">
        <h6 class="title-form">Role Guru</h6>
        <ul class="nav flex-column">
            @foreach ($users->where('role', 'guru') as $user)
                <li class="nav-item">
                    <a class="nav-link visited" href="{{route('user.edit', ['user' => $user->id])}}">
                        <div class="item-user-img">
                            <picture>
                                <source srcset="/storage/public/avatar/{{$user->avatar}}" type="image/webp">
                                <img class="avt-img" src="images/avatar/13.jpg" alt="">
                            </picture>
                            <div class="txt-user">
                                <h5>{{$user->nama_lengkap}}</h5>
                                <p>{{$user->username}}</p>
                            </div>
                        </div>
                        <div class="other-option">
                            <div class="color-text rounded-pill bg-snow btn-xs-size">Detail</div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="unList-creatores bg-white mt-3">
    <div class="content-list-creatores">
        <h6 class="title-form">Role Siswa</h6>
        <section class="un-page-component">
            <div class="content-comp p-0">
                <div class="bg-white py-3">
                    <div class="accordion" id="accordionExample">
                        @foreach ($kelases as $kelas)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$kelas->id}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$kelas->id}}" aria-expanded="false" aria-controls="collapse{{$kelas->id}}">
                                        {{$kelas->nama_kelas}}
                                    </button>
                                </h2>
                                <div id="collapse{{$kelas->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$kelas->id}}" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        <ul class="nav flex-column">
                                            @if ($kelas->siswas->count() == 0)
                                                Kosong
                                            @endif
                                            @foreach ($kelas->siswas as $user)
                                                <li class="nav-item">
                                                    <a class="nav-link visited" href="{{route('user.edit', ['user' => $user->id])}}">
                                                        <div class="item-user-img">
                                                            <picture>
                                                                <source srcset="/storage/public/avatar/{{$user->avatar}}" type="image/webp">
                                                                <img class="avt-img" src="images/avatar/13.jpg" alt="">
                                                            </picture>
                                                            <div class="txt-user">
                                                                <h5>{{$user->nama_lengkap}}</h5>
                                                                <p>{{$user->username}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="other-option">
                                                            <div class="color-text rounded-pill bg-snow btn-xs-size">Detail</div>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingnonkelas">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsenonkelas" aria-expanded="false" aria-controls="collapsenonkelas">
                                    Siswa Tanpa Kelas
                                </button>
                            </h2>
                            <div id="collapsenonkelas" class="accordion-collapse collapse" aria-labelledby="headingnonkelas" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body">
                                    <ul class="nav flex-column">
                                        @if ($users->where('role', 'siswa')->where('id_kelas', null)->count() == 0)
                                            Kosong
                                        @endif
                                        @foreach ($users->where('role', 'siswa')->where('id_kelas', null) as $user)
                                            <li class="nav-item">
                                                <a class="nav-link visited" href="{{route('user.edit', ['user' => $user->id])}}">
                                                    <div class="item-user-img">
                                                        <picture>
                                                            <source srcset="/storage/public/avatar/{{$user->avatar}}" type="image/webp">
                                                            <img class="avt-img" src="images/avatar/13.jpg" alt="">
                                                        </picture>
                                                        <div class="txt-user">
                                                            <h5>{{$user->nama_lengkap}}</h5>
                                                            <p>{{$user->username}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="other-option">
                                                        <div class="color-text rounded-pill bg-snow btn-xs-size">Detail</div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>






@include('layouts.footer')
