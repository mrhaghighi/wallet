# Summary

This project was created with `Lumen 8`. It's used for a simple wallet. We can get balance and increase it.

## Installation

For starting you only should install dependencies packages by composer:

```bash
composer install
```

Then you should create a database with `wallet` name and change DB_* variables in .env as for your MySQL credential and `wallet` database name.

## Requirements

| Name | Version |
|---|---|
| PHP | ^7.3 |
| MySQL | ^5.7 |

## Getting Started

### Run Project

```bash
php -S localhost:8000 -t public
```

## Endpoints

### Get Balance

```bash
# GET /balances/<user_id>
+ Response 200 (application/json)
    {
        {
            "status": "success",
            "data": {
                "balance": 100
            },
            "message": null
        }
    }
```

### Increase Balance

```bash
# POST /add-balance
user=<user_id>
amount=<increase_amount>
+ Response 200 (application/json)
    {
        {
            "status": "success",
            "data": {
                "reference_number": 4359755362
            },
            "message": null
        }
    }
```

## Commands

### Show Today Transactions Amount

```bash
php artisan transactions:today
```

### Show Total Transactions Amount

```bash
php artisan transactions:total
```

## Environment

```bash
APP_NAME=${appName}
APP_ENV=${appEnv}
APP_KEY=${appKey}
APP_DEBUG=${debugMode}
APP_URL=${appUrl}
APP_TIMEZONE=${appTimezone}

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=${databaseHost}
DB_PORT=${databasePort}
DB_DATABASE=wallet
DB_USERNAME=${databaseUsername}
DB_PASSWORD=${databasePassword}
```

## Contributing

MohammadReza Haghighi: [LinkedIn Account](https://www.linkedin.com/in/mr-haghighi/)
