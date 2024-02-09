@include('layouts.header')
<section class="un-creator-ptofile">
    <!-- head -->
    <div class="head">
        <div class="cover-image">
            <picture>
                <source srcset="/images/icon4.jpg" type="image/png">
                <img src="" alt="cover image">
            </picture>
        </div>
        <div class="text-user-creator">
            <div class="d-flex align-items-center">
                <div class="user-img">
                    <picture>
                        <source srcset="/storage/public/avatar/{{auth()->user()->avatar}}" type="image/webp">
                        <img src="images/avatar/22.jpg" alt="creator image">
                    </picture>
                    @if (auth()->user()->role == 'guru')
                        <i class="ri-checkbox-circle-fill"></i>
                    @else

                    @endif
                </div>
                <div class="text">
                    <h3>{{auth()->user()->nama}}</h3>
                    <p>{{auth()->user()->username}} </p>
                </div>
            </div>
            <a href="{{route('user.edit', ['user', auth()->user()->id])}}" class="btn btn-copy-address mt-3">
                <div class="icon-box">
                    <i class="ri-edit-2-line"></i>
                </div>
            </a>
        </div>
    </div>
    <!-- body -->
    <div class="body">
        {{-- <div class="item-followers">
            <div class="users-text">
                <p>Followed by 2,5K</p>
                <div class="img-user">
                    <picture>
                        <source srcset="images/avatar/18.webp" type="image/webp">
                        <img src="images/avatar/18.jpg" alt="image">
                    </picture>
                    <picture>
                        <source srcset="images/avatar/1.webp" type="image/webp">
                        <img src="images/avatar/1.jpg" alt="user">
                    </picture>
                    <picture>
                        <source srcset="images/avatar/12.webp" type="image/webp">
                        <img src="images/avatar/12.png" alt="image">
                    </picture>
                    <picture>
                        <source srcset="images/avatar/13.webp" type="image/webp">
                        <img src="images/avatar/13.jpg" alt="image">
                    </picture>
                    <picture>
                        <source srcset="images/avatar/4.webp" type="image/webp">
                        <img src="images/avatar/4.jpg" alt="image">
                    </picture>
                    <picture>
                        <source srcset="images/avatar/14.webp" type="image/webp">
                        <img src="images/avatar/14.jpg" alt="image">
                    </picture>

                    <a href="page-followers.html" class="link visited">+2K</a>
                </div>
            </div>
            <button type="button" class="btn btn-md-size text-white bg-primary rounded-pill">
                Follow
            </button>
        </div>
        <div class="statistics">
            <div class="text-grid">
                <h4>35</h4>
                <p>Tiket</p>
            </div>
            <div class="text-grid">
                <h4>2,3K</h4>
                <p>Likes</p>
            </div>
            <div class="text-grid">
                <h4>8.8K</h4>
                <p>Views</p>
            </div>
            <div class="text-grid">
                <h4>48</h4>
                <p>Minted</p>
            </div>

        </div> --}}
        <div class="description">
        </div>

    </div>

    <div class="tab-creatore-profile">

        <ul class="nav nav-pills nav-pilled-tab w-100" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-Riwayat-tab" data-bs-toggle="pill" data-bs-target="#pills-Riwayat" type="button" role="tab" aria-controls="pills-Tiket" aria-selected="false">Riwayat Kuis</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="pills-Profil-tab" data-bs-toggle="pill" data-bs-target="#pills-Profil" type="button" role="tab" aria-controls="pills-Lomba" aria-selected="true">Profil Saya</button>
            </li>
        </ul>
        <div class="tab-content content-custome-data" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-Riwayat" role="tabpanel" aria-labelledby="pills-Riwayat-tab">
                <section class="log-table-simple">
                    <table class="table table-striped table-hover">
                        <tbody>
                            @if (!auth()->user()->riwayats->isEmpty())
                                @foreach (auth()->user()->riwayats->sortByDesc('created_at') as $riwayat)
                                    <tr>
                                        <td><span class="text-dark">{{$riwayat->jumlah_benar}}</span> dari 5 Soal Pada {{$riwayat->created_at}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="empty-items">
                                    <img class="empty-light" src="/images/isEmpty.svg" alt="">
                                    <img class="empty-dark" src="/images/isEmpty.svg" alt="">
                                    <h4>Masih Kosong</h4>
                                    <p>Kamu masih belum memaikan Games Sebelumnya</p>
                                </div>
                            @endif
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="tab-pane fade" id="pills-Profil" role="tabpanel" aria-labelledby="pills-Profil-tab">

                <div class="empty-items">
                    <img class="empty-light" src="/images/isEmpty.svg" alt="">
                    <img class="empty-dark" src="/images/isEmpty.svg" alt="">
                    <h4>No sale yet</h4>
                    <p>Sorry, there is no data to display</p>
                </div>
            </div>
        </div>

    </div>

</section>

@include('layouts.footer')
