@include('layouts.headersub')

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>Edit Kategori</h2>
            <p>Edit Kategori</p>
        </div>
        <div class="un-block-right">
            <form action="{{route('kategori.destroy', ['kategori' => $kategori->id])}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus Kategori ini?')" class="icon-back visited" aria-label="iconBtn">
                    <i class="ri-delete-bin-line"></i>
                </button>
            </form>
        </div>
    </div>
</section>

<section class="padding-20 form-edit-profile">

    <form action="{{route('kategori.update', ['kategori' => $kategori->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Kategori</label>
            <input name="nama" type="text" class="form-control" value="{{old('nama') ?? $kategori->nama}}" placeholder="Nama Kategori">
            <div class="size-11 color-text form-text">Nama Kategori yang akan tampil</div>
        </div>
        <div class="space-sticky-footer mb-5 zindex-sticky"></div>
        <div class="footer footer-pages-forms mb-5" style="z-index: 90;">
            <div class="content">
                <div class="links-clear-data">
                        <a href="{{route('kategori.manage')}}" class="btn link-clear visited">
                            <i class="ri-close-circle-line"></i>
                            <span>Cancel</span>
                        </a>
                </div>
                <button type="submit" class="btn btn-bid-items">
                    <p>Buat Kategori</p>
                    <div class="ico">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </button>
            </div>
        </div>
    </form>

</section>

@include('layouts.footer')
