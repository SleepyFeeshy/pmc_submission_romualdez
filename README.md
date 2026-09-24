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

3. Run database seeders
```
php artisan migrate:fresh --seed
```

4. Run the project
```
php artisan serve
```