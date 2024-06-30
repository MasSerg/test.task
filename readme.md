# Test task
#### * tested on PHP 8.3 version

## Installation steps

```bash
git clone https://github.com/MasSerg/test.task.git

cd /test.task

mv .env.example .env

composer install
```

## Run
```bash
php app.php input.txt
```

## Run test
```bash
./vendor/bin/phpunit tests     
```