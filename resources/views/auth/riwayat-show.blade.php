@include('layouts.headersub')

<div class="un-my-account">
    <div class="body">
        <div class="img-coin-eth">
            <picture>
                <source srcset="/images/quiz/{{$img}}" type="image/webp">
                <img style="width: 40vh;height:auto" src="/images/quiz/{{$img}}" alt="">
            </picture>
        </div>
        <div class="my-balance-text">
            <h2>{{$riwayat->jumlah_benar}} Benar dari 5 Soal</h2>
            <p>{{$caption}}</p>

            <a href="{{route('kategori.index', ['kuis' => 1])}}" class="btn btn-md-size effect-click border-primary rounded-pill text-primary">
                Main Lagi
            <span class="animation_clickable" style="height: 130px; width: 130px; left: 11px; top: -49px;"></span></a>
        </div>
    </div>
</div>

<section class="log-table-simple">
    <h3>Riwayat Kuis Sebelumnya</h3>
    <table class="table table-striped table-hover">
        <tbody>
            @foreach ($riwayat->user->riwayats->sortByDesc('created_at') as $riwayat)
                <tr>
                    <td><span class="text-dark">{{$riwayat->jumlah_benar}}</span> dari 5 Soal Pada {{$riwayat->created_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

@include('layouts.footer')
