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
        @if (App::environment('local'))
        <script src="{{ asset("components/jquery/jquery.min.js") }}"></script>
        <script src="{{ asset("components/jstree/dist/jstree.min.js") }}"></script>
        <script src="{{ asset("components/bootstrap/js/bootstrap.min.js") }}"></script>
        <script src="{{ asset("components/list.js/dist/list.min.js") }}"></script>
         @else
        <script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.0.8/jstree.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js" />
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-49943403-3', 'auto');
          ga('send', 'pageview');

        </script>
        @endif
        <script src="{{ asset("assets/js/databags.js") }}"></script>
        <script src="{{ asset("assets/js/jquery-ui.min.js") }}"></script>
        @yield('script')
    </body>
</html>
