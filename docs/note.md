# examsテーブルのMigration

- Laravelの`php artisan make:migration create_exams_table --create=exams`でMigrationを生成した。
- `$table->id()`は主キーとなる自動採番の`id`、`$table->string('name')`は試験名、`$table->timestamps()`は`created_at`と`updated_at`を定義する。
- `Schema`、`Blueprint`、各カラム定義メソッドはPHP標準ではなくLaravelのSchema Builderが提供する機能。
- RailsのMigrationと役割は同じだが、Laravelでは`change`ではなく、適用処理を`up()`、取り消し処理を`down()`に明示するのが標準の生成形式。

# データベース設定

このアプリは現在SQLiteを使用している。使用するデータベース接続は`.env`で指定する。

```env
DB_CONNECTION=sqlite
```

- `.env`は環境ごとに変わる接続情報を設定するファイル。現在の`DB_CONNECTION=sqlite`は、SQLite接続を使用する指定。
- `config/database.php`は、Laravelが対応するSQLite、MySQL、PostgreSQLなどの接続方法を定義する設定ファイル。
- `config/database.php`の`default`は`env('DB_CONNECTION', 'sqlite')`となっており、`.env`の`DB_CONNECTION`を読み込む。設定がない場合はSQLiteを使う。
- SQLite接続の`DB_DATABASE`が指定されていない場合、デフォルトで`database/database.sqlite`をデータベースファイルとして使用する。
- これらはPHP標準ではなく、Laravelの設定・環境変数の仕組み。

Railsの`config/database.yml`が担う役割は、Laravelでは主に`.env`と`config/database.php`に分かれている。通常、使用するDBや接続先は`.env`で環境ごとに変更し、接続設定の構造は`config/database.php`で管理する。
