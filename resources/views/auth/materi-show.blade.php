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
                <table id="audiofiles" class="w-100">
                    <tr>
                        <th>Audio</th>
                        <th>Caption</th>
                    </tr>
                    @foreach ($audios as $audio)
                        <tr>
                            <td style="width: 40%;">
                                <audio class="w-100" controls>
                                    <source src="/storage/public/audios/{{$audio->audio}}" type="audio/ogg">
                                </audio>
                            </td>
                            <td><span class="mx-1"><span style="word-break: break-word;">{{$audio->caption}}</span></span></td>
                        </tr>
                    @endforeach
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
    <div class="footer">
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
    </div>
</section>

@include('layouts.footer')
