#!/bin/sh
until nc -z db 3306; do echo '⏳ Aguardando MySQL...'; sleep 1; done
echo '✅ MySQL disponível. Rodando setup...'

echo '✅ Rodando composer install...'
composer install
echo '✅ Rodado composer install com sucesso'

echo '✅ Rodando npm install e npm build...'
npm install
npm run build
echo '✅ Rodado npm install e npm build com sucesso'

echo '✅ Rodando migration e seeds...'
php artisan migrate --force
php artisan db:seed --force
echo '✅ Rodado migration e seeds com sucesso'

echo '✅ Rodando comando para gerar documentação do swagger...'
php artisan l5-swagger:generate
echo '✅ Rodado comando para gerar documentação do swagger com sucesso'

echo "🔧 Rodando migrations e seeders para testes..."
php artisan migrate:fresh --env=testing
php artisan db:seed --class=TestSeeder --env=testing

echo "🧪 Executando testes PHPUnit..."
php artisan test --env=testing

echo '🚀 Aplicação pronta!'
exec php-fpm
