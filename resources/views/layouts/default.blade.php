<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="<?php echo csrf_token() ?>" />
        @yield('custom-meta')

        <!-- Load CSS libraries -->
        <link href="/css/bootstrap.css" rel="stylesheet">
        @yield('custom-css')

        <title>@yield('title')</title>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
        <!-- Load JS libraries-->
        <script src="/js/jquery-3.3.1.slim.min.js"></script>
        <script src="/js/popper.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        @yield('custom-js')
    </body>
</html>
