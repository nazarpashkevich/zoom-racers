<!--
envoy run deploy     - update local for developer
-->

@servers(['localhost' => '127.0.0.1'])

@setup
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
@endsetup

@story('deploy')
update_server
@endstory


@task('update_server')
php artisan migrate --force
php artisan db:seed --force
php artisan optimize:clear
php artisan optimize
php artisan queue:restart
php artisan storage:link
@endtask

@finished
@telegram(env('ENVOY_TELEGRAM_BOT_ID'),env('ENVOY_TELEGRAM_CHAT_ID'), 'Server updated!')
@endfinished
