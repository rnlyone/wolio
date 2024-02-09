@include('layouts.headersub')

<!-- ===================================
    START THE SEARCH
==================================== -->

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Kuis {{$nama_kategori}}</h2>
            <p>Daftar semua kuis ({{$nama_kategori}}).</p>
        </div>
        <div class="un-block-right">
            <a href="{{route('kuis.create')}}" class="icon-back visited" aria-label="iconBtn">
                <i class="ri-add-line"></i>
            </a>
        </div>
    </div>
    <div class="content-comp p-0">

        <div class="space-items"></div>

        <div class="unList-creatores bg-white">
            <div class="content-list-creatores">
                <ul class="nav flex-column">
                    @foreach ($kuises as $kuis)
                        <li class="nav-item" id="kuis[{{$kuis->id}}]">
                            <div class="nav-link visited delete-kuis-link">
                                <a style="text-decoration: none" href="{{route('kuis.show', ['kui' => $kuis->id])}}">
                                    <div class="item-user-img">
                                        <div class="item-content-link">
                                            <div class="icon bg-orange-1 color-orange">
                                                <i class="ri-list-check-2"></i>
                                            </div>
                                        </div>
                                        <div class="txt-user">
                                            <h5>{{$kuis->nama}}@if ($kuis->soals->count() < 5)</h5><span class="badge bg-red">Soal < 5</span>@endif
                                    </div>
                                    </div>
                                </a>
                                <div class="other-option">
                                    <button data-kuis-id="{{$kuis->id}}" class="color-text rounded-pill bg-snow btn-xs-size delete-kuis">Hapus</button>
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
        $('.delete-kuis').on('click', function () {
            var kuisId = $(this).data('kuis-id');

            // Konfirmasi pengguna sebelum menghapus
            if (confirm('Anda yakin ingin menghapus kuis ini?')) {
                // Kirim permintaan AJAX untuk menghapus kuis
                $.ajax({
                    url: '{{ route('kuis.destroy', ['kui' => '__kuis_id__']) }}'.replace('__kuis_id__', kuisId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        showSuccessToast('kuis berhasil dihapus.');
                        // Menghapus elemen dengan ID yang sesuai
                        $('#kuis\\[' + kuisId + '\\]').remove();
                    },
                    error: function (error) {
                        alert('Gagal menghapus kuis.');
                        console.error(error);
                    }
                });
            }
        });
    });
</script>

@include('layouts.bottom-toast')
