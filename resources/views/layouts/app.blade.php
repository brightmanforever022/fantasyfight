<html>

<head>

    {{-- <title>Kinda - @yield('title')</title> --}}
    <title>Fantasy Fight League</title>
    <meta name="viewport" content="minimum-scale=1, initial-scale=1, width=device-width, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/game.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/leaderboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-625K5YDS2J"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        function initiateStripeSession(credit = 1) {
            var stripe = Stripe("{{env('STRIPE_CLIENT_KEY')}}");
            fetch('/payments/initiate', {
                    method: 'POST',
                    body: "credit=" + credit,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(session) {
                    return stripe.redirectToCheckout({
                        sessionId: session.id
                    });
                })
                .then(function(result) {
                    // If `redirectToCheckout` fails due to a browser or network
                    // error, you should display the localized error message to your
                    // customer using `error.message`.
                    if (result.error) {
                        alert(result.error.message);
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        }
        gtag('js', new Date());
        gtag('config', 'G-625K5YDS2J');
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(d, s, id) {
            var js, tjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://app.termly.io/embed-policy.min.js";
            tjs.parentNode.insertBefore(js, tjs);
        }(document, 'script', 'termly-jssdk'));

        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WKBLBTW');
    </script>
    <!-- End Google Tag Manager -->

    <style>
        /* body {
            padding-bottom: 67px;
        } */
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #373536;
            color: white;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            padding: 14px 26px;
            z-index: 999;
        }

        .footer:hover {
            color: #ffffff;
            text-decoration: none;
        }

        .footer .header-logo {
            position: absolute;
            left: calc(50% - 30px);
            top: -15px;
            width: 60px;
            height: auto;
        }

        .leader-board {
            font-size: 26px;
            letter-spacing: 2px;
            font-family: KanedaBold;
        }

        .board-date {
            font-size: 26px;
            letter-spacing: 2px;
            font-family: KanedaBold;
            color: #FFF;
            text-decoration: none !important;
        }

        .board-date:hover {
            font-weight: 600 !important;
            color: #FFF;
        }

        body {
            background-color: #ffffff;
        }

        .header-part {
            display: flex;
            padding: 10px;
            justify-content: space-between;
            align-items: center;
        }

        .header-part .header-link {
            color: #000000;
            text-decoration: none;
        }

        .header-part .app-name-part {
            display: flex;
            align-items: center;
        }

        .header-part .app-name-part .header-logo {
            margin-right: 8px;
        }

        .header-part .app-name-part .app-name {
            font-size: 22px;
            font-family: KanedaBold;
        }

        .header-part .auth-part {
            display: flex;
            align-items: center;
        }

        .sub-header {
            width: 100%;
            overflow-x: auto;
            display: flex;
            align-items: center;
            background: #413f42;
            padding: 6px 24px;
        }

        .sub-header .sub-header-item {
            font-size: 23px;
            color: #ffffff;
            padding-right: 15px;
            letter-spacing: 1px;
            font-family: KanedaLight;
        }

        .sub-header .sub-header-item:hover {
            font-family: KanedaBold;
            text-decoration: none;
        }

        .sub-header .active-item {
            font-family: KanedaBold;
        }

        .user-name {
            font-size: 20px;
            color: #000000;
            margin-right: 15px;
            letter-spacing: 1px;
            font-family: KanedaLight;
            text-decoration: none !important;
        }

        .header-part .auth-part .auth-btn {
            font-size: 19px;
            background-image: linear-gradient(to bottom, #5ac1c2, #478acd);
            line-height: 16px;
            border: none;
            /* width: 62px; */
            padding: 6px 11px;
            margin: 5px;
            color: #ffffff;
            font-family: KanedaMedium;
        }

        .container-parent {
            position: relative;
            display: flex;
            justify-content: center;
            padding: 15px 25px;
            background: #467fcc;
            min-height: calc(100% - 173px);
            object-fit: cover;
            object-position: center;
            padding-bottom: 80px;
        }

        .background-imgs {
            position: absolute;
            width: 100%;
            pointer-events: none;
            height: 100%;
            left: 0;
            top: 0px;
            opacity: .1;
            z-index: 1;
            background: url("/imgs/background-image.png") center;

        }

        .modal.show .modal-dialog {
            -webkit-transform: translate(0, -50%);
            -o-transform: translate(0, -50%);
            transform: translate(0, -50%);
            top: 50%;
            padding-left: 15px;
            padding-right: 15px;
        }

        .modal-body-custom {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .custom-alert {
            z-index: 999;
        }

        .modal-logo {
            width: 86px;
            height: 86px;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .welcome-label {
            font-size: 36px;
            margin-bottom: 15px;
            font-family: KanedaStrong;
        }

        .custom-form-group {
            width: 100%;
        }

        .custom-input {
            width: 100%;
            margin-bottom: 12px;
        }

        .submit-btn {
            background-image: linear-gradient(to bottom, #5ac1c2, #478acd);
            line-height: 20px;
            border: none;
            color: #ffffff;
            font-size: 27px;
            padding: 6px 25px;
            margin-top: 8px;
            margin-bottom: 10px;
            font-family: KanedaMedium;
        }

        @media(max-width: 678px) {
            .background-imgs {
                display: none
            }
        }
    </style>

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKBLBTW" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->

    @section('headerbar')
    <div class="header-part">
        <a class="header-link" href="/">
            <div class="app-name-part">
                <img class="header-logo" src="{{ asset('imgs/header-logo.png') }}" alt="profile Pic" height="40px" width="40px">
                <span class="app-name">FANTASY FIGHT LEAGUE</span>
                <input type="hidden" id="global_url" value="{{ url('/') }}" />
            </div>
        </a>
        <div class="auth-part">
            @if (!Session::get('name'))
            <button class="btn auth-btn" data-toggle="modal" data-target="#loginModal">LOGIN</button>
            <button class="btn auth-btn" data-toggle="modal" data-target="#joinModal">JOIN</button>
            @else
            <a href="{{ route('profile') }}/{{ Session::get('name') }}" class="user-name">{{ Session::get('name') }}</a>

            <!-- <a href="{{ route('payments.view') }}" class="user-name">My Payments </a> -->
            <button type="button" class="btn auth-btn" data-toggle="modal" data-target="#paymentModal">
                {{ getMyCredits() }} Credits
            </button>
            <a href="{{ route('home.logout') }}"><i class="fas fa-sign-out-alt"></i></a>
            @endif
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <img class="modal-logo" src="{{ asset('imgs/header-logo.png') }}" alt="logo Pic">
                            <span class="welcome-label">Add More Credits To Play</span>
                            <div class="form-group custom-form-group">
                                <button class="btn submit-btn btn-block" onclick="initiateStripeSession(1)">Add 1 Credit at $5</button>
                                <button class="btn submit-btn btn-block" onclick="initiateStripeSession(5)">Add 5 Credits at $50</button>
                                <button class="btn submit-btn btn-block" onclick="initiateStripeSession(12)">Add 12 Credits at $120</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="termsModal" tabindex="2" role="dialog" aria-labelledby="termsModal" aria-hidden="true" style="z-index: 10000;">
                <div class="modal-dialog modal-dialog-scrollable" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div name="termly-embed" data-id="7eeb2e75-b586-4ef1-b52e-580f3d68969c" data-type="iframe"></div>
                        </div>
                    </div>
                </div>
            </div>
            @if(!str_contains(url()->current(), "prize") && isset($sport) && (!empty($sport->image) || !empty($sport->description)))
            <div class="modal fade" id="splashModal" tabindex="-1" role="dialog" data-show="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            @if(!empty($sport->image))
                            <img src="{{ asset('storage\\'.$sport->image) }}" style="max-width: 300px; max-height:300px" >
                            @endif
                            <div class="text" style="font-family: KanedaLight; font-size: 20px; font-weight: 900; margin-bottom: 0px; line-height: 40px;">
                                {{$sport->description}}
                            </div>
                            @if(!$sport->redirect_title)
                            <a href="{{$sport->redirect_url}}" class="btn auth-btn">set your team now</a>
                            @else
                            <a href="{{$sport->redirect_url}}" class="btn auth-btn">{{$sport->redirect_title}}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Modal -->
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            {{-- <form class="modal-body-custom" action="{{ route('gameuser.login') }}" method="POST" > --}}
                            <img class="modal-logo" src="{{ asset('imgs/header-logo.png') }}" alt="logo Pic">
                            <span class="welcome-label">WELCOME BACK!</span>
                            <div class="form-group custom-form-group">
                                <input type="hidden" class="token" value="{{ csrf_token() }}">
                                <input autocomplete="off" type="email" name="email" class="form-control custom-input login-email" aria-describedby="emailHelp" placeholder="Email">
                                <input autocomplete="off" type="password" name="password" class="form-control custom-input login-password" aria-describedby="emailHelp" placeholder="Password">
                                <button type="button" class="btn submit-btn" id="login-button">LOGIN</button>
                            </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Signup Modal -->
            <div class="modal fade" id="joinModal" tabindex="1" role="dialog" aria-labelledby="joinModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="modal-body-custom" action="{{ route('gameuser.store') }}" method="POST">
                                @csrf
                                <img class="modal-logo" src="{{ asset('imgs/header-logo.png') }}" alt="logo Pic">
                                <span class="welcome-label">WELCOME BACK!</span>
                                <div class="form-group custom-form-group">
                                    <input type="text" name="name" class="form-control custom-input" aria-describedby="emailHelp" placeholder="Username" autocomplete="off">
                                    <input type="email" name="email" class="form-control custom-input" aria-describedby="emailHelp" placeholder="Email" autocomplete="off">
                                    <input type="password" name="password" class="form-control custom-input" aria-describedby="emailHelp" placeholder="Password">
                                </div>
                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" name="terms" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">I agree to Fantasy Fight
                                        League’s <a href="#" data-toggle="modal" data-target="#termsModal"> Terms and Condition</a> and <a class="terms-policy" href="https://app.termly.io/document/privacy-policy/df086767-112e-4fd1-bffd-cc82824827ff" target="_blank">Privacy policy</a></label>
                                </div>
                                <button type="submit" class="btn submit-btn">JOIN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-header">
        <div class="sub-header-left">
            @foreach ($sports as $sport)
            @if ($sport_id == null)
            @if ($sport->sport_id == $first_sport_id)
            <span class="sub-header-item active-item">{{ $sport->name }}</span>
            @else
            <a href="{{ route('home', $sport->sport_id) }}" class="sub-header-item">{{ $sport->name }}</a>
            @endif
            @else
            @if (($sport_id == $sport->sport_id) && !str_contains(url()->current(), "prize"))
            <span class="sub-header-item active-item">{{ $sport->name }}</span>
            @else
            <a href="{{ route('home', $sport->sport_id) }}" class="sub-header-item">{{ $sport->name }}</a>
            @endif
            @endif
            @endforeach
        </div>
        <div class="sub-header-right">
            @if (str_contains(url()->current(), "prize"))
                <a href="{{ route('prizes') }}" class="sub-header-item active-item">Prizes</a>
            @else 
                <a href="{{ route('prizes') }}" class="sub-header-item">Prizes</a>
            @endif
        </div>
    </div>
    @show

    <div class="container-parent">
        <div class="background-imgs">
        </div>
        @error('name')
        <div class="alert alert-danger alert-dismissible custom-alert" role="alert">
            <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
            {{ $message }}
        </div>
        @enderror
        @error('email')
        <div class="alert alert-danger alert-dismissible custom-alert" role="alert">
            <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
            {{ $message }}
        </div>
        @enderror
        @error('password')
        <div class="alert alert-danger alert-dismissible custom-alert" role="alert">
            <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
            {{ $message }}
        </div>
        @enderror
        @error('terms')
        <div class="alert alert-danger alert-dismissible custom-alert" role="alert">
            <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
            {{ $message }}
        </div>
        @enderror
        @yield('content')
    </div>

    <div class="modal" id="successfullySignedModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p style="font-family: KanedaLight; font-size: 45px; font-weight: 900; margin-bottom: 0px;">Signed
                        up successfully.</p>
                    <button class="btn login-btn" data-toggle="modal" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="loginNotification">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p style="font-family: KanedaLight; font-size: 45px; font-weight: 900; margin-bottom: 0px; line-height: 40px;">
                        Incorrect e-mail or password.</p>
                    <button class="btn login-btn" data-toggle="modal" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <a class="footer" href={{ route('user.leaderboard') }}>
        <img class="header-logo" src="{{ asset('imgs/Logo.png') }}" alt="profile Pic" height="40px" width="40px">
        <span class="leader-board">LEADERBOARD</span>
        <object><a href="{{ route('profile') }}/{{ Session::get('name') }}" class="board-date">MY
                TEAMS</a></object>
    </a>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    @if (Session::get('success'))
    <script>
        $('#successfullySignedModal').modal('show');
    </script>
    @else
    <script>
        $("#splashModal").modal();
    </script>
    @endif
</body>

</html>