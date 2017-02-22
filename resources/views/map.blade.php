<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>WEBGIS SIMJALA PANDEGLANG</title>
        <link rel="stylesheet" type="text/css" href="//js.arcgis.com/3.12compact/esri/css/esri.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('cmv/css/theme/dbootstrap/dbootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('cmv/css/main.css')}}">
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png" sizes="16x16"> 
    </head>
    <body class="dbootstrap">
        <div class="appHeader">
            <div class="headerLogo">
                <img alt="logo" src="{{ asset('images/header_1.png')}}" height="54" />
                <img alt="logo" src="{{ asset('images/header_2.png')}}" height="54" />
            </div>
            <div class="headerTitle">
                <span id="headerTitleSpan">
                   SIMJALA
                </span>
                <div id="subHeaderTitleSpan" class="subHeaderTitle">
                    
                </div>
            </div>
            <div class="search">
                <div id='geocodeDijit'>
                </div>
            </div>
            <div class="login">
                @if(Auth::user())
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
                <a href="{{ url('admin/logout') }}"><i class="icon-user"></i> Logout</a>
                @else
                <a href="{{ url('admin/login') }}"><i class="icon-user"></i> Login</a>
                @endif
            </div>
            <div class="headerLinks">
                <div id="helpDijit">
                </div>
            </div>
        </div>
        <script type="text/javascript">

           var op = {!! $layer !!};
           var idn = {!! $identify !!};

            var dojoConfig = {
                async: true,
                packages: [{
                    name: 'viewer',
                    location: location.pathname.replace(/[^\/]+$/, '') + 'cmv/js/viewer'
                },{
                    name: 'config',
                    location: location.pathname.replace(/[^\/]+$/, '') + 'cmv/js/config'
                },{
                    name: 'gis',
                    location: location.pathname.replace(/[^\/]+$/, '') + 'cmv/js/gis'
                }]
            };
        </script>
        <!--[if lt IE 9]>
            <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/es5-shim/4.0.3/es5-shim.min.js"></script>
        <![endif]-->
        <!--<script type="text/javascript" src="//js.arcgis.com/3.14compact/"></script>-->
        <script type="text/javascript" src="{{ asset('3.12compact/init.js') }}"></script>
        <script type="text/javascript">
            // get the config file from the url if present
            var file = 'config/viewer', s = window.location.search, q = s.match(/config=([^&]*)/i);
            if (q && q.length > 0) {
                file = q[1];
                if(file.indexOf('/') < 0) {
                    file = 'config/' + file;
                }
            }
            require(['viewer/Controller', file], function(Controller, config){
                Controller.startup(config);
            });
        </script>
    </body>
</html>
