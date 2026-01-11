*Server Requirements
-PHP ≥ 8.2
-Composer ≥ 2.x
-MySQL ≥ 8.0 (InnoDB)

*Project Setup
1 Clone & install dependencies
git clone <repo_url>
cd lunar-backend
composer install

2 Setup environment
cp .env.example .env
php artisan key:generate
Edit .env:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_lunar
DB_USERNAME=root
DB_PASSWORD=

3 Run database migration
php artisan migrate

4 Create cache tables
php artisan cache:table
php artisan migrate

5 Run development server
php -S 127.0.0.1:8000 -t public
http://127.0.0.1:8000

*Running Background Worker (Queue)
Set in .env:
QUEUE_CONNECTION=database

Create queue tables:
php artisan queue:table
php artisan migrate

Run the worker:
php artisan queue:work

*Concurrency Stress Test
for i in {1..50}; do
  curl -X POST http://127.0.0.1:8000/api/purchase/1 &
done
wait

