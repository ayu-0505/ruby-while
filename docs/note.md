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

# questionsテーブルのMigration

- `questions`テーブルに、問題が属する試験を示す`exam_id`、問題文の`body`、解説の`explanation`を定義した。
- `foreignId('exam_id')->constrained()`は、`exam_id`を外部キーとして`exams.id`へ関連付けるLaravelのSchema Builderの機能。
- `cascadeOnDelete()`により、親の試験を削除したときは、その試験に属する問題も削除される。
- 問題文と解説は長文を扱うため、`string`ではなく`text`型を使用した。
- Rails Migrationの`references :exam, foreign_key: true`に相当する処理を、Laravelでは`foreignId()->constrained()`で記述できる。

# ExamとQuestionのリレーション

- `Exam::questions()`に`hasMany(Question::class)`を定義し、1つの試験が複数の問題を持つ関係を表した。
- `Question::exam()`に`belongsTo(Exam::class)`を定義し、1つの問題が1つの試験に属する関係を表した。
- Eloquentはメソッド名とモデル名から、`questions.exam_id`を外部キーとして自動的に使用する。
- LaravelではRailsの`has_many :questions`や`belongs_to :exam`のようなクラスマクロではなく、リレーションオブジェクトを返すPHPのメソッドとして関連を定義する。

# choicesテーブルのMigration

- `choices`テーブルに、選択肢が属する問題を示す`question_id`、選択肢の内容を表す`body`、正解かどうかを表す`is_correct`を定義した。
- `boolean('is_correct')`は真偽値を保存するカラムを定義するLaravelのSchema Builderの機能。
- `foreignId('question_id')->constrained()->cascadeOnDelete()`により、`questions.id`への外部キーを設定し、問題を削除したときに所属する選択肢も削除する。

# QuestionとChoiceのリレーション

- `Question::choices()`に`hasMany(Choice::class)`、`Choice::question()`に`belongsTo(Question::class)`を定義した。
- PHPの戻り値型として`HasMany`と`BelongsTo`を宣言し、実際の関連付けはLaravelのEloquentが提供するメソッドで行う。
- Railsの`has_many :choices` / `belongs_to :question`に対応するが、Laravelでは関連をPHPメソッドとして記述する。
