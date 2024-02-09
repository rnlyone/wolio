@include('layouts.headersub')

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Managemen Kelas</h2>
            <p>Managemen Kelas</p>
        </div>
        <div class="un-block-right">
            <a href="{{route('kelas.create')}}" class="icon-back visited" aria-label="iconBtn">
                <i class="ri-add-line"></i>
            </a>
        </div>
    </div>
    <div class="content-comp p-0">
        <div class="un-navMenu-default without-visit py-3 bg-white">
            <ul class="nav flex-column">
                @foreach ($kelases as $kelas)
                    <li class="nav-item">
                        <a class="nav-link visited" href="{{route('kelas.edit', ['kela' => $kelas->id])}}">
                            <div class="item-content-link">
                                <div class="icon bg-orange-1 color-orange">
                                    <i class="ri-team-line"></i>
                                </div>
                                <h3 class="link-title">{{$kelas->tingkat}} {{$kelas->nama_kelas}}</h3>
                            </div>
                            <div class="other-cc">
                                <span class="badge-text"></span>
                                <div class="icon-arrow">
                                    <i class="ri-arrow-drop-right-line"></i>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

@include('layouts.footer')
