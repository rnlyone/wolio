@include('layouts.headersub')

<!-- ===================================
    START THE SEARCH
==================================== -->

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Kategori Materi</h2>
            <p>Daftar kategori semua materi.</p>
        </div>
        <div class="un-block-right">
            <a href="{{route('materi.create')}}" class="icon-back visited" aria-label="iconBtn">
                <i class="ri-add-line"></i>
            </a>
        </div>
    </div>

    <div class="content-comp p-0">

        <div class="space-items"></div>

        <div class="un-navMenu-default without-visit py-3 bg-white">
            <ul class="nav flex-column">
                @foreach ($kategoris as $kategori)
                <li class="nav-item">
                    <a class="nav-link visited" href="{{ route('materi.manage', ['uuidkategori' => $kategori->uuid]) }}">
                        <div class="item-content-link">
                            <div class="icon bg-green-1 color-green">
                                <i class="ri-archive-drawer-line"></i>
                            </div>
                            <h3 class="link-title">{{$kategori->nama}}</h3>
                        </div>
                        <div class="other-cc">
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
    <!-- End.content-comp -->
</section>

@include('layouts.footer')
