<style>
    .description {
        max-width: 100%; /* Set the maximum width to the size of the container */
    }

    .description img {
        max-width: 100%; /* Set the maximum width of images to 100% of the container width */
        height: auto; /* Maintain the aspect ratio of the images */
    }
</style>
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
        </div>
        <div class="description">
            {!! nl2br($materi->konten) !!}
        </div>
        @if ($audios->isNotEmpty())
            <div class="form-group pt-3">
                <table id="audiofiles" class="w-100"  style="border: 1px">
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
                            <tr>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <div class="bok-next-prev margin-t-40 margin-b-40">
            @if ($other['prev'] != null)
                <a href="{{route('materi.show', ['materi' => $other['prev']])}}" class="prev">
            @else
                <a class="prev visited" @disabled(true)>
            @endif
                <span>Materi Sebelumnya</span>
                <div class="icon">
                    <i class="ri-arrow-left-line"></i>
                </div>
            </a>
            @if ($other['next'] != null)
                <a href="{{route('materi.show', ['materi' => $other['next']])}}" class="next">
            @else
                <a class="next visited" @disabled(true)>
            @endif
                <div class="icon">
                    <i class="ri-arrow-right-line"></i>
                </div>
                <span>Materi Selanjutnya</span>
            </a>
        </div>
    </div>
    {{-- <div class="footer">
        <div class="un-title-default px-0 margin-b-20">
            <div class="text">
                <h2>Materi Terbaru</h2>
            </div>
            <div class="un-block-right">
                <a href="{{route('materi.index')}}" class="icon-back visited" aria-label="iconBtn">
                    <i class="ri-arrow-drop-right-line"></i>
                </a>
            </div>
        </div>
        <ul class="nav flex-column">
            @foreach ($latest as $materi)
            <article class="nav-item item-blog-list">
                <a class="nav-link" href="{{route('materi.show', ['materi' => $materi->id])}}">
                    <div class="image-blog">
                        <div class="text-blog">
                            <h2>{{$materi->judul}}</h2>
                            <div class="others">
                                <div class="time">
                                    <i class="ri-time-line"></i>
                                    <span>{{$materi->created_at->diffForHumans()}}</span>
                                </div>
                                <div class="views">
                                    <i class="ri-file-copy-line"></i>
                                    <span>{{$materi->kategori->nama}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </ul>
    </div> --}}
</section>

@include('layouts.footer')
