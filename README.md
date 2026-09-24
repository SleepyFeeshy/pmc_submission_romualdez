## Prerequisites
- PHP
- Composer

## Installation
1. Clone the repo 
```
git clone https://github.com/SleepyFeeshy/pmc_submission_romualdez.git
```

2. Install composer packages
```
composer install
```

3. Run database migration and database seeders
```
php artisan migrate:fresh --seed
```

4. Install JavaScript dependencies
```
npm install
```

5. Compile assets
```
npm run build 
```

6. Run the project
```
php artisan serve
```