#!/bin/sh
until nc -z db 3306; do echo '⏳ Aguardando MySQL...'; sleep 1; done
echo '✅ MySQL disponível. Rodando setup...'

echo '✅ Rodando composer install...'
composer install
echo '✅ Rodado composer install com sucesso'

echo '✅ Rodando npm install...'
npm install
echo '✅ Rodado npm install com sucesso'

echo '✅ Rodando npm run build...'
npm run build
echo '✅ Rodado npm run build com sucesso'

echo '✅ Rodando migration...'
php artisan migrate --force
echo '✅ Rodado migration com sucesso'

echo '✅ Rodando seeds...'
php artisan db:seed --force
echo '✅ Rodado seeds com sucesso'

echo '✅ Rodando comando para gerar documentação do swagger...'
php artisan l5-swagger:generate
echo '✅ Rodado comando para gerar documentação do swagger com sucesso'

echo '🚀 Aplicação pronta!'
exec php-fpm
