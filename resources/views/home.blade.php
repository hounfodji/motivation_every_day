<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
        rel="stylesheet">

    <title>Meday</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-stand-blog.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <!--

TemplateMo 551 Stand Blog

https://templatemo.com/tm-551-stand-blog

-->
    <style>
        .card {
            flex-direction: row;
        }

        ul.post-info li {
            display: inline-block;
            margin-right: 8px;
            margin-right: 3px;
        }

        ul.post-info li:after {
            content: '|';
            color: #aaa;
            margin-left: 8px;
        }


        ul.post-info li:after {
            margin-left: 5px;
        }

        ul.post-info li:last-child::after {
            display: none;
        }

        ul.post-info li a {
            font-size: 14px;
            color: #aaa;
            font-weight: 400;
            transition: all .3s;
        }

        ul.post-info li a:hover {
            color: #f48840;
        }
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
        <nav class="navbar navbar-expand-lg ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h2>Meday<em>.</em></h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">Accueil
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                <a class="nav-link" href="about.html">About Us</a>
              </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/histories') }}">Autres histoires</a>
                        </li>
                        {{-- <li class="nav-item">
                <a class="nav-link" href="post-details.html">Post Details</a>
              </li> --}}
                        {{-- <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li> --}}
                        @if (Route::has('login'))
                            {{-- <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10"> --}}
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/dashboard') }}"
                                        class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"
                                        class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                        in</a>
                                </li>

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}"
                                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                    </li>
                                @endif
                            @endauth
                            {{-- </div> --}}
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="main-banner header-text">
        <div class="container-fluid">
            {{-- <div class="alert alert-secondary" role="alert">
          A simple secondary alert—check it out!
        </div> --}}
            <div class="owl-banner owl-carousel">

                @foreach ($posts as $post)
                    <div class="item">
                        @if ($post->image_compressed)
                            <img src="{{ asset('storage/' . $post->image_compressed) }}" alt="{{ $post->title }}"
                                class="w-full h-auto object-cover">
                        @else
                            <span class="text-gray-400">Aucune image</span>
                        @endif
                        <div class="item-content">
                            <div class="main-content">
                                <h4>{{ $post->detail }}</h4>
                                <p class="fst-italic" style="color: #f48840">{{ $post->author }} in {{ $post->title }}
                                    .</p>

                                {{-- <div class="meta-category">
                    <span>{{ $post->author }} in {{ $post->title }}</span>
                  </div>
                  <ul class="post-info">
                    <li><a href="#">{{ $post->author }}</a></li>
                    <li><a href="#">{{ $post->created_at }}</a></li>
                    <li><a href="#">12 Comments</a></li>
                  </ul> --}}
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- Banner Ends Here -->



    {{-- <section class="call-to-action">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="main-content">
              <div class="row">
                <div class="col-lg-8">
                  <span>Stand Blog HTML5 Template</span>
                  <h4>Creative HTML Template For Bloggers!</h4>
                </div>
                <div class="col-lg-4">
                  <div class="main-button">
                    <a rel="nofollow" href="https://templatemo.com/tm-551-stand-blog" target="_parent">Download Now!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}

    <section class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content">
                        <div class="row">
                            <div class="col-lg-8">
                                <span>Motivation Every Day</span>
                                <h4>History of the day!</h4>
                            </div>
                            {{-- <div class="col-lg-4">
                  <div class="main-button">
                    <a rel="nofollow" href="https://templatemo.com/tm-551-stand-blog" target="_parent">Download Now!</a>
                  </div>
                </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    @if ($history != null)
        <section class="blog-posts">
            <div class="container">

                <div class="card" style="width: 100%">
                    <div class="col-4">

                        @if ($history->image)
                            <img src="{{ asset('storage/' . $history->image) }}" alt="{{ $history->title }}"
                                class="mt-5 rounded mx-auto d-block">
                        @else
                            <span class="text-gray-400">Aucune image</span>
                        @endif
                    </div>
                    <div class="card-body col-8">
                        <h2 class="card-title" style="color: #f48840">{{ $history->title }}</h5>
                            <p class=" text-break">{{ $history->detail }}</p>
                            <ul class="post-info mt-3">
                                <li><a href="#">{{ $history->username }}</a></li>
                                <li><a href="#">{{ $history->created_at }}</a></li>
                                <li><a href="#">12 Comments</a></li>
                            </ul>
                            {{-- <a href="{{ url('/histories') }}" class="btn btn-primary">View all posts</a> --}}
                    </div>
                </div>
              
                <div class="mt-5 mx-auto col-9">
                    <div class="main-button">
                        <a href="{{ url('/histories') }}">View All Posts</a>
                    </div>
                </div>
            </div>
        </section>
    @else
        <span class="text-gray-400">No history</span>
    @endif







    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="social-icons">
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Behance</a></li>
                        <li><a href="#">Linkedin</a></li>
                        <li><a href="#">Dribbble</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="copyright-text">
                        <p>Copyright 2020 Stand Blog Co.

                            | Design: <a rel="nofollow" href="https://templatemo.com" target="_parent">TemplateMo</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) { //declaring the array outside of the
            if (!cleared[t.id]) { // function makes it static and global
                cleared[t.id] = 1; // you could use true and false, but that's more typing
                t.value = ''; // with more chance of typos
                t.style.color = '#fff';
            }
        }
    </script>

</body>

</html>
