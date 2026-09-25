## Prerequisites
- PHP with extensions enabled
- Composer
- Node Package Manager
## Installation
1. Clone the repo 
```
git clone https://github.com/SleepyFeeshy/pmc_submission_romualdez.git
```

2. Install PHP dependencies
```
composer install
```

3. Run database migration and seeders
```
php artisan migrate:fresh --seed
```

4. Install Node dependencies and build assets
```
npm install
npm run build 
```

5. Run the project
```
php artisan serve
```

6. (Optional): For real-time asset compilation during local development
```
npm run dev
```