<!doctype html>
<html lang="en" id="home">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="https://static-00.iconduck.com/assets.00/laravel-icon-497x512-uwybstke.png">
    <link rel="stylesheet" href="{{ asset('dist/css/lightbox.css') }}">
    <style>
      section:not(.visi_misi) {
        height: 100vh;
      }

      .navbar {
        height: 68px;
        z-index: 1;
      }
      
      /* Carousel base class */
      .carousel {
        margin-top: -68px;
        margin-bottom: 4rem;
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
          <a class="navbar-brand text-white fw-bold" href="#home">{{ config('app.name') }}</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
              <a class="nav-link text-white active" aria-current="page" href="#home">Home</a>
              <a class="nav-link text-white active" aria-current="page" href="#visi_misi">Visi & Misi</a>
              <a class="nav-link text-white active" aria-current="page" href="#galeri">Galeri</a>
              <a class="nav-link text-white active" aria-current="page" href="#kegiatan">Kegiatan</a>
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
      <section class="visi_misi pt-5 mb-5" id="visi_misi">
        <div class="container">
          <div class="row text-center fw-bold mb-4">
            <div class="col">
              <h2>
                Visi & Misi
              </h2>
              <hr class="w-50 mx-auto my-4">
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <h2 class="text-center">Visi</h2>
              <p class="text-justify">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores cupiditate, beatae at porro atque nulla doloribus aliquam doloremque veniam quod blanditiis! Odio corrupti numquam ad recusandae a similique iusto dolorum, quibusdam placeat. Nulla perspiciatis natus quae vero dolor earum? Nesciunt incidunt cumque ullam numquam a saepe, obcaecati sapiente aperiam amet!
              </p>
            </div>
            <div class="col-lg-6">
              <h2 class="text-center">Misi</h2>
              <p class="text-justify">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati, et iste? Quasi ex voluptatum adipisci dolorum esse reiciendis delectus, magni qui eius, excepturi, expedita laborum odit. Dolorum, ex porro unde corporis pariatur voluptates eaque voluptatibus vel saepe cum consectetur quaerat tempora itaque, eligendi ipsa impedit rerum nostrum debitis earum quae!
              </p>
            </div>
          </div>
        </div>
      </section>
      <section class="galeri pt-5" id="galeri">
        <div class="container">
          <div class="row text-center fw-bold mb-4">
            <h2>
              Galeri
            </h2>
            <hr class="w-50 mx-auto my-4">
          </div>
          <div class="row">
            @if ($images->count() > 0)
              @foreach ($images as $image)
                <div class="col-lg-3">
                  <a href="{{ asset($image->image_path) }}" data-lightbox="image-1" data-title="{{ $image->image_description }}">
                    <img src="{{ asset($image->image_path) }}" class="img-fluid mb-2" alt="{{ $image->image_description }}" />  
                  </a>
                </div>
              @endforeach
            @else
              <div class="col-lg-12">
                <h3 class="text-center">There's no images.</h3>
              </div>
            @endif
          </div>
        </div>
      </section>
      <section class="kegiatan pt-5" id="kegiatan">
        <div class="container">
          <div class="row text-center fw-bold mb-4">
            <h2>
              Kegiatan
            </h2>
            <hr class="w-50 mx-auto my-4">
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="accordion" id="accordionExample">
                @foreach ($activities as $key => $activity)
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="{{ $key === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $key }}">
                        {{ $activity->activity_name }}
                      </button>
                    </h2>
                    <div id="collapse{{ $key }}" class="accordion-collapse collapse {{ $key === 0 ? 'show' : '' }}" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        {{ $activity->activity_description }}
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
    <div class="container-fluid">
      <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-1">
          <li class="nav-item"><a href="#home" class="nav-link px-2 text-body-secondary">Home</a></li>
          <li class="nav-item"><a href="#visi_misi" class="nav-link px-2 text-body-secondary">Visi & Misi</a></li>
          <li class="nav-item"><a href="#galeri" class="nav-link px-2 text-body-secondary">Galeri</a></li>
          <li class="nav-item"><a href="#kegiatan" class="nav-link px-2 text-body-secondary">Kegiatan</a></li>
        </ul>
        <p class="text-center text-body-secondary">&copy; 2023 {{ config('app.name') }}</p>
      </footer>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- LightBox 2 -->
    <script src="{{ asset('dist/js/lightbox.min.js') }}"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const accordionButtons = document.querySelectorAll("#accordionExample .accordion-button");

        accordionButtons.forEach((button, index) => {
          button.addEventListener("click", () => {
            // Close all accordion except the clicked one
            const accordions = document.querySelectorAll(".accordion-collapse");
            accordions.forEach((accordion, i) => {
              if (i !== index) {
                accordion.classList.remove("show");
              }
            });
          });
        });

        // Click the first accordion button
        if (accordionButtons.length > 0) {
          accordionButtons[0].click();
        }
      });
    </script>
  </body>
</html>