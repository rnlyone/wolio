@include('layouts.header')

<section class="account-section padding-20">
    <div class="display-title">
        @if (Session::get('pesantix') == null)
            <h1>Selamat Datang!! 😆</h1>
        @endif
        <p>Masuk dengan akun Wolio App</p>
    </div>
    <div class="content__form margin-t-24">
        <form id="loginform" action="{{route('login')}}" method="POST">
            @csrf
            <div class="form-group icon-left">
                <label>Username</label>
                <div class="input_group">
                    <input name="username" type="username" class="form-control" placeholder="e. g. &quot;example@mail.com&quot;"
                        required="">
                    <div class="icon">
                        <i class="ri-mail-open-line"></i>
                    </div>
                </div>
            </div>
            <div class="form-group icon-left">
                <label>Password</label>
                <div class="input_group">
                    <input name="password" type="password" class="form-control" placeholder="e. g. &quot;John$99*04&quot;" required="">
                    <div class="icon">
                        <i class="ri-lock-password-line"></i>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<footer class="footer-account">
    <div class="env-pb">
        <div class="display-actions">
            <a href="#" onclick="document.getElementById('loginform').submit()" class="btn btn-sm-arrow bg-primary visited">
                <p>Sign In</p>
                <div class="ico">
                    <i class="ri-arrow-drop-right-line"></i>
                </div>
            </a>
        </div>
    </div>
</footer>

    </div>
    <!-- ===================================
      START THE MODAL SIDEBAR MENU - CONNECTED
    ==================================== -->
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

