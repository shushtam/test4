<!DOCTYPE html>
<html lang="<?= config('app.locale') ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?= csrf_token() ?>">
        <title><?= config('app.name', 'Laravel') ?></title>
        <!-- Styles -->
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="<?= url('/') ?>">
                            <?= config('app.name', 'Laravel') ?>
                        </a>
                    </div>


                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            <li><a href="<?= URL::to('user') ?>">Users</a></li>
                            <li><a href="<?= URL::to('user/report') ?>">Reports</a></li>
                            <li><a href="<?= URL::to('user/reportchart') ?>">Chart</a></li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            <?php if (Auth::guest()): ?>
                                <li><a class="btn btn-primary btn-md mainButtons" href="<?= URL::to('user/login') ?>">Login <i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
                                <li><a class="btn btn-primary btn-md mainButtons" href="<?= URL::to('user/register') ?>">Register<i class="fa fa-user" aria-hidden="true"></i></a></li>
                            <?php else : ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        <?= Auth::user()->name ?> <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="<?= URL::to('user/logout') ?>">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="<?= URL::to('user/logout') ?>" method="POST" style="display: none;">
                                                <?= csrf_field() ?>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
            @yield('content')
            <div class ="footer">
                <div class="container-fluid text-center">
                    <a href="#">Page 3</a>
                    <a href="#">Page 3</a>
                    <a href="#">Page 3</a>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="/js/vendor.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
        <script>
            window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
            ]) !!}
            ;
        </script>
        <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.dropdown-toggle').dropdown();

            });
        </script>

        @yield('js')
        @yield('sin_js')
        @yield('cos_js')
        @yield('star_js')
    </body>
</html>
