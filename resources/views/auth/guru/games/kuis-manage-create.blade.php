@include('layouts.headersub')
<section class="un-details-blog">
    <div class="head">
    </div>
    <div class="body">
        <div class="title-blog">
            <div class="pt-3">
                <div class="form-group">
                    <label>Judul Kuis</label>
                    <input id="nama" name="nama" type="text" class="form-control" placeholder="Judul" value="{{old('nama')}}">
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

// Fungsi untuk mengirim data ke controller melalui AJAX
function sendToController() {
    var nama = $('#nama').val();
    var kategori = $('#kategori').val();


    if (kategori == "") {
        showErrorToast('Gagal Mengupdate Kuis.');
        return;
    }

    // Kirim data ke controller
    $.ajax({
        url: '{{ route('kuis.store') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            nama: nama,
            kategori: kategori
        },
        success: function(response) {
            showSuccessToast('Berhasil Menyimpan Kuis.')
            console.log('Data terkirim ke controller:', response);
            window.location.href = '{{ route("kuis.show", ["kui" => ":kuisId"]) }}'.replace(':kuisId', response.data.id);
        },
        error: function(error) {
            showErrorToast('Gagal Mengupdate Kuis.')
            // console.error('Gagal mengirim data ke controller:', error);
        }
    });
}

// Anda dapat memanggil fungsi ini saat tombol simpan diklik atau dalam situasi lain yang sesuai
$('#btnSimpan').on('click', function() {
    sendToController();
});
</script>

@include('layouts.bottom-toast')
