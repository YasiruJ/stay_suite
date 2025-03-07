# Gimanhal Server

## To run the project execute following commands.

```
composer i
```

```
php artisan migrate:fresh --seed
```

```
php artisan jwt:secret
```

```
php artisan jwt:generate-certs
```

```
php artisan serve
```
---

### Format

```
./vendor/bin/pint
./vendor/bin/duster lint
./vendor/bin/duster fix
```

### Cache
```
php artisan config:cache

php artisan route:cache

php artisan view:cache

php artisan storage:link
```

### Cache Clear
```
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
composer dump-autoload
```

### Run this to generate dummy data. Do not run this in production.

```
php artisan db:seed --class=DevSeeder
```

---
### Generate API Documentation
> Visit /docs to view documentation.
```
php artisan scribe:generate
```
### Generate Database Graph
```
php artisan generate:erd
```
## Install these packages to optimize images
```
sudo apt-get install jpegoptim
sudo apt-get install optipng
sudo apt-get install pngquant
sudo npm install -g svgo
sudo apt-get install gifsicle
sudo apt-get install webp
```
### Use Tinker
```
php artisan tinker
```

### Wipe Database

```
php artisan db:wipe
```

### Clear Cache

```
php artisan cache:forget spatie.permission.cache
php artisan cache:clear
```

### Generate Controller

```
php artisan make:controller <Controller Name> --resource
```

### Generate API Controller

```
php artisan make:controller API/PhotoController --api
```

```
php artisan migrate:fresh --seed
```

### Generating Migrations

```
php artisan make:migration create_users_table --create=users --table=users
```
### Generate Seeders
```
php artisan make:seeder UserSeeder
```

### Generate Model

```
php artisan make:model Flight --migration
php artisan make:model Flight --factory
php artisan make:model Flight --seed
php artisan make:model Flight --controller
php artisan make:model Flight -mfsc
```

### Create Observers

```
php artisan make:observer UserObserver --model=User
```

### Generating Resources

```
php artisan make:resource User
php artisan make:resource User --collection
```

### Publish http error views

```
php artisan vendor:publish --tag=laravel-errors
```

### Generate factory

```
php artisan make:factory PostFactory --model=Post
```

### Generate Enum

```
php artisan make:enum RoleType
```

### Annotate Enum

```
php artisan enum:annotate
```

### Add this cron job to run scheduler

```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```
### Import all existing records into search indexes

```
php artisan scout:import "App\Models\Property"
```
### Remove all of a model's records from search indexes

```
php artisan scout:flush "App\Models\Property"
```
