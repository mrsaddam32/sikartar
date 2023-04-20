<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="https://static-00.iconduck.com/assets.00/laravel-icon-497x512-uwybstke.png">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-white">
      <div class="container">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </div>
        </div>
      </div>
    </nav>
    <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://static-00.iconduck.com/assets.00/laravel-icon-497x512-uwybstke.png" alt="" width="120" height="120">
        <h1 class="display-5 fw-bold text-body-emphasis">SIKARTAR</h1>
        <h3 class="text-dark fs-5 fw-light">(Sistem Informasi Karang Taruna)</h3>
        <div class="col-lg-6 mx-auto">
          <p class="lead mb-4">
            <span class="fw-bold">SIKARTAR</span> adalah sebuah website yang dibuat untuk memudahkan pengelolaan data, laporan, dan informasi Karang Taruna.
          </p>
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <a href="{{ route('auth.login') }}" class="btn btn-primary btn-lg px-4 gap-3 rounded-pill">Login</a>
          </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>