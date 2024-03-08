@include('layouts.headersub')
<section class="un-details-blog">
    <div class="head">
    </div>
    <div class="body">
        <div class="title-blog">
            <div class="others">
                <div class="time">
                    <i class="ri-time-line"></i>
                    <span>{{$materi->created_at->diffForHumans()}}</span>
                </div>
            </div>
            <h2>{{$materi->judul}}</h2>
            <div class="pt-3">
                <div class="form-group">
                    <label>Judul Materi</label>
                    <input id="judul" name="judul" type="text" class="form-control" placeholder="username" value="{{old('judul') ?? $materi->judul}}" pattern="[a-z0-9_.-]+">
                    <div class="size-11 color-text form-text">Judul hanya dapat diisi oleh huruf, angka, titik, _ dan -</div>
                </div>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select id="kategori" name="kategori" class="form-select form-control custom-select" aria-label="Default select example">
                    <option value="">Pilih kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option @if(old('kategori') ?? $materi->id_kategori == $kategori->id) selected @endif value="{{$kategori->id}}">{{$kategori->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Isi Konten</label>
            <div class="description">
                <div id="editor">
                    {!! nl2br($materi->konten) !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Audio File</label>
            <table id="audiofiles" class="w-100">
                <thead>
                    <tr>
                        <th style="border: 1px; color:var(--dark);">Aksara</th>
                        <th style="border: 1px; color:var(--dark);">Audio</th>
                        <th style="border: 1px; color:var(--dark);">Latin</th>
                        <th style="border: 1px; color:var(--dark);">Arti</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($audios as $audio)
                        <tr id="audio[{{$audio->id}}]">
                            <td  style="width: 30%; border: 1px; color:var(--dark);"><span class="mx-1"><span style="word-break: break-word;">{{$audio->aksara}}</span></span></td>
                            <td style="width: 10%; border: 1px; color:var(--dark);">
                                <audio id="player{{$audio->id}}" class="w-100"  style="visibility:visible">
                                    <source src="/storage/public/audios/{{$audio->audio}}" type="audio/ogg">
                                </audio>
                                <div style="padding: 10px;min-width:100%" class="btn btn-sm-arrow bg-dark">
                                    <button class="ico play-button" id="play{{$audio->id}}" onclick="document.getElementById('player{{$audio->id}}').play();"><i class="ri-play-fill"></i></button>
                                </div>
                            </td>
                            <td  style="width: 30%; border: 1px; color:var(--dark);"><span class="mx-1"><span style="word-break: break-word;">{{$audio->latin}}</span></span></td>
                            <td style="width: 30%; border: 1px; color:var(--dark);"><span class="mx-1"><span style="word-break: break-word;">{{$audio->caption}}</span></span></td>
                            <td><button  data-audio-id="{{ $audio->id }}" class="delete-audio" style="width: 35px;height: 35px;display: inline-flex;align-items: center;justify-content: center;font-size: 24px;color: var(--white);background-color: rgba(255,255,255,.12);border-radius: 50%;">
                                <i class="ri-delete-bin-line"></i>
                            </button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="w-100">
                <tr>
                    <td rowspan="3" style="width: 40%">
                        <div class="upload-input-form">
                            <input id="addAudio" type="file" name="audio" accept=".mp3, .aac, .wav" maxsize="5242880">
                            <div class="content-input" style="padding:25% 20px">
                                <div class="icon"><i class="ri-upload-cloud-line"></i></div>
                                <span><span id="audiofilename" style="word-break: break-word;"></span>MP3, AAC, WAV. Max 5mb.</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <input class="form-control" name="aksara" id="addAksara" placeholder="Aksara">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="form-control" name="latin" id="addLatin" placeholder="Latin">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="form-control" name="caption" id="addCaption" placeholder="Arti">
                    </td>
                </tr>
            </table>
            <button id="btnTambahAudio" type="button" class="btn effect-click w-100 btn-md-size border border-solid border-snow color-text rounded-pill">
                Tambah Audio
            </button>

        </div>
        <div class="pt-3">
            <button id="btnSimpan" class="btn btn-md-arrow bg-green w-100">
                <p>Simpan</p>
                <div class="ico">
                    <i class="ri-arrow-drop-right-line"></i>
                </div>
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
        // Mendengarkan perubahan pada input file "addAudio"
        $('#addAudio').on('change', function () {
            // Mengambil nama file yang dipilih
            var fileName = $(this).val().split('\\').pop();
            console.log('adf');

            // Menampilkan nama file di elemen "caption"
            $('#audiofilename').text(fileName);
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
    var judul = $('#judul').val();
    var kategori = $('#kategori').val();

    // Kirim data ke controller
    $.ajax({
        url: '{{ route('materi.update', ['materi' => $materi->id]) }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            _method: 'PUT',
            content: content,
            judul: judul,
            kategori: kategori
        },
        success: function(response) {
            showSuccessToast('Berhasil Menyimpan Materi.')
            console.log('Data terkirim ke controller:', response);

        },
        error: function(error) {
            showErrorToast('Gagal Mengupdate Materi.')
            console.error('Gagal mengirim data ke controller:', error);
        }
    });
}

// Fungsi untuk mengirim data ke controller melalui AJAX
function SendAudioFile() {
    var file = document.getElementById('addAudio');

    if (file.files.length) {
        var audio = file.files[0];
    }

    var caption = $('#addCaption').val();
    var latin = $('#addLatin').val();
    var aksara = $('#addAksara').val();

    var data = new FormData();
    data.append("_token", "{{ csrf_token() }}");
    data.append("audio", audio);
    data.append("caption", caption);
    data.append("aksara", aksara);
    data.append("latin", latin);

    // Send the data to the controller
    $.ajax({
        url: '{{ route('materi.add.audio', ['materi' => $materi->id]) }}',
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
            showSuccessToast('Berhasil Menambah Audio');
            console.log('Data terkirim ke controller:', response);

            var newAudioPath = response.data.audio; // Replace with the actual attribute
            var newCaption = response.data.caption; // Replace with the actual attribute
            var newAksara = response.data.aksara; // Replace with the actual attribute
            var newLatin = response.data.latin; // Replace with the actual attribute
            var newAudioId = response.data.id;

            // Add audio data to the table
            addAudioToTable(newAudioPath, newCaption, newAksara, newLatin, newAudioId);
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

function addAudioToTable(audioPath, caption, aksara, latin, Id) {
    var audioElement =
        `<tr id="audio[`+ Id +`]">`+
        `<td style="width: 30%; border: 1px; color:var(--dark);"><span class="mx-1"><span style="word-break: break-word;">` + caption + `</span></span></td>`+
        `<td style="width: 10%; border: 1px; color:var(--dark);">`+
        `<audio id="player{{$audio->id}}" class="w-100"  style="visibility:visible">`+
        `<source src="/storage/public/audios/`+ audioPath + `" type="audio/ogg">`+
        `</audio>`+
        `<div style="padding: 10px;min-width:100%" class="btn btn-sm-arrow bg-dark">`+
        `<button class="ico play-button" id="play{{$audio->id}}" onclick="document.getElementById('player{{$audio->id}}').play();"><i class="ri-play-fill"></i></button>`+
        `</div>`+
        `</td>`+
        `<td  style="width: 30%; border: 1px; color:var(--dark);"><span class="mx-1"><span style="word-break: break-word;">` + aksara + `</span></span></td>`+
        `<td  style="width: 30%; border: 1px; color:var(--dark);"><span class="mx-1"><span style="word-break: break-word;">` + latin + `</span></span></td>`+
        `<td><button onclick="deleteAudio(`+ Id +`)" data-audio-id="`+ Id +`" class="delete-audio" style="width: 35px;height: 35px;display: inline-flex;align-items: center;justify-content: center;font-size: 24px;color: var(--white);background-color: rgba(255,255,255,.12);border-radius: 50%;">`+
        `<i class="ri-delete-bin-line"></i>`+
        `</button></td>`+
        `</tr>`
        ;

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
</script>

@include('layouts.bottom-toast')
