@include('layouts.headersub')

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Soal ({{$kuis->nama}})</h2>
            <p>Daftar Semua Soal dari kuis ({{$kuis->nama}}).</p>
        </div>
        <div class="un-block-right">
            <a href="{{route('soal.create', ['uuidkuis' => $kuis->uuid])}}" class="icon-back visited" aria-label="iconBtn">
                <i class="ri-add-line"></i>
            </a>
        </div>
    </div>
    <div class="content-comp p-0">

        <div class="space-items"></div>

        <div class="unList-creatores bg-white">
            <div class="content-list-creatores">
                <ul class="nav flex-column">
                    @foreach ($soals as $i => $soal)
                        <li class="nav-item" id="soal[{{$soal->id}}]">
                            <div class="nav-link visited delete-soal-link">
                                <a style="text-decoration: none" href="{{route('soal.edit', ['soal' => $soal->id])}}">
                                    <div class="item-user-img">
                                        <div class="item-content-link">
                                            <div class="icon bg-blue-1 color-blue">
                                                <i class="ri-checkbox-circle-line"></i>
                                            </div>
                                        </div>
                                        <div class="txt-user">
                                            @php
                                                $strippedString = strip_tags(htmlspecialchars_decode($soal->soal));

                                                $words = str_word_count($strippedString, 1);

                                                // Ambil dua kata pertama
                                                $limitedWords = implode(' ', array_slice($words, 0, 4));
                                            @endphp
                                            <h5>Pertanyaan {{$i+1}}
                                                @if ($soal->jawaban_benar == null)<span class="badge bg-red">Tidak Ada Benar</span>@endif
                                                @if ($soal->jawabans->count() < 2)<span class="badge bg-red">Jawaban kurang</span>@endif</h5>
                                            <p>{{$limitedWords}}</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="other-option">
                                    <button data-soal-id="{{$soal->id}}" class="color-text rounded-pill bg-snow btn-xs-size delete-soal">Hapus</button>
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
        $('.delete-soal').on('click', function () {
            var soalId = $(this).data('soal-id');

            // Konfirmasi pengguna sebelum menghapus
            if (confirm('Anda yakin ingin menghapus soal ini?')) {
                // Kirim permintaan AJAX untuk menghapus soal
                $.ajax({
                    url: '{{ route('soal.destroy', ['soal' => '__soal_id__']) }}'.replace('__soal_id__', soalId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        showSuccessToast('soal berhasil dihapus.');
                        // Menghapus elemen dengan ID yang sesuai
                        $('#soal\\[' + soalId + '\\]').remove();
                    },
                    error: function (error) {
                        alert('Gagal menghapus soal.');
                        console.error(error);
                    }
                });
            }
        });
    });
</script>

@include('layouts.bottom-toast')
