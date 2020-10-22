@include('layouts.head')

<body class="g-navbar-search-show g-navbar-search-shown">
    @include('layouts.navbar')
    <div class="main-content" id="panel">

        <div class="container-fluid mt-3">
            @yield('content')
        </div>
    </div>

    @include('layouts.foot')
</body>
</html>
