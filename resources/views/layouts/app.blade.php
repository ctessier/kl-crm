<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="{{ elixir('css/all.css') }}" />
    </head>
    <body class="sidebar-mini skin-blue">

        <div class="wrapper">
            @include('partials.header')
            @include('partials.sidebar')
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="pull-right">
                        @yield('header-pull-right')
                    </div>
                    <h1>@yield('header')</h1>
                </div>
                <section class="content">
                    @include('elements.messages')
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
            </footer>
        </div>

        <script src="{{ elixir('js/app.js') }}"></script>
        @yield('tail')
    </body>
</html>
