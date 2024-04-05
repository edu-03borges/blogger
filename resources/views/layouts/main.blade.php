<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        <aside class="left-section">
            <div class="logo">
                <img src="/img/logo.png">
            </div>

            <div class="sidebar">
                <div class="item" id="active">
                    <i class='bx bx-home-alt-2'></i>
                    <a href="/">Página de Notícias</a>
                </div>
                @auth
                    <div class="item">
                        <i class='bx bx-news'></i>
                        <a href="/my_posts">Minhas Postagens</a>
                    </div>
                    <div class="item">
                        <i class='bx bx-message-square-add'></i>
                        <a href="/posts/create_post">Postar</a>
                    </div>
                    @if(auth()->user()->access_level == 'admin')
                        <div class="item">
                            <i class='bx bxs-user-account'></i>
                            <a href="/dashboard_users">Usuários</a>
                        </div>
                    @endif

                    <div class="item">
                        <form action="/logout" method="POST" style="display: flex; gap: 20px; cursor: pointer;">
                            @csrf
                            <i class='bx bx-exit' ></i>
                            <a href="/logout" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a>
                        </form>
                    </div>
                @endauth
                @guest
                    <div class="item">
                        <i class='bx bx-log-in'></i>
                        <a href="/login">Logar</a>
                    </div>
                    <div class="item">
                        <i class='bx bx-user-plus'></i>
                        <a href="/register">Registrar</a>
                    </div>
                @endguest
            </div>

            <div class="upgrade">
                <h5>Direitos Autorais</h5>
                <div class="link">
                    <a href="#">Copyright 2024 © <b>Blogger</b></a>
                </div>
            </div>
        </aside>

        @yield('content')
    </div>
    <script src="/js/script.js"></script>
</body>

</html>
