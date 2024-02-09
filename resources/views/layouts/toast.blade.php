
@if (session()->get('sukses'))
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center place__top w-100">
        <div id="liveToastFive" class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true"
            data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-body">
                <div class="icon color-white">
                    <i class="ri-error-warning-fill"></i>
                </div>
                <div class="content">
                    <div class="display__text">
                        <p class="text-white">{{session('sukses')}}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                    <i class="ri-close-fill"></i>
                </button>
            </div>
        </div>
    </div>
    <script>
    window.onload = (event) => {
        var toastElList = [].slice.call(document.querySelectorAll('#liveToastFive'))
            var toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl)
            });
            toastList.forEach(toast => toast.show());
    }
    </script>
@endif


@if (session()->get('gagal'))
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center place__top w-100">
        <div id="liveToastFive" class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true"
            data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-body">
                <div class="icon color-white">
                    <i class="ri-error-warning-fill"></i>
                </div>
                <div class="content">
                    <div class="display__text">
                        <p class="text-white">{{session('gagal')}}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                    <i class="ri-close-fill"></i>
                </button>
            </div>
        </div>
    </div>
    <script>
    window.onload = (event) => {
        var toastElList = [].slice.call(document.querySelectorAll('#liveToastFive'))
            var toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl)
            });
            toastList.forEach(toast => toast.show());
    }
    </script>
@endif

@if (session()->get('warning'))
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center place__top w-100">
        <div id="liveToastFive" class="toast bg-warning" role="alert" aria-live="assertive" aria-atomic="true"
            data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-body">
                <div class="icon color-white">
                    <i class="ri-error-warning-fill"></i>
                </div>
                <div class="content">
                    <div class="display__text">
                        <p class="text-white">{{session('warning')}}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                    <i class="ri-close-fill"></i>
                </button>
            </div>
        </div>
    </div>
    <script>
    window.onload = (event) => {
        var toastElList = [].slice.call(document.querySelectorAll('#liveToastFive'))
            var toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl)
            });
            toastList.forEach(toast => toast.show());
    }
    </script>
@endif

@if ($errors->any())
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center place__top w-100">
    <div id="liveToastFive" class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true"
        data-bs-autohide="true" data-bs-delay="3000">
        <div class="toast-body">
            <div class="icon color-white">
                <i class="ri-error-warning-fill"></i>
            </div>
            <div class="content">
                <div class="display__text">
                    <p class="text-white">{{$errors->first()}}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                <i class="ri-close-fill"></i>
            </button>
        </div>
    </div>
</div>
<script>
window.onload = (event) => {
    var toastElList = [].slice.call(document.querySelectorAll('#liveToastFive'))
        var toastList = toastElList.map(function (toastEl) {
            return new bootstrap.Toast(toastEl)
        });
        toastList.forEach(toast => toast.show());
}
</script>
@endif

