# For Heroku:
release: php bin/console post-install
web: vendor/bin/heroku-php-nginx -C nginx.inc.conf public/
worker: php bin/console worker

# For fly.io through Heroku builder (with worker instead of cron)
#web: ./start.sh
