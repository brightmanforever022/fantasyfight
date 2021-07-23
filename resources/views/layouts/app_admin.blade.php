<html>

<head>
    <title>Fantasy Fight League</title>
    <meta name="viewport" content="minimum-scale=1, initial-scale=1, width=device-width, shrink-to-fit=no" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>

    <style>
        body {
            background-color: #ffffff
        }

        .header-part {
            display: flex;
            padding: 10px;
            justify-content: space-between;
            align-items: center;
        }

        .header-part .app-name-part {
            display: flex;
            align-items: center;
        }

        .header-part .app-name-part .header-logo {
            margin-right: 8px;
        }

        .header-part .app-name-part .app-name {
            font-size: 14px;
        }

        .header-part .auth-part {
            display: flex;
            align-items: center;
        }

        .header-part .auth-part .auth-btn {
            font-size: 13px;
            background-color: linear-gradi;
            background-image: linear-gradient(to bottom, #5ac1c2, #478acd);
            line-height: 16px;
            border: none;
            /* width: 62px; */
            padding: 6px 11px;
            margin: 5px;
            color: #ffffff;
        }

        .user-name {
            font-size: 20px;
            color: #000000;
            margin-right: 12px;
            font-family: KanedaLight;
        }

        .logout-icon {
            font-size: 21px;
        }

        .container-parent {
            display: flex;
            justify-content: center;
            padding: 15px 25px;
            height: 100%;
        }

        .modal.show .modal-dialog {
            -webkit-transform: translate(0, -50%);
            -o-transform: translate(0, -50%);
            transform: translate(0, -50%);
            top: 50%;
        }

        .modal-body-custom {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .welcome-label {
            font-size: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .custom-form-group {
            width: 100%;
        }

        .custom-input {
            width: 100%;
            margin-bottom: 12px;
        }
    </style>

</head>

<body>
    @section('headerbar')
    <div class="header-part">
        <div class="app-name-part">
            <img class="header-logo" src="{{asset('imgs/header-logo.png')}}" alt="profile Pic" height="40px" width="40px">
            <span class="app-name">FANTASY FIGHT LEAGUE</span>
        </div>
        <div class="auth-part">
            @if(Session::get('name') && (Session::get('name') == 'admin'))
            <span class="user-name">Admin</span>
            <a class="logout-icon" href="{{route('admin.logout')}}"><i class="fas fa-sign-out-alt"></i></a>
            @else
            <button class="btn auth-btn" data-toggle="modal" data-target="#loginModal">LOGIN</button>
            <!-- <button class="btn auth-btn" data-toggle="modal" data-target="#joinModal">JOIN</button> -->
            @endif
            <!-- Modal -->
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="modal-body-custom" action="{{ route('admin.login') }}" method="POST">
                                @csrf
                                <span class="welcome-label">WELCOME BACK!</span>
                                <div class="form-group custom-form-group">
                                    <input type="hidden" name="name" class="form-control custom-input" value="admin" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <input autocomplete="off" type="password" name="password" class="form-control custom-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Password">
                                </div>
                                <button type="submit" class="btn auth-btn">LOGIN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @show

    <div class="container-parent">
        @yield('content')
    </div>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{asset('js/app_admin.js')}}"></script>

</body>

</html>