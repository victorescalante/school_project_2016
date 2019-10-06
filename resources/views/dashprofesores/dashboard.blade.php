<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('img/favicon.ico')}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('titulo')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{asset('css/material-dashboard.css?v=1.2.0')}}" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('css/demo.css')}}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="blue" data-image="{{asset('img/sidebar-1.jpg')}}">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    Calificaciones
                </a>
            </div>
            <div class="sidebar-wrapper">
                @yield('menus')
                
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                        <a class="navbar-brand" href="#"> @yield('titulopage') </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <img src="{{asset('img/logogob1.png')}}" width='150'>
                                <img src="{{asset('img/edomex3.png')}}" width='150'>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                    <p class="hidden-lg hidden-md">Perfil</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{URL::action('calif@modpasspro',['idd'=>Session::get('sessioniddoc')])}}">Modificar Contraseña</a>
                                    </li>
                                    <li>
                                        <a href="{{URL::action('login@cerrarsesion')}}">Cerrar Sesion</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        
                        @yield('Contenido')
                        
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Inicio
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{URL::action('login@cerrarsesion')}}">
                                    Cerrar Sesion
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="#">UTVT</a>
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="{{asset('js/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/material.min.js')}}" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="{{asset('js/chartist.min.js')}}"></script>
<!--  Dynamic Elements plugin -->
<script src="{{asset('js/arrive.min.js')}}"></script>
<!--  PerfectScrollbar Library -->
<script src="{{asset('js/perfect-scrollbar.jquery.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('js/bootstrap-notify.js')}}"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{asset('js/material-dashboard.js?v=1.2.0')}}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('js/demo.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
</script>

</html>