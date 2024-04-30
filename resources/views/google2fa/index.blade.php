<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @php
        $qrCodeUrl = Google2FA::getQRCodeInline(
            config('app.name'),
            Auth::user()->email,
            Auth::user()->google2fa_secret,
        );
    @endphp

    <!-- Title -->
    <h1 class="text-center text-3xl font-bold mt-6 mb-4">2要素認証</h1>

    <!-- QR Code Display -->
    <p class="text-center">Google Authenticatorアプリでバーコードを読み取り、ワンタイムパスワードを入力してください。</p>
    <div class="flex items-center justify-center my-8">
        {!! $qrCodeUrl !!}
    </div>

    <!-- App Installation Instructions -->
    <p class="text-center">Google Authenticatorのスマホアプリが必要です。以下のリンクからダウンロードしてください。</p>
    <div class="flex justify-center mt-4 space-x-4">
        <div>
            <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=ja&gl=US" class="text-blue-500 hover:underline">Google Play</a>
        </div>
        <div>
            <a href="https://apps.apple.com/jp/app/google-authenticator/id388497605" class="text-blue-500 hover:underline">App Store</a>
        </div>
    </div>

    <!-- 2FA Form -->
    <form method="POST" action="{{ route('2fa') }}" class="mt-8">
        @csrf
        <div class="my-6">
            <label for="one_time_password" class="block mb-2 text-sm">ワンタイムパスワード</label>
            <input type="password" id="one_time_password" name="one_time_password" class="block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <!-- Validation Errors -->
        @if ($errors->any())
            <x-input-error :messages="$errors->first()" />
        @endif
        <div class="flex items-center justify-center mt-4">
            <button type="submit" class="w-full px-8 py-2 bg-sky-500 text-white rounded hover:bg-sky-600 focus:outline-none focus:bg-sky-600">ログイン</button>
        </div>
    </form>

    <!-- Logout Form -->
    <form method="POST" action="{{ route('logout') }}" class="mt-4 text-center">
        @csrf
        <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">ログアウト</button>
    </form>

</x-guest-layout>
