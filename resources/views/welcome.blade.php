<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>保険証データ管理システム</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f9fafb;
            color: #333;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .container {
            width: 90%;
            max-width: 960px;
            margin: auto;
        }

        .title {
            font-size: 3rem;
            font-weight: bold;
            color: #2563eb;
        }

        .link {
            color: #fff;
            text-decoration: none;
            font-size: 1.25rem;
            display: inline-block;
            background: #2563eb;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .link:hover {
            background: #1c4fc9;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 1rem 0;
            font-size: 0.875rem;
            background: #f3f4f6;
            border-top: 1px solid #e5e7eb;
        }

        .description {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1 class="title">データ管理システム</h1>
            <p class="description">保険証データをCSVでアップロードし、簡単に管理が可能です。</p>
        </header>

        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ route('insureds.index') }}" class="link">保険証データ一覧</a>
                @else
                    <a href="{{ route('login') }}" class="link">ログイン</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="link">新規登録</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>
