<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Me Empresta</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>

    @yield('stylesheets')
</head>
<body class="gray-bg">
<div id="wrapper">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        @yield('content')
    </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->

<script src="{{ asset('/js/jquery.js') }}"></script>
<script src="{{ asset('/js/bootstrap.js') }}"></script>

@yield('scripts')

</body>
</html>
