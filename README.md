## セットアップ

### 1. リポジトリをクローン

```bash
git clone https://github.com/nomi3/laravel-data-manager.git
```

### 2. ディレクトリに移動

```bash
cd laravel-data-manager
```

### 3. vender パッケージをインストール

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

### 4. 一度起動する

```bash
./vendor/bin/sail up -d
```

### 5. .env ファイルを作成

key は担当者からもらいます。

```bash
./vendor/bin/sail artisan env:decrypt --key="base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx="
```

### 6. マイグレーション

```bash
./vendor/bin/sail artisan migrate
```

### 7. npm パッケージをインストール

```bash
./vendor/bin/sail npm install
```

### 8. npm を実行

```bash
./vendor/bin/sail npm run dev
```

## DB の確認

http://localhost:8080 で phpMyAdmin からデータベースを確認できます。

## テストについて

### ディレクトリ構成

基本的に app 配下と同じディレクトリ構成を tests 配下に作成しています。
tests/Feature と tests/Unit には breeze で作成されたテストが入っていて、それ以外のディレクトリには自作のテストが入っています。

### テストの実行

テストを実行するには以下のコマンドを実行してください。

```bash
./vendor/bin/sail test
```

## アーキテクチャ

基本的には以下の役割分担を採用しています。

view ⇄ request ⇄ controller ⇄ usecase ⇄ model

### request

認可やバリデーションを行うクラスを app/Http/Requests に格納しています。

### controller

app/Http/Cotrollers に格納しています。

request から受け取った値を usecase に渡し、usecase から受け取った値を view に渡します。

### usecase

app/UseCases に格納しています。

ビジネスロジックを記述していて、ここから model を呼び出します。

### model

app/Models に格納しています。

データベースのテーブルと基本的に 1:1 で対応する想定でいます。
