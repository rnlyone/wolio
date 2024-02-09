<style>
    .description {
        max-width: 100%; /* Set the maximum width to the size of the container */
    }

    .description img {
        max-width: 100%; /* Set the maximum width of images to 100% of the container width */
        height: auto; /* Maintain the aspect ratio of the images */
    }
</style>
@include('layouts.app')

<body>
    <!-- ===================================
      START LODAER PAGE
    ==================================== -->
    <section class="loader-page" id="loaderPage">
        <div class="spinner_flash"></div>
    </section>
    <!-- START WRAPPER -->
    <div id="wrapper">
        <!-- START CONTENT -->
        <div id="content">
            <!-- ===================================
              START THE HEADER
            ==================================== -->

            <header class="default heade-sticky">
                <div class="un-title-page go-back">
                        @if (isset($stgs['prevpage']))
                            <a href="{{$stgs['prevpage']}}" class="icon visited">
                                <i class="ri-arrow-drop-left-line"></i>
                            </a>
                        @else
                            <a href="javascript:history.back()" class="icon visited">
                                <i class="ri-arrow-drop-left-line"></i>
                            </a>
                        @endif
                    <h1>{{$stgs['pagetitle']}}</h1>
                </div>

            </header>

            <div class="space-sticky"></div>


@if ($play == null)
    <section class="copyright-mark">
        <div class="content">
            <h3>Kuis untuk Kategori ini Kosong</h3>
            <p>Gebalio</p>
        </div>
        <a href="{{route('kategori.index', ['kuis' => '1'])}}" class="btn effect-click btn-md-size bg-primary text-white rounded-pill">
            Kembali
        </a>
    </section>
@else
    <section id="splashscreen" style="padding-top: 30vh" class="copyright-mark">
        <div class="content">
            <h3>Sudah Siap?</h3>
            <p>Kuis Terkait {{$play->nama}} <br> Waktu Menjawab 30 Detik Setiap Soal</p>
        </div>
        <button id="startGame" data-kuis-id="{{$play->uuid}}" class="btn effect-click btn-md-size bg-primary text-white rounded-pill">
            Mulai Kuis
        </button>
    </section>
@endif

<section id="kontainersoal" class="un-details-blog">
</section>



@include('layouts.footernavless')

@if ($play != null)
    <script>
        $(document).ready(function () {
            $('#startGame').on('click', function () {
                prepareGame();
            })
        });

        var datakuis;
        function prepareGame() {
            var id_kuis = $('#startGame').data('kuis-id');
            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('id_kuis', id_kuis);

            $.ajax({
                url: '{{ route('kuis.ambilsoal') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    showSuccessToast('Kuis di Mulai!');
                    $('#splashscreen').hide();
                    // console.log(response.data);
                    datakuis = response.data;
                    gameProcess();
                },
                error: function(error) {
                    showErrorToast('Kuis Gagal Dijalankan');
                    console.log(error);
                }
            });
        }


        var pastSoal = [];
        var pastIndex = [];
        var answer = [];
        function gameProcess() {
            // Mendapatkan elemen dengan id "kontainersoal"
            let kontainerSoal = document.getElementById('kontainersoal');

            // Mengambil satu soal secara acak dari lima soal yang diambil
            let randomIndex = Math.floor(Math.random() * datakuis.length);
            let randomSoal = datakuis[randomIndex];

            // Mengecek apakah soal sudah pernah ditampilkan sebelumnya
            while (pastIndex.includes(randomIndex)) {
                randomIndex = Math.floor(Math.random() * datakuis.length);
                randomSoal = datakuis[randomIndex];
            }

            // Menambahkan index soal ke dalam array pastSoal
            pastIndex.push(randomIndex);
            pastSoal.push(randomSoal.id);

            // Membuat template HTML untuk satu soal
            let soalTemplate = `
                <section id="soalsoal" class="un-details-blog">
                    <div class="head">
                    </div>
                    <div class="body">
                        <div class="title-blog">
                            <div class="others">
                                <div class="time">
                                    <i class="ri-time-line"></i>
                                    <span>${randomSoal.created_at}</span>
                                </div>
                            </div>
                            <h2>Soal ${pastIndex.length}</h2>
                        </div>
                        <div class="description">
                            ${randomSoal.soal}
                        </div>
                        ${randomSoal.audios && randomSoal.audios.length > 0 ? `
                            <div class="form-group pt-3">
                                <table id="audiofiles" class="w-100">
                                    <tr>
                                        <th>Audio</th>
                                        <th>Caption</th>
                                    </tr>
                                    ${randomSoal.audios.map(audio => `
                                        <tr>
                                            <td style="width: 40%;">
                                                <audio class="w-100" controls>
                                                    <source src="/storage/public/audios/${audio.audio}" type="audio/ogg">
                                                </audio>
                                            </td>
                                            <td><span class="mx-1"><span style="word-break: break-word;">${audio.caption}</span></span></td>
                                        </tr>
                                    `).join('')}
                                </table>
                            </div>
                        ` : ''}
            `;

            // Tambahkan template jawaban ke soalTemplate
            soalTemplate += `
            <div class="form-group pt-5">
                <table id="jawabanfiles" class="w-100">
                    <tr>
                        <th>Jawaban</th>
                    </tr>
                    ${randomSoal.jawabans && randomSoal.jawabans.length > 0 ? `
                        ${randomSoal.jawabans.map(jawaban => `
                            <tr id="jawaban[${jawaban.id}]">
                                <td>
                                    <div class="nav-checkbox p-1">
                                        <div class="nav-item">
                                            <div class="form-check">
                                                <input class="form-check-input jawabancheck" type="checkbox" data-jawaban-check-id="${jawaban.id}" id="jawabancheck[${jawaban.id}]">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 80%; justify-content:center">
                                    ${jawaban.jenis === 'text' ? `
                                        <div class="p-2 w-100 h-100">
                                            <label style="margin-bottom:0;">${jawaban.jawaban}</label>
                                        </div>
                                    ` : ''}
                                    ${jawaban.jenis === 'audio' ? `
                                        <audio class="m-2 w-100" controls>
                                            <source src="/storage/public/jawabans/${jawaban.jawaban}" type="audio/ogg">
                                        </audio>
                                    ` : ''}
                                    ${jawaban.jenis === 'gambar' ? `
                                        <img class="m-2" style="width: 50%;" src="/storage/public/jawabans/${jawaban.jawaban}" alt="">
                                    ` : ''}
                                </td>
                            </tr>
                        `).join('')}
                    ` : `
                        <tr id="ifjawabankosong">
                            <td colspan="2"  class="p-3" style="text-align: center">Masih Kosong</td>
                        </tr>
                    `}
                </table>
            </div>`;

            if (pastSoal.length === 5) {
                soalTemplate += `
                        <div class="pt-3">
                            <button id="btnSimpan" onclick="kirimKuis()" class="btn btn-md-arrow bg-green w-100">
                                <p>Selesaikan Kuis</p>
                                <div class="ico">
                                    <i class="ri-arrow-drop-right-line"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                    </section>
                    `;
            } else {
                soalTemplate += `
                        <div class="pt-3">
                            <button id="btnSimpan" disabled onclick="gameProcess()"  class="btn btn-md-arrow bg-blue w-100">
                                <p>Soal Selanjutnya</p>
                                <div class="ico">
                                    <i class="ri-arrow-drop-right-line"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                    </section>
                    `;
            }

            // Mengganti konten elemen dengan template materi
            kontainerSoal.innerHTML = soalTemplate;
        }

        $('#kontainersoal').on('change', '.jawabancheck', function () {
            // Mendapatkan nilai dari data-jawaban-check-id
            let jawabanCheckId = $(this).data('jawaban-check-id');
            $("#btnSimpan").prop('disabled', false);

            // Mengecek apakah checkbox tersebut sudah dicentang atau belum
            let isChecked = $(this).prop('checked');

            // Jika checkbox dicentang, tambahkan jawabanCheckId ke dalam array answer
            if (isChecked) {
                answer[pastSoal.length - 1] = jawabanCheckId;
            }

            // Menampilkan nilai array answer (untuk keperluan pengujian)
            // console.log(pastSoal, answer);
            $('.jawabancheck').prop('checked', false);
            $(this).prop('checked', true);
        });

        function kirimKuis() {
            // Membuat objek data yang akan dikirimkan
            var kuisId = {{$play->id}}
            var data = {
                    id_kuis: {{$play->id}},
                    pastSoal: pastSoal,
                    answer: answer
                };

                // Menggunakan AJAX untuk mengirim data ke controller
                $.ajax({
                    url: '{{ route('kuis.kirim') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        data: data
                    },
                    success: function(response) {
                        showSuccessToast('Kuis berhasil dikirim!');
                        // console.log(response);
                        window.location.href = '{{ route("riwayat.show", ["riwayat" => "1", "uuid" => ":soalId"]) }}'.replace('%3AsoalId', response.riwayat_uuid);
                    },
                    error: function(error) {
                        showErrorToast('Gagal mengirim kuis');
                        // console.error(error);
                    }
                });
        }

    </script>
@endif

@include('layouts.bottom-toast')
