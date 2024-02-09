
<script>
    // Fungsi untuk menampilkan pesan toast sukses
function showSuccessToast(message) {
    let toast = `
        <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center place__top w-100">
        <div id="liveToastSuccess" class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true"
            data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-body">
            <div class="icon color-white">
                <i class="ri-checkbox-circle-fill"></i>
            </div>
            <div class="content">
                <div class="display__text">
                <p class="text-white">${message}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                <i class="ri-close-fill"></i>
            </button>
            </div>
        </div>
        </div>
    `;

    $('body').append(toast);
    $('.toast').toast('show');
}

// Fungsi untuk menampilkan pesan toast error
function showErrorToast(message) {
    let toast = `
        <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center place__top w-100">
        <div id="liveToastError" class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true"
            data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-body">
            <div class="icon color-white">
                <i class="ri-alert-fill"></i>
            </div>
            <div class="content">
                <div class="display__text">
                <p class="text-white">${message}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close">
                <i class="ri-close-fill"></i>
            </button>
            </div>
        </div>
        </div>
    `;

    $('body').append(toast);
    $('.toast').toast('show');
}
</script>
