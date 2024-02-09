@include('layouts.headersub')

<!-- ===================================
    START THE SEARCH
==================================== -->
<section class="main-search-header">
    <div class="content-search">
        <div class="w-100 form-group with_icon">
            <div class="input_group">
                <input id="materiSearch" type="search" class="w-100 form-control rounded-pill" placeholder="Cari {{$nama_kategori}} ...">
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
                        <li class="nav-item" data-materi-id="{{$materi->id}}" id="materi[{{$materi->id}}]">
                            <div class="nav-link visited delete-materi-link">
                                <a style="text-decoration: none" href="{{route('materi.edit', ['materi' => $materi->id])}}">
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
                                </a>
                                <div class="other-option">
                                    <button data-materi-id="{{$materi->id}}" class="color-text rounded-pill bg-snow btn-xs-size delete-materi">Hapus</button>
                                </div>
                            </div>
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
        $('.delete-materi').on('click', function () {
            var materiId = $(this).data('materi-id');

            // Konfirmasi pengguna sebelum menghapus
            if (confirm('Anda yakin ingin menghapus materi ini?')) {
                // Kirim permintaan AJAX untuk menghapus materi
                $.ajax({
                    url: '{{ route('materi.destroy', ['materi' => '__materi_id__']) }}'.replace('__materi_id__', materiId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        showSuccessToast('materi berhasil dihapus.');
                        // Menghapus elemen dengan ID yang sesuai
                        $('#materi\\[' + materiId + '\\]').remove();
                    },
                    error: function (error) {
                        alert('Gagal menghapus materi.');
                        console.error(error);
                    }
                });
            }
        });

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

@include('layouts.bottom-toast')
