@include('layouts.head')

<body class="g-navbar-search-show g-navbar-search-shown">
    <div class="main-content" id="panel">
        @include('layouts.navbar')
        <div class="container-fluid mt-3">
            @yield('content')
        </div>
    </div>

    @include('layouts.foot')
</body>
</html>
