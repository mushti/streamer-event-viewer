<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="https://static.twitchcdn.net/assets/favicon-75270f9df2b07174c23c.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/panel.js') }}" defer></script>
    <script>
        window.user = {!! json_encode(Auth::user() ? Auth::user()->append('favorite') : null) !!};
        window.url = '{!! url('/') !!}';
    </script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
</head>
<body>
    
    <div id="panel">
        <navbar v-if="$store.state.user"></navbar>
        <router-view></router-view>
    </div>

</body>
</html>
