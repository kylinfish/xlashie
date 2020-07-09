@include('layouts.head')

<body>
    @include('layouts.sidebar')
    <div class="main-content" id="panel">
        @include('layouts.navbar')
        <div class="container-fluid mt-3">
            @yield('content')
        </div>
    </div>
    @include('layouts.foot')
</body>

</html>
