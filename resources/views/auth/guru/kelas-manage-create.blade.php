@include('layouts.headersub')
@include('layouts.pagetitle')

<section class="padding-20 form-edit-profile">

    <form action="{{route('kelas.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Tingkat</label>
            <select name="tingkat" class="form-select form-control custom-select" aria-label="Default select example">
                @for ($i=1;$i <= 6;$i++)
                    <option @if(old('tingkat') == $i) selected @endif value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label>Nama Kelas</label>
            <input name="nama_kelas" type="text" class="form-control" value="{{old('nama_kelas')}}" placeholder="Nama Kelas">
            <div class="size-11 color-text form-text">Nama kelas yang akan tampil</div>
        </div>
        <div class="space-sticky-footer mb-5 zindex-sticky"></div>
        <div class="footer footer-pages-forms mb-5" style="z-index: 90;">
            <div class="content">
                <div class="links-clear-data">
                        <a href="{{route('kelas.index')}}" class="btn link-clear visited">
                            <i class="ri-close-circle-line"></i>
                            <span>Cancel</span>
                        </a>
                </div>
                <button type="submit" class="btn btn-bid-items">
                    <p>Buat Kelas</p>
                    <div class="ico">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </button>
            </div>
        </div>
    </form>

</section>

@include('layouts.footer')
