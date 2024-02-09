        <!-- ===================================
          START THE BOTTOM NAVIGATION
        ==================================== -->
        @include('layouts.navigator')
    </div>
    <!-- ===================================
      START THE MODAL SIDEBAR MENU - CONNECTED
    ==================================== -->
        @include('layouts.sidebar')
        @include('layouts.toast')
    <!-- ===================================
      START STATUS CONNECTION
    ==================================== -->
    <div class="d-flex justify-content-center">
        <div class="toast status-connection" role="alert" aria-live="assertive" aria-atomic="true"></div>
    </div>


    @include('layouts.jses')

</body>

</html>
