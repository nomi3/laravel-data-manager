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
