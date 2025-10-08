#!/bin/sh

echo "⏳ Aguardando MySQL..."
until nc -z db 3306; do sleep 1; done
echo "✅ MySQL disponível"

echo "🔧 Rodando migrations e seeders para testes..."
php artisan migrate:fresh --env=testing
php artisan db:seed --class=TestSeeder --env=testing

echo "🧪 Executando testes PHPUnit..."
php artisan test --env=testing

echo "✅ Testes concluídos"
