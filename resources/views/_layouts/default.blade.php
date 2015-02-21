<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link href="{{ asset("assets/css/slate-bootstrap.min.css") }}" rel="stylesheet">
        <link href="{{ asset("components/jstree/dist/themes/default/style.min.css") }}" rel="stylesheet" />
        <link href="{{ asset("assets/css/styles.css") }}" rel="stylesheet" />
        <script>
            var fieldNumber = 0
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-1 main">
                    @include('_layouts/menu')
                    @include('_layouts.messages')
                    @yield('main')
                </div>
            </div>
        </div>
        <script src="{{ asset("components/jquery/dist/jquery.min.js") }}"></script>
        <script src="{{ asset("components/jstree/dist/jstree.min.js") }}"></script>
        <script src="{{ asset("components/bootstrap/dist/js/bootstrap.min.js") }}"></script>
        <script src="{{ asset("components/list.js/dist/list.min.js") }}"></script>
        <script src="{{ asset("components/jqueryui/jquery-ui.min.js") }}"></script>
        <script src="{{ asset("assets/js/databags.js") }}"></script>
        @yield('script')
    </body>
</html>
