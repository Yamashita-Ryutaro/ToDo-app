# ToDoアプリケーション

- ララベルの練習で作成

# メモ
ドッカーのコンテナ内でこれを実行しないと、localhostがうまく開けなかった。
- chown -R www-data:www-data /var/www/TodoApp/storage
- chown -R www-data:www-data /var/www/TodoApp/bootstrap/cache
- chmod -R 775 /var/www/TodoApp/storage
- chmod -R 775 /var/www/TodoApp/bootstrap/cache
