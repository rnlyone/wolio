@include('layouts.header')

<section class="un-intro-card">
    <div class="un-cc-description">
        <div class="cover-image black-cover">
            <picture>
                <source srcset="/images/introcard.svg" type="image/webp">
                <img src="/images/introcard.svg" alt="image">
            </picture>
        </div>
        <div class="text-content">
            <h1>Game Bahasa Wolio</h1>
            <h2>Selamat Datang!</h2>
            <p>Ayo Eksplorasi Fitur Gebalio berikut!</p>
        </div>
    </div>
</section>

<!-- ===================================
    START THE RANDOM NFTS
==================================== -->
<section class="unSwiper-cards ">
    <div class="discover-nft-random ">
        <div class="content-NFTs-body">
            <!-- item-sm-card-NFTs -->
            <a href="{{route('kategori.index')}}" class="item-sm-card-NFTs">
                <div class="cover-image">
                    <picture>
                        <source srcset="/images/icon2.jpg" type="image/webp">
                        <img class="big-image" src="/images/icon2.jpg" alt="">
                    </picture>
                    <div class="user-text">
                        <div class="number-eth">
                            <span class="main-price">Materi</span>
                        </div>
                    </div>
                </div>
            </a>
            <!-- item-sm-card-NFTs -->
            <a href="{{route('kategori.index', ['kuis' => 1])}}" class="item-sm-card-NFTs">
                <div class="cover-image">
                    <picture>
                        <source srcset="/images/icon3.jpg" type="image/webp">
                        <img class="big-image" src="/images/icon3.jpg" alt="">
                    </picture>
                    <div class="user-text">
                        <div class="number-eth">
                            <span class="main-price">Games</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

@include('layouts.footer')
