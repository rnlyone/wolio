@include('layouts.headersub')
<section class="un-details-blog">
    <div class="head">
    </div>
    <div class="body">
        <div class="title-blog">
            <div class="pt-3">
                <div class="form-group">
                    <label>Judul Materi</label>
                    <input id="judul" name="judul" type="text" class="form-control" placeholder="Judul" value="{{old('judul')}}" pattern="[a-z0-9_.-]+">
                    <div class="size-11 color-text form-text">Judul hanya dapat diisi oleh huruf, angka, titik, _ dan -</div>
                </div>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select id="kategori" name="kategori" class="form-select form-control custom-select" aria-label="Default select example">
                    <option value="">Pilih kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option @if(old('kategori') == $kategori->id) selected @endif value="{{$kategori->id}}">{{$kategori->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Isi Konten</label>
            <div class="description">
                <div id="editor">
                    Edit Konten Disini
                </div>
            </div>
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
    var judul = $('#judul').val();
    var kategori = $('#kategori').val();

    // Kirim data ke controller
    $.ajax({
        url: '{{ route('materi.store') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            content: content,
            judul: judul,
            kategori: kategori
        },
        success: function(response) {
            showSuccessToast('Berhasil Menyimpan Materi.')
            console.log('Data terkirim ke controller:', response);
            window.location.href = '{{ route("materi.edit", ["materi" => ":materiId"]) }}'.replace(':materiId', response.data.id);
        },
        error: function(error) {
            showErrorToast('Gagal Mengupdate Materi.')
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
