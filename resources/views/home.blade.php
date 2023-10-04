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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/histories') }}">Citations</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/histories') }}">Histoires</a>
                        </li>


                        @if (Route::has('login'))
                            {{-- <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10"> --}}
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/dashboard') }}"
                                        class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    {{-- <a class="nav-link" href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a> --}}
                                    <a class="nav-link" style="cursor: pointer" data-toggle="modal"
                                        data-target="#loginModal">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        {{-- <a class="nav-link" href="{{ route('register') }}"
                                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a> --}}
                                        <a class="nav-link" style="cursor: pointer" data-toggle="modal"
                                            data-target="#registerModal">{{ __('Register') }}</a>
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

    {{-- Login Modal --}}
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="margin-top: 90px">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModal" style="color: #f48840">{{ __('Login') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a> --}}
                                    <a class="btn btn-link" style="cursor: pointer" data-toggle="modal"
                                        data-target="#forgotPasswordModal">{{ __('Forgot Your Password?') }}</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Forgot Password Modal --}}
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="loginModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="margin-top: 90px">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModal" style="color: #f48840">{{ __('Forget Your Password') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>
                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>





                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="toastBut">
                                    {{ __('Email Password Reset Link') }}
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Toast --}}
    {{-- <input type="hidden" id="myHiddenInput" value=""> --}}



    {{-- Register Modal --}}
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="margin-top: 90px">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModal" style="color: #f48840">{{ __('Register') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                        @csrf

                        <div class="form-group row">
                            <label for="nameInput"
                                class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="nameInput" type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" autocomplete="name" autofocus>

                                <span class="invalid-feedback" role="alert" id="nameError">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="emailInput"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="emailInput" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                <span class="invalid-feedback" role="alert" id="emailError">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="passwordInput"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="passwordInput" type="password" class="form-control" name="password"
                                    required autocomplete="new-password">

                                <span class="invalid-feedback" role="alert" id="passwordError">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a> --}}
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>






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
                                <p class="fst-italic" style="color: #f48840">{{ $post->author }} in
                                    {{ $post->title }}
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
                    <div class="col-5">

                        @if ($history->image_compressed)
                            <img src="{{ asset('storage/' . $history->image_compressed) }}"
                                alt="{{ $history->title }}" class="mt-5 rounded mx-auto d-block">
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

                <div class="mt-5 mx-auto col-7">
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>
    {{-- <script src="assets/js/loginRegisterModal.js"></script> --}}

    {{-- Login Submit and Validation Errors --}}
    @parent
    @if ($errors->has('email') || $errors->has('password'))
        <script>
            $(function() {
                $('#loginModal').modal({
                    show: true
                });
            });
        </script>
    @endif

    {{-- Register AJAX Submit and Validation Errors --}}
    @parent

    <script>
        $(function() {
            $('#registerForm').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serializeArray();
                $(".invalid-feedback").children("strong").text("");
                $("#registerForm input").removeClass("is-invalid");
                $.ajax({
                    method: "POST",
                    headers: {
                        Accept: "application/json"
                    },
                    url: "{{ route('register') }}",
                    data: formData,
                    success: () => window.location.assign("{{ route('home') }}"),
                    error: (response) => {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            Object.keys(errors).forEach(function(key) {
                                $("#" + key + "Input").addClass("is-invalid");
                                $("#" + key + "Error").children("strong").text(errors[
                                    key][0]);
                            });
                        } else {
                            window.location.reload();
                        }
                    }
                })
            });
        })
    </script>

    @if ($status = 'passwords.sent')
        <script>
            Toastify({
                text: "We sent an email.",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                onClick: function() {}
            }).showToast();
        </script>
    @endif

    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) { //declaring the array outside of the
            if (!cleared[t.id]) { // function makes it static and global
                cleared[t.id] = 1; // you could use true and false, but that's more typing
                t.value = ''; // with more chance of typos
                t.style.color = '#fff';
            }
        }

        // toast
        // Sélectionnez l'input caché et le bouton
        // var hiddenInput = document.getElementById('myHiddenInput');
        // var toastBut = document.getElementById('toastBut');

        // // Ajoutez un gestionnaire d'événement au bouton
        // toastBut.addEventListener('click', function () {
        //     // if (hiddenInput.value === '1') {
        //         hiddenInput.value = '2';
        //         showToast(); // Appelez la fonction pour afficher le toast
        //     // }
        // });

        // if (hiddenInput.value === '2') {
        //         showToast(); // Appelez la fonction pour afficher le toast
        //     }

        // // Fonction pour afficher le toast
        // function showToast() {
        //     Toastify({
        //         text: "We sent an email.",
        //         duration: 3000,
        //         newWindow: true,
        //         close: true,
        //         gravity: "top",
        //         position: "left",
        //         stopOnFocus: true,
        //         style: {
        //             background: "linear-gradient(to right, #00b09b, #96c93d)",
        //         },
        //         onClick: function() {}
        //     }).showToast();
        // }
    </script>



</body>

</html>
