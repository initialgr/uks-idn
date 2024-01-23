<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Halaman Tidak ada</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('template/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('template/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('template/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('template/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="row">
        <div class="col-md-12">

            <section class="section error-404 d-flex flex-column align-items-center justify-content-center mt-5">
                <h1>404</h1>
                <h2>Halaman tidak ditemukan.</h2>
                <a class="btn" href="{{ route('home') }}">Kembali</a>
                <img src="{{ asset('template/assets/img/not-found.svg') }}" height="200px" class="mt-5">
            </section>

        </div>
    </div><!-- End #main -->

    <!-- Vendor JS Files -->
    <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
