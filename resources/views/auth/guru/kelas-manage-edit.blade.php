@include('layouts.headersub')

<section class="un-page-components">
    <div class="un-title-default">
        <div class="text">
            <h2>{{$stgs['pagetitle']}}</h2>
            <p>{{$stgs['subtitle'] ?? $stgs['pagetitle']}}</p>
        </div>
        <div class="un-block-right">
            <form action="{{route('kelas.destroy', ['kela' => $kelas->id])}}" method="post">
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

    <form action="{{route('kelas.update', ['kela' => $kelas->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Tingkat</label>
            <select name="tingkat" class="form-select form-control custom-select" aria-label="Default select example">
                @for ($i=1;$i <= 6;$i++)
                    <option @if($kelas->tingkat == $i) selected @endif value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label>Nama Kelas</label>
            <input name="nama_kelas" type="text" class="form-control" value="{{old('nama_kelas') ?? $kelas->nama_kelas}}" placeholder="Nama Kelas">
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
                    <p>Edit Kelas</p>
                    <div class="ico">
                        <i class="ri-arrow-drop-right-line"></i>
                    </div>
                </button>
            </div>
        </div>
    </form>

</section>

@include('layouts.footer')
