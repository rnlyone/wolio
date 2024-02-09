@include('layouts.app')

<body>
    <!-- ===================================
      START LODAER PAGE
    ==================================== -->
    <section class="loader-page" id="loaderPage">
        <div class="spinner_flash"></div>
    </section>
    <!-- START WRAPPER -->
    <div id="wrapper">
        <!-- START CONTENT -->
        <div id="content">
            <!-- ===================================
              START THE HEADER
            ==================================== -->

            <header class="default heade-sticky">
                <div class="un-title-page go-back">
                        @if (isset($stgs['prevpage']))
                            <a href="{{$stgs['prevpage']}}" class="icon visited">
                                <i class="ri-arrow-drop-left-line"></i>
                            </a>
                        @else
                            <a href="javascript:history.back()" class="icon visited">
                                <i class="ri-arrow-drop-left-line"></i>
                            </a>
                        @endif
                    <h1>{{$stgs['pagetitle']}}</h1>
                </div>
            </header>

            <div class="space-sticky"></div>
