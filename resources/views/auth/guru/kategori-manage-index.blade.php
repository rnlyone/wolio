@include('layouts.headersub')

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Managemen Kategori</h2>
            <p>Managemen Kategori</p>
        </div>
        <div class="un-block-right">
            <a href="{{route('kategori.create')}}" class="icon-back visited" aria-label="iconBtn">
                <i class="ri-add-line"></i>
            </a>
        </div>
    </div>
    <div class="content-comp p-0">
        <div class="un-navMenu-default without-visit py-3 bg-white">
            <ul class="nav flex-column">
                @foreach ($kategoris as $kategori)
                    <li class="nav-item">
                        <a class="nav-link visited" href="{{route('kategori.edit', ['kategori' => $kategori->id])}}">
                            <div class="item-content-link">
                                <div class="icon bg-red-1 color-red">
                                    <i class="ri-list-check"></i>
                                </div>
                                <h3 class="link-title">{{$kategori->nama}}</h3>
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
