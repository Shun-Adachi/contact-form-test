# お問い合わせフォーム

## 概要

- このプロジェクトはお問い合わせの送信および管理を行うためのアプリケーションです。
- ユーザーはお問い合わせフォームに入力した内容を送信することができます。
- 管理者は送信された問い合わせを確認および削除することができます。

## 環境構築

1. リポジトリをクローンします。

```bash
git clone <git@github.com>:Shun-Adachi/contact-form-test.git
cd contact-form-text
```

2. Dockerコンテナをビルドします。

```bash
docker-compose up -d --build
```

3. 必要なパッケージをインストールします。

```bash
docker-compose exec php bash
# PHPコンテナ内
composer install
cp .env.example .env
```

4. ".env"ファイルの以下の項目をご自身の環境に合わせて変更してください。

```
DB_HOST=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

5. アプリケーションキーの生成

``` bash
docker-compose exec php bash
# PHPコンテナ内
php artisan key:generate
```

6. データベースのセットアップ

```bash
# PHPコンテナ内
php artisan key:generate
php artisan migrate
php artisan db::seed
```

## 使用技術(実行環境)

- **フレームワーク**: Laravel 8.83.29
- **プログラミング言語**: PHP 7.4.9
- **データベース**: MySQL 8.0.26
- **Webサーバー**: Nginx 1.21.1
- **OS**: Ubuntu 24.04.1 LTS
- **バージョン管理**: Git
- **環境構築**: Docker 27.3.1

## ER図

< - - - 作成したER図の画像 - - - >

## URL

### 開発環境

- ユーザーお問い合わせフォーム：<http://localhost/>
- 管理者登録：<http://localhost/register>
- 管理者ログイン：<http://localhost/login>
