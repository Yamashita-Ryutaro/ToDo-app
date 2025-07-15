FROM php:8.0-cli

# 作業ディレクトリをLaravelのルートに
WORKDIR /var/www

# cronとprocps（psコマンド入り）をインストール
# DBのドライバーも
RUN apt-get update \
    && apt-get install -y cron procps zlib1g-dev mariadb-client libzip-dev \
    && docker-php-ext-install zip pdo_mysql

# crontabファイルをコピー
COPY ./crontab /etc/cron.d/laravel-scheduler

# crontabファイルのパーミッション変更
RUN chmod 0644 /etc/cron.d/laravel-scheduler

# cronをフォアグラウンドで起動
CMD ["cron", "-f"]