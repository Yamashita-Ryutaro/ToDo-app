# ToDoアプリケーション

- ララベルの練習で作成
- この[サイト](https://zenn.dev/eguchi244_dev/books/laravel-tutorial-books)を参考にした。
- コーディング規約は理系ナビもものを遵守するように変更。

# メモ
- /var/www/TodoApp/vendor# でcomposer installを実行すること。
- crontabの改行コードは LFにする


ドッカーのコンテナ内でこれを実行しないと、localhostがうまく開けなかった。
- chown -R www-data:www-data /var/www/TodoApp/storage
- chown -R www-data:www-data /var/www/TodoApp/bootstrap/cache
- chmod -R 775 /var/www/TodoApp/storage
- chmod -R 775 /var/www/TodoApp/bootstrap/cache
- chown -R www-data:www-data storage bootstrap/cache
- chmod -R 775 storage bootstrap/cache


コンテナ内ででdbにアクセスするコマンド
- mysql -h db -P 3306 -u admin -p

マイグレーションファイルの実行
- php artisan migrate

マイグレーションをリセットして再実行
- php artisan migrate:fresh

Composerをオートロードしてシーダーを認識させる
- composer dump-autoload

シーダーの実行
- php artisan db:seed

テーブルをリセットしてシーダーの実行
- php artisan migrate:fresh --seed
