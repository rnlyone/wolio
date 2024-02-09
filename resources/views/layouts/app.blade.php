<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="format-detection" content="telephone=no">
    <!-- <meta name="theme-color" content="#ffffff"> -->
    <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#222032" media="(prefers-color-scheme: dark)">
    <title>{{$stgs['nama_aplikasi']}} {{$stgs['title']}}</title>
    <meta name="description" content="{{$stgs['nama_aplikasi']}} : {{$stgs['title']}}">
    <meta name="keywords"
        content="gakuensai, festival, expo, competition, pwa" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- FAVICON -->
    {{-- <link rel="icon" type="image/png" href="/images/favicon/icon-32x32.png" sizes="32x32">
    <!-- IOS SUPPORT -->
    <link rel="apple-touch-icon" href="/images/favicon/icon-96x96.png"> --}}
    <!-- CSS FILES -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/remixicon.min.css">
    <link rel="stylesheet" href="/assets/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/vendors/zuck_stories/zuck.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    {{-- <link rel="manifest" href="/_manifest.json" /> --}}

    @if ($stgs['title'] == ": Checkout")
        <script type="text/javascript"
        src="https://app.midtrans.com/snap/snap.js"
        data-client-key="Mid-client-RdCe7DpdZjjuWmB7"></script>
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if ($stgs['title'] == ": Ticket")
    <script>
        window.addEventListener( "pageshow", function ( event ) {
            var historyTraversal = event.persisted ||
                                    ( typeof window.performance != "undefined" &&
                                        window.performance.navigation.type === 2 );
            if ( historyTraversal ) {
                // Handle page restore.
                window.location.reload();
            }
        });
    </script>
    @endif


    {{-- <script>
        // Disable right-click
        document.addEventListener('contextmenu', (e) => e.preventDefault());

        function ctrlShiftKey(e, keyCode) {
        return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
        }

        document.onkeydown = (e) => {
        // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
        if (
            event.keyCode === 123 ||
            ctrlShiftKey(e, 'I') ||
            ctrlShiftKey(e, 'J') ||
            ctrlShiftKey(e, 'C') ||
            (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
        )
            return false;
        };
    </script> --}}

    @laravelPWA

    <style>
        {{$stgs['customcss']}}
    </style>

</head>
