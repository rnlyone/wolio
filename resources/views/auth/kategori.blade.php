@include('layouts.headersub')

<!-- ===================================
    START THE SEARCH
==================================== -->
<section class="help-search-support">
    <div class="content">
        <div class="head">
            <h2>Cari Materi disini</h2>
            <p>Materi yang telah disediakan oleh Aplikasi.</p>
        </div>
        <div class="form-group with_icon m-0">
            <div class="input_group">
                <input id="materiSearch" type="search" class="form-control border-0" placeholder="Ketikkan sesuatu disini...">
                <div class="icon">
                    <i class="ri-search-2-line"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Kategori Materi</h2>
            <p>Daftar kategori semua materi.</p>
        </div>
    </div>
    <div class="content-comp p-0">

        <div class="space-items"></div>

        <div class="un-navMenu-default without-visit py-3 bg-white">
            <ul class="nav flex-column">
                @foreach ($kategoris as $kategori)
                <li class="nav-item">
                    <a class="nav-link visited" href="{{ route('materi.index', ['uuidkategori' => $kategori->uuid]) }}">
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
<script>
    $(document).ready(function () {
        $('#materiSearch').on('keypress', function (e) {
            if (e.which === 13) {
                // Tombol Enter ditekan
                e.preventDefault(); // Mencegah aksi default dari tombol Enter
                // Gantilah URL berikut dengan URL yang diinginkan
                var search = $(this).val();
                window.location.href = `{{route('materi.search', ['term' => ':searchTerm'])}}`.replace('%3AsearchTerm', search);
            }
        });
    });
</script>
