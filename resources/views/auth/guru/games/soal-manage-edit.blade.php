@include('layouts.headersub')
<section class="un-details-blog">
    <div class="head">
    </div>
    <div class="body">
        <div class="title-blog">
            <div class="others">
                <div class="time">
                    <i class="ri-time-line"></i>
                    <span>{{$soal->created_at->diffForHumans()}}</span>
                </div>
            </div>
            <h2>{{$soal->kuis->judul}}</h2>
        </div>
        <div class="form-group">
            <label>Isi Konten</label>
            <div class="description pb-3">
                <div style="overflow-y: hidden; " id="editor">
                    {!! nl2br($soal->soal) !!}
                </div>
            </div>
            <button id="btnSimpan" type="button" class="btn effect-click w-100 btn-md-size border border-solid border-snow color-text rounded-pill">
                Simpan Soal
            </button>
        </div>
        <div class="form-group">
            <label>Audio File</label>
            <table id="audiofiles" class="w-100">
                <tr>
                    <th>Audio</th>
                    <th>Caption</th>
                </tr>
                @foreach ($audios as $audio)
                    <tr id="audio[{{$audio->id}}]">
                        <td style="width: 40%;">
                            <audio class="w-100" controls>
                                <source src="/storage/public/audios/{{$audio->audio}}" type="audio/ogg">
                            </audio>
                        </td>
                        <td style="width: 60%;"><span class="mx-1"><span style="word-break: break-word;">{{$audio->caption}}</span></span></td>
                        <td><button  data-audio-id="{{ $audio->id }}" class="delete-audio" style="width: 35px;height: 35px;display: inline-flex;align-items: center;justify-content: center;font-size: 24px;color: var(--white);background-color: rgba(255,255,255,.12);border-radius: 50%;">
                            <i class="ri-arrow-drop-right-line"></i>
                        </button></td>
                    </tr>
                @endforeach
            </table>
            <table class="w-100">
                <tr>
                    <td>
                        <div class="upload-input-form">
                            <input id="addAudio" type="file" name="audio" accept=".mp3, .aac, .wav" maxsize="5242880">
                            <div class="content-input">
                                <div class="icon"><i class="ri-upload-cloud-line"></i></div>
                                <span><span id="caption"></span>MP3, AAC, WAV. Max 5mb.</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <textarea class="form-control" name="caption" id="addCaption" cols="30" rows="3"></textarea>
                    </td>
                </tr>
            </table>
            <button id="btnTambahAudio" type="button" class="btn effect-click w-100 btn-md-size border border-solid border-snow color-text rounded-pill">
                Tambah Audio
            </button>

        </div>
        <div class="form-group">
            <label>Jawaban</label>
            <table id="jawabanfiles" class="w-100">
                <tr>
                    <th><i class="ri-checkbox-circle-line"></i></th>
                    <th>Isi Jawaban</th>
                    <th>Hapus</th>
                </tr>
                @if ($jawabans->isEmpty())
                    <tr id="ifjawabankosong">
                        <td colspan="2"  class="p-3" style="text-align: center">Masih Kosong</td>
                    </tr>
                @else
                    @foreach ($jawabans as $jawaban)
                        <tr id="jawaban[{{$jawaban->id}}]">
                            <td>
                                <div class="nav-checkbox p-1">
                                    <div class="nav-item">
                                        <div class="form-check">
                                            <input class="form-check-input jawabancheck" type="checkbox" @if ($soal->jawaban_benar == $jawaban->id) checked @endif data-jawaban-check-id="{{$jawaban->id}}" id="jawabancheck[{{$jawaban->id}}]">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 80%; justify-content:center">
                                @if ($jawaban->jenis == 'text')
                                            <div class="p-2 w-100 h-100">
                                                <label style="margin-bottom:0;">{{$jawaban->jawaban}}</label>
                                            </div>
                                @elseif ($jawaban->jenis == 'audio')
                                            <audio class="m-2 w-100" controls>
                                                <source src="/storage/public/jawabans/{{$jawaban->jawaban}}" type="audio/ogg">
                                            </audio>
                                @elseif ($jawaban->jenis == 'gambar')
                                            <img class="m-2" style="width: 50%;" src="/storage/public/jawabans/{{$jawaban->jawaban}}" alt="">
                                @endif
                            </td>
                            <td class="p-3">
                                <button data-jawaban-id="{{ $jawaban->id }}" class="delete-jawaban" style="width: 35px;height: 35px;display: inline-flex;align-items: center;justify-content: center;font-size: 24px;color: var(--white);background-color: rgba(255,255,255,.12);border-radius: 50%;">
                                    <i class="ri-arrow-drop-right-line"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
            <div class="pt-3">
                <table class="w-100">
                    <tr>
                        <th>Jenis</th>
                        <th>Isi Jawaban</th>
                    </tr>
                    <tr>
                        <td>
                            <select id="jawabanselect" class="form-select form-control custom-select" aria-label="Default select example">
                                <option id="textselect" selected="" value="text">Text</option>
                                <option id="audioselect"  value="audio">Audio</option>
                                <option id="gambarselect" value="gambar">Gambar</option>
                            </select>
                        </td>
                        <td id="jawabaninput">

                        </td>
                    </tr>
                </table>
            </div>
            <button id="btnTambahJawaban" type="button" class="btn effect-click w-100 btn-md-size border border-solid border-snow color-text rounded-pill">
                Tambah Jawaban
            </button>

        </div>
    </div>
</section>

@include('layouts.footer')

<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- Include the Quill Image Resize Module -->
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>

<!-- Initialize Quill editor -->
<script>
    $(document).ready(function () {
        changeInput();

        // Mendengarkan perubahan pada input file "addAudio"
        $('#addAudio').on('change', function () {
            // Mengambil nama file yang dipilih
            var fileName = $(this).val().split('\\').pop();

            // Menampilkan nama file di elemen "caption"
            $('#caption').text(fileName);
        });

        // Mendengarkan perubahan pada input file "addAudio"
        $('.addJawaban').on('change', function () {
            // Mengambil nama file yang dipilih
            var fileName = $(this).val().split('\\').pop();

            // Menampilkan nama file di elemen "caption"
            $('.id-caption').text(fileName);
        });

        $('.delete-audio').on('click', function () {
            var audioId = $(this).data('audio-id');

            // Konfirmasi pengguna sebelum menghapus
            if (confirm('Anda yakin ingin menghapus Audio ini?')) {
                // Kirim permintaan AJAX untuk menghapus Audio
                $.ajax({
                    url: '{{ route('audio.destroy', ['audio' => '__audio_id__']) }}'.replace('__audio_id__', audioId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        showSuccessToast('Audio berhasil dihapus.');
                        // Menghapus elemen dengan ID yang sesuai
                        $('#audio\\[' + audioId + '\\]').remove();
                    },
                    error: function (error) {
                        alert('Gagal menghapus Audio.');
                        console.error(error);
                    }
                });
            }
        });

        $('.delete-jawaban').on('click', function () {
            var jawabanId = $(this).data('jawaban-id');

            // Konfirmasi pengguna sebelum menghapus
            if (confirm('Anda yakin ingin menghapus Jawaban ini?')) {
                // Kirim permintaan AJAX untuk menghapus Jawaban
                $.ajax({
                    url: '{{ route('jawaban.destroy', ['jawaban' => '__jawaban_id__']) }}'.replace('__jawaban_id__', jawabanId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        showSuccessToast('Jawaban berhasil dihapus.');
                        // Menghapus elemen dengan ID yang sesuai
                        $('#jawaban\\[' + jawabanId + '\\]').remove();
                    },
                    error: function (error) {
                        alert('Gagal menghapus Jawaban.');
                        console.error(error);
                    }
                });
            }
        });
    });
  var quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
    imageResize: {
      displaySize: true
    },
    toolbar: [
      ['bold', 'italic', 'underline', 'strike'],
      ['image', 'blockquote', 'code-block'],
      [{ 'header': 1 }, { 'header': 2 }],
      [{ 'list': 'ordered' }, { 'list': 'bullet' }],
      ['link', 'image'],
      ['clean']
    ]
  }
  });


// Fungsi untuk mengirim data ke controller melalui AJAX
function sendToController() {
    var content = quill.root.innerHTML;

    if (contentSizeOkey(content)) {
        // Kirim data ke controller
        $.ajax({
            url: '{{ route('soal.update', ['soal' => $soal->id]) }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                content: content,
            },
            success: function(response) {
                showSuccessToast('Berhasil Mengupdate Soal.')
                console.log('Data terkirim ke controller:', response);

            },
            error: function(error) {
                showErrorToast('Gagal Mengupdate Soal.')
                console.error('Gagal mengirim data ke controller:', error);
            }
        });
    } else {
        showErrorToast('Ukuran Konten Terlalu Besar.')
    }

}

function contentSizeOkey(content) {
    // Convert the content string to bytes using TextEncoder
    var encoder = new TextEncoder('utf-8');
    var contentBytes = encoder.encode(content);

    // Check if the byte size doesn't exceed the limit (8388608 bytes)
    var maxByteSize = 8388608; // Adjust this limit as needed

    if (contentBytes.length <= maxByteSize) {
        return 1;
    } else {
        return 0;
    }
}

// Mendengarkan perubahan pada input file "addAudio"
$('#jawabanfiles').on('change', '.jawabancheck', function () {
    // uncheck semua checkbox
    $('.jawabancheck').prop('checked', false);

    // Ambil data-jawaban-check-id dari checkbox yang diubah
    var jawabanCheckId = $(this).data('jawaban-check-id');

    $.ajax({
        url: '{{ route('soal.update.jawaban', ['soal' => $soal->id]) }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            _method: 'POST',
            jawaban_benar: jawabanCheckId
        },
        success: function(response) {
            showSuccessToast('Berhasil Mengupdate Jawaban Benar.')
            console.log('Data terkirim ke controller:', jawabanCheckId, response);

        },
        error: function(error) {
            showErrorToast('Gagal Mengupdate Soal.')
            console.error('Gagal mengirim data ke controller:', error);
        }
    });

    $(this).prop('checked', true);
});

// Fungsi untuk mengirim data ke controller melalui AJAX
function SendAudioFile() {
    var file = document.getElementById('addAudio');

    if (file.files.length) {
        var audio = file.files[0];
    }

    var caption = $('#addCaption').val();

    var data = new FormData();
    data.append("_token", "{{ csrf_token() }}");
    data.append("audio", audio);
    data.append("caption", caption);

    // Send the data to the controller
    $.ajax({
        url: '{{ route('soal.add.audio', ['soal' => $soal->id]) }}',
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
            showSuccessToast('Berhasil Menambah Audio');
            console.log('Data terkirim ke controller:', response);

            var newAudioPath = response.data.audio; // Replace with the actual attribute
            var newCaption = response.data.caption; // Replace with the actual attribute
            var newAudioId = response.data.id;

            // Add audio data to the table
            addAudioToTable(newAudioPath, newCaption, newAudioId);
        },
        error: function(error) {
            showErrorToast('Gagal Menambah Audio');
            console.error('Gagal mengirim data ke controller:', error);
        }
    });
}

// Contoh penggunaan fungsi sendToController
// Anda dapat memanggil fungsi ini saat tombol simpan diklik atau dalam situasi lain yang sesuai
$('#btnSimpan').on('click', function() {
    sendToController();
});

$('#btnTambahAudio').on('click', function() {
    SendAudioFile();
});

function addAudioToTable(audioPath, caption, Id) {
    var audioElement = '<tr id="audio['+ Id +']">' +
        '<td style="width: 40%;">' +
        '<audio class="w-100" controls>' +
        '<source src="/storage/public/audios/' + audioPath + '" type="audio/ogg">' +
        '</audio>' +
        '</td>' +
        '<td style="width: 60%;"><span class="mx-1"><span style="word-break: break-word;">' + caption + '</span></span></td>' +
        '</td>' +
        '<td><button onclick="deleteAudio('+ Id +')" data-audio-id="' + Id +
        '" class="delete-audio" style="width: 35px;height: 35px;display: inline-flex;align-items: center;justify-content: center;font-size: 24px;color: var(--white);background-color: rgba(255,255,255,.12);border-radius: 50%;">' +
        '<i class="ri-arrow-drop-right-line"></i>' +
        '</button></td>' +
        '</tr>';

    $('#audiofiles').append(audioElement);
}

function deleteAudio(audioId) {

            // Konfirmasi pengguna sebelum menghapus
            if (confirm('Anda yakin ingin menghapus Audio ini?')) {
                // Kirim permintaan AJAX untuk menghapus Audio
                $.ajax({
                    url: '{{ route('audio.destroy', ['audio' => '__audio_id__']) }}'.replace('__audio_id__', audioId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        showSuccessToast('Audio berhasil dihapus.');
                        // Menghapus elemen dengan ID yang sesuai
                        $('#audio\\[' + audioId + '\\]').remove();
                    },
                    error: function (error) {
                        alert('Gagal menghapus Audio.');
                        console.error(error);
                    }
                });
            }
}

function changeInput() {
    var pilihan = $('#jawabanselect').val();

    $("#jawabaninput").empty();

    if (pilihan == 'text') {
        var htmltext = `<textarea class="form-control" name="caption" id="addJawaban" cols="30" rows="3"></textarea>`;
        $("#jawabaninput").html(htmltext);
    } else if (pilihan == 'gambar') {
        var htmlgambar = `<div class="upload-input-form">
                            <input class="addJawaban" id="addJawaban" type="file" name="gambar" accept=".jpg, .jpeg, .png, .webp" maxsize="5242880">
                            <div class="content-input">
                                <div class="icon"><i class="ri-upload-cloud-line"></i></div>
                                <span><span class="id-caption"></span>JPG, JPEG, PNG, WEBP. Max 5mb.</span>
                            </div>
                        </div>`;
        $("#jawabaninput").html(htmlgambar);
    } else {
        var htmlaudio = `<div class="upload-input-form">
                            <input class="addJawaban" id="addJawaban" type="file" name="audio" accept=".mp3, .aac, .wav" maxsize="5242880">
                            <div class="content-input">
                                <div class="icon"><i class="ri-upload-cloud-line"></i></div>
                                <span><span class="id-caption"></span>MP3, AAC, WAV. Max 5mb.</span>
                            </div>
                        </div>`;
        $("#jawabaninput").html(htmlaudio);
    }
}

// Mendengarkan perubahan pada input file "addAudio"
$('#jawabaninput').on('change', '.addJawaban', function () {
    // Mengambil nama file yang dipilih
    var fileName = $(this).val().split('\\').pop();

    // Menampilkan nama file di elemen "id-caption"
    $('.id-caption').html(fileName);
});



function addJawabanToTable(Jawaban, jenis, Id) {
    $jawabanElement = `<tr id="jawaban[`+ Id +`]">
                            <td>
                                <div class="nav-checkbox p-1">
                                    <div class="nav-item">
                                        <div class="form-check">
                                            <input data-jawaban-check-id="`+ Id +`" class="form-check-input jawabancheck" type="checkbox" id="jawabancheck[`+ Id +`]">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 80%; justify-content:center">`
    if (jenis == 'text') {
        $jawabanElement = $jawabanElement + `<div class="p-2 w-100 h-100">
                                                <label style="margin-bottom:0;">`+Jawaban+`</label>
                                            </div>`
    } else if (jenis == `audio`) {
        $jawabanElement = $jawabanElement + `<audio class="m-2 w-100" controls>
                                                <source src="/storage/public/jawabans/`+Jawaban+`" type="audio/ogg">
                                            </audio>`
    } else if (jenis == 'gambar') {
        $jawabanElement = $jawabanElement + `<img class="m-2" style="width: 50%;" src="/storage/public/jawabans/`+Jawaban+`" alt="">`
    }
    $jawabanElement = $jawabanElement + `</td>
                            <td class="p-3">
                                <button onclick="deleteJawaban(`+ Id +`)" class="delete-jawaban" style="width: 35px;height: 35px;display: inline-flex;align-items: center;justify-content: center;font-size: 24px;color: var(--white);background-color: rgba(255,255,255,.12);border-radius: 50%;">
                                    <i class="ri-arrow-drop-right-line"></i>
                                </button>
                            </td>
                        </tr>`

    $('#jawabanfiles').append($jawabanElement);
}

// Fungsi untuk mengirim data ke controller melalui AJAX
function SendJawabanFile() {
    var pilihan = $('#jawabanselect').val();

    var data = new FormData();
    data.append("_token", "{{ csrf_token() }}");

    if (pilihan == 'text') {
        var caption = $('#addJawaban').val();
        data.append("caption", caption);
    } else {
        var file = document.getElementById('addJawaban');
        if (file.files.length) {
            var files = file.files[0];
        }
        data.append("files", files);
    }
        data.append("jenis", pilihan);

    // Send the data to the controller
    $.ajax({
        url: '{{ route('soal.add.jawaban', ['soal' => $soal->id]) }}',
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
            // Check if the element with ID 'ifjawabankosong' exists
            if ($('#ifjawabankosong').length > 0) {
                $('#ifjawabankosong').remove();
            }
            showSuccessToast('Berhasil Menambah Jawaban');
            console.log('Data terkirim ke controller:', response);
            addJawabanToTable(response.data.jawaban, response.data.jenis, response.data.id);
        },
        error: function(error) {
            showErrorToast('Gagal Menambah Jawaban');
            console.error('Gagal mengirim data ke controller:', error);
        }
    });
}

$('#jawabanselect').on('change', function () {
    changeInput();
})

$('#btnTambahJawaban').on('click', function() {
    SendJawabanFile();
});

function deleteJawaban(JawabanId) {
    // Konfirmasi pengguna sebelum menghapus
    if (confirm('Anda yakin ingin menghapus Jawaban ini?')) {
        // Kirim permintaan AJAX untuk menghapus Jawaban
        $.ajax({
            url: '{{ route('jawaban.destroy', ['jawaban' => '__jawaban_id__']) }}'.replace('__jawaban_id__', JawabanId),
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                showSuccessToast('Jawaban berhasil dihapus.');
                // Menghapus elemen dengan ID yang sesuai
                $('#jawaban\\[' + JawabanId + '\\]').remove();
            },
            error: function (error) {
                alert('Gagal menghapus Audio.');
                console.error(error);
            }
        });
    }
}
</script>

@include('layouts.bottom-toast')
