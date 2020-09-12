<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf-8>
    <title>GManBot</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">

    <link rel="stylesheet" href="/static/css/my.css">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/moment.min.js"></script>
    <script src="/static/js/jquery-3.5.1.slim.min.js"></script>
    <script src="/static/js/popper.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <script src="/static/js/my.js"></script>

    <link href="/static/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="/static/js/tabulator.min.js"></script>

</head>
<body class="bg-dark" style="color: seashell">
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" style="border-bottom-style: ridge; border-bottom-color: gold;">
        <a class="navbar-brand" href="/">GBot</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/dicegolf">DiceGolf</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/experiments">Experimental</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/twitch-chat-stats" >Chat Stats</a>
                </li>
            </ul>
        </div>
        @auth
            <div class="mr-2"><img src="/static/img/flags/{{Auth::user()->tui_data->flag ?? 'none'}}.png" height="32"></div> <div><a href="/admin/flag-selector"><h4>{{Auth::user()->name}}</h4></a></div>
        @endauth
        @guest
            <div><a class="btn btn-primary" href="https://id.twitch.tv/oauth2/authorize?client_id=q8q6jjiuc7f2ef04wmb7m653jd5ra8&redirect_uri=https://gman.bot/oauth/twitch&response_type=code&scope=user:read:email" role="button">Login With Twitch</a></div>
        @endguest
    </nav>
    @yield('content')
</body>
</html>
