<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="https://static-00.iconduck.com/assets.00/laravel-icon-497x512-uwybstke.png">
    <style>
      .navbar {
        height: 68px;
        position: relative;
        z-index: 1;
      }
      
      /* Carousel base class */
      .carousel {
        margin-bottom: 4rem;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 0;
        background-color: rgba(0, 0, 0, 0.8);
      }
      /* Since positioning the image, we need to help out the caption */
      .carousel-caption {
        bottom: 3rem;
        z-index: 10;
      }
      /* Declare heights because of positioning of img element */
      .carousel-item {
        height: 37rem;
      }

      .carousel-item img {
        object-fit: cover;
        width: 100%;
        height: 100%;
      }
    </style>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg bg-transparent">
        <div class="container">
          <a class="navbar-brand text-white fw-bold" href="#">{{ config('app.name') }}</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <a class="nav-link text-white active" aria-current="page" href="#">Home</a>
              <a class="nav-link text-white active" aria-current="page" href="#">Visi & Misi</a>
              <a class="nav-link text-white active" aria-current="page" href="#">Sejarah</a>
              <div class="d-flex align-items-center">
                <a href="{{ route('auth.login') }}" class="btn btn-primary me-3">
                  Login
                </a>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <main>
      <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel" data-bs-theme="light">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://source.unsplash.com/random/1440x1440/?abstract-dark" class="bd-placeholder-img"/>
            <div class="container">
              <div class="carousel-caption text-start">
                <h1>Example headline.</h1>
                <p class="opacity-75">Some representative placeholder content for the first slide of the carousel.</p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://source.unsplash.com/random/1440x1440/?abstract-dark" class="bd-placeholder-img"/>
            <div class="container">
              <div class="carousel-caption">
                <h1>Another example headline.</h1>
                <p>Some representative placeholder content for the second slide of the carousel.</p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://source.unsplash.com/random/1440x1440/?abstract-dark" class="bd-placeholder-img"/>
            <div class="container">
              <div class="carousel-caption text-end">
                <h1>One more for good measure.</h1>
                <p>Some representative placeholder content for the third slide of this carousel.</p>
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>      
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>