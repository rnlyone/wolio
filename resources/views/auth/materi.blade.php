@include('layouts.headersub')

<!-- ===================================
    START THE SEARCH
==================================== -->
<section class="main-search-header">
    <div class="content-search">
        <div class="form-group with_icon">
            <div class="input_group">
                <input id="materiSearch" type="search" class="form-control rounded-pill" placeholder="Cari {{$nama_kategori}} ...">
                <div class="icon">
                    <i class="ri-search-2-line"></i>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-box-filter" data-bs-toggle="modal" data-bs-target="#mdllFilter">
            <i class="ri-equalizer-line"></i>
        </button>
    </div>
</section>

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Materi {{$nama_kategori}}</h2>
            <p>Daftar semua materi ({{$nama_kategori}}).</p>
        </div>
    </div>
    <div class="content-comp p-0">

        <div class="space-items"></div>

        <div class="unList-creatores bg-white">
            <div class="content-list-creatores">
                <ul id="listMateri" class="nav flex-column">
                    @foreach ($materis as $materi)
                        <li class="nav-item">
                            <a class="nav-link visited" href="{{route('materi.show', ['materi' => $materi->id])}}">
                                <div class="item-user-img">
                                    <div class="item-content-link">
                                        <div class="icon bg-orange-1 color-orange">
                                            <i class="ri-article-line"></i>
                                        </div>
                                    </div>
                                    <div class="txt-user">
                                        <h5>{{$materi->judul}}</h5>
                                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($materi->konten), 20) }}</p>
                                    </div>
                                </div>
                                <div class="other-option">
                                    <div class="color-text rounded-pill bg-snow btn-xs-size">></div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
    <!-- End.content-comp -->
</section>

@include('layouts.footer')

<script>
    $(document).ready(function () {
        $('#materiSearch').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();

            // Hide all items initially
            $('.nav-item').hide();

            // Filter items based on the search term
            $('#listMateri .nav-item').filter(function () {
                return $(this).text().toLowerCase().includes(searchTerm);
            }).show();
        });
    });
</script>
