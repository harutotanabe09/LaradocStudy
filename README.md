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

### 設定ファイルコピー

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

### Docker を起動

※　初回起動はすごい時間がかかる

※　Laradocを様々なimageを含むため、起動する分だけをComposeUpする

```
docker-compose up -d nginx mysql phpmyadmin
```

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

### Dockerリセット

```
docker system prune
docker rmi $(docker images -q)
```

