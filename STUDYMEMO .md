▼マイグレーションの設定。Postというテーブル作成処理

 php artisan make:model Post --migration

▼実行後に以下の様なファイルが作成される

 database/migration/2019_10_21_140404_create_posts_table.php

▼ファイルを編集。Postというテーブルの中身定義

```php
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('body');
            $table->timestamps();
        });
    }
```

▼マイグレーション実行

```sh
php artisan migrate
```

▼Tinkerの実行

```sh
php artisan tinker

>>> $post = new App\Post();

>>> $post->title = 'title 1 ';
=> "title 1 "
>>> $post->body = 'body 1 ';
=> "body 1 "
>>> $post->save();
// 内容確認
>>> App\Post::all();
=> Illuminate\Database\Eloquent\Collection {#3006
     all: [
       App\Post {#3007
         id: 1,
         title: "title 1 ",
         body: "body 1 ",
         created_at: "2019-10-21 14:15:51",
         updated_at: "2019-10-21 14:15:51",
       },
     ],
   }
// すっきり確認
>>> App\Post::all()->toArray();
```

▼MySQLのデータ確認

```sh
docker-compose exec mysql bash
mysql -uroot -proot
mysql> select * from laravel.posts;
```



▼Tinkerの実行2

```sh
// 一気に書くことも可能
php artisan tinker
App\Post::create(['title'=>'title 2', 'body'=>'body 2']);
// そのままだとエラー！脆弱性エラー
Illuminate/Database/Eloquent/MassAssignmentException with message 'Add [title] to fillable property to allow mass assignment on [App/Post].'
exit

// テーブルの許可するのを書く
vi /src/app/Post.php

// 以下をソース追加。アクセス許可する
protected $fillable = ['title' , 'body'];

// 再度Thinker実行
php artisan tinker
App\Post::create(['title'=>'title 2', 'body'=>'body 2']);

```

▼Tinkerの実行3 Eloquentモデルの操作

```sh
// 一気に書くことも可能
php artisan tinker

App\Post::find(3)->toArray();

// Whereを書くことも可能
App\Post::where('id','>', 1)->get()->toArray();

// Orderbyを書くことも可能
App\Post::where('id','>', 1)->orderby('created_at', 'desc')->get()->toArray();

// Limitも書くこと可能
App\Post::where('id','>', 1)->take(1)->get()->toArray();

// titleの更新
$post = App\Post::find(3);
$post->title = 'title 3 update';
$post->save();
App\Post::find(3)->toArray();

// データ削除
$post->delete();
$post->save();

```

ルーティング設定

Routes/wep.phpで設定

```php
Route::get('/', 'PostsController@index');
```

コントローラーのPHPをartisanコマンドで作成

```sh
php artisan make:controller PostsController
```

  以下のメソッド追加すれば、

http://localhost/　でHelloが表示できる

```
    public function index(){
		 return "hello";
	　 }
```

■Laravelのデバック方法

```php
// dump / die　処理を止め中身確認できる
dd($post->toArray());
```

