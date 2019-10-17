### LaravelのDocumentファイル作成

```
mkdir LaradockStudy
cd ./LaradockStudy
mkdir src
```

### GitのサブモジュールとしてLaradockのファイルをインストール

```
git init
git submodule add https://github.com/Laradock/laradock.git
```

### 環境ファイルコピー＆変数

```
cd laradock
cp env-example .env
```

ソースファイルを編集する

 vi .env

```
APP_CODE_PATH_HOST=../src
```

### MYSQL変更

vi ./mysql/my.cnf

```
......
default-authentication-plugin = mysql_native_password
```

※　すごい時間がかかる

### Docker を起動

※　Laradocを様々なimageを含むため、起動する分だけをComposeUpする

```
docker-compose up -d nginx mysql phpmyadmin
```

※　すごい時間がかかる

### Dockerコンテナに入る

docker-compose exec workspace bash

### Composerを実行

初期ディレクトリ。コンテナ内のvar/wwwから起動。

composer create-project --prefer-dist laravel/laravel ./

### Laravelのバージョン確認

コンテナ内で実行

```
 php artisan --version
```

### PHPMyAdminを実行

http://localhost:8080

### MySQLにログイン

※　MySQLからPHPMyAdminにはアクセスできないため、権限編集する必要あり

```sh
docker-compose exec mysql bash
mysql -uroot -proot
select User, Plugin from mysql.user;
```

ERROR: No container found for mysql_1のエラーが出る場合

```sh
rm -r ~/.laradock/data
```

### コンテナ再起動

```
docker-compose stop
docker-compose up -d nginx mysql phpmyadmin
```

### Laravelの設定変更

vi .env

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
```

### artisanコマンドを使う

```
php artisan migrate
```

参考：https://liginc.co.jp/364089





Dockerリセット

docker system prune

docker rmi $(docker images -q)

