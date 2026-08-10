---
name: laravel-feature
description: Laravelアプリケーションの機能追加・変更を、小さく標準的な設計で実装・テストし、PHPとLaravelの機能を区別して説明する。Laravelの機能開発、既存機能の変更、関連テストの追加を依頼されたときに使用する。必要に応じてRubyやRuby on Railsの対応概念と比較する。
---

# Laravel機能開発

このSkillはLaravelの機能追加・変更を行うときに使用する。

## 前提

開発者は以下を理解している。

- Ruby
- Ruby on Rails
- MVC
- RDB
- Migration
- Routing
- Controller
- Model
- RSpec

そのため、一般的なプログラミングの基礎説明は不要。

PHP固有の構文、PHPとRubyの違い、LaravelとRailsの違いを重点的に説明する。

## 作業手順

### 1. 既存実装を確認する

変更する前に関連する以下のファイルを確認する。

- routes
- controllers
- models
- migrations
- frontend
- tests

### 2. 実装方針を簡潔に説明する

大きめの変更では、実装前に以下を説明する。

- 何を変更するか
- どのLaravelの機能を使うか
- どのファイルを変更するか

必要であればRailsで対応する概念も示す。

### 3. 小さく実装する

Laravel標準の機能を優先する。

- Route
- Controller
- Eloquent
- Migration
- Validation
- Seeder
- Factory
- Blade / frontend

将来必要になるかもしれないという理由だけで、
不要な抽象化や機能追加を行わない。

### 4. PHPとLaravelを区別する

実装後の説明では、

#### PHP

- 構文
- 型
- 配列
- foreach
- クラス
- プロパティ
- namespace
- trait
- closure

などPHP言語としての機能を説明する。

#### Laravel

- Eloquent
- Collection
- Routing
- Controller
- Validation
- Migration
- Service Container

などLaravelが提供している機能を説明する。

Laravelの機能をPHP標準機能のように説明しないこと。

### 5. Ruby / Railsと比較する

理解の助けになる場合のみ比較する。

PHP:

```php
foreach ($questions as $question) {
    //
}
```

Ruby:

```rb
questions.each do |question|
 # ...
end
```

単に似ていると説明するだけでなく、挙動に重要な違いがあれば説明する。

### 6. テストする

実装後は関連するテストを実行する。
必要な場合は小さなテストを追加する。

### 7. 学習内容をまとめる

実装後、必要に応じて以下を簡潔にまとめる。

- 今回使ったPHPの知識
- 今回使ったLaravelの知識
- Railsとの主な違い
- 主な変更ファイル

まとめた内容は./docs/note.mdに追記で書き込む。
