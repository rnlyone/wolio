@include('layouts.headersub')
@include('layouts.pagetitle')
<section class="padding-20 form-edit-profile">

    <form action="{{route('kategori.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nama Kategori</label>
            <input name="nama" type="text" class="form-control" value="{{old('nama')}}" placeholder="Nama Kategori">
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
