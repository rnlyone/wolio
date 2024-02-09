@include('layouts.headersub')

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Buat Soal ({{$kuis->nama}})</h2>
            <p>Daftar Semua Soal ({{$kuis->nama}}).</p>
        </div>
        <div class="un-block-right">
            <input type="hidden" id="id_kuis" name="id_kuis" value="{{$kuis->id}}">
            <a href="{{route('soal.create', ['uuidkuis' => $kuis->uuid])}}" class="icon-back visited" aria-label="iconBtn">
                <i class="ri-add-line"></i>
            </a>
        </div>
    </div>
</section>

<section class="un-details-blog">
    <div class="body">
        <div class="form-group">
            <label>Isi Soal</label>
            <div class="description">
                <div id="editor">
                    Edit Konten Disini
                </div>
            </div>
        </div>
        <div class="pt-3">
            <button id="btnSimpan" class="btn btn-md-arrow bg-green w-100">
                <p>Simpan & Lanjut</p>
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

<script>
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
    var id_kuis = $('#id_kuis').val();

    // Kirim data ke controller
    $.ajax({
        url: '{{ route('soal.store') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            content: content,
            id_kuis: id_kuis,
        },
        success: function(response) {
            if (response.error == undefined) {
                showSuccessToast('Soal Berhasil Dibuat.')
                window.location.href = '{{ route("soal.edit", ["soal" => ":soalId"]) }}'.replace(':soalId', response.data.id);
            } else {
                showErrorToast('Gagal Membuat Soal.')
            }
            console.log('Data terkirim ke controller:', response);
        },
        error: function(error) {
            showErrorToast('Gagal Membuat Soal.')
            console.error('Gagal mengirim data ke controller:', error);
        }
    });
}

// Anda dapat memanggil fungsi ini saat tombol simpan diklik atau dalam situasi lain yang sesuai
$('#btnSimpan').on('click', function() {
    sendToController();
});
</script>

@include('layouts.bottom-toast')
