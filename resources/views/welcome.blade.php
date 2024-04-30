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
            color: #2563eb;
            text-decoration: none;
            font-size: 1.25rem;
            margin-top: 2rem;
            display: inline-block;
            background: #e0f2fe;
            padding: 8px 16px;
            border-radius: 8px;
        }

        .link:hover {
            background: #bfdbfe;
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
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1 class="title">保険証データ管理システム</h1>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ route('insureds.index') }}" class="text-sm text-gray-700 underline">保険証データ一覧</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">ログイン</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">新規登録</a>
                        @endif
                    @endauth
                </div>
            @endif
        </header>

        <p>保険証データを効率的に管理し、簡単にアクセス、更新が可能です。</p>
    </div>
</body>
</html>
