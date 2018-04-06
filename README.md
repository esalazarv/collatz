
## Installation

#### Server Requirements

* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension

###### Clone project
```
git clone https://github.com/esalazarv/collatz.git
```

##### Install dependencies
```
cd collatz
composer install

```

##### Configure env file 
Copy `.env.example` and add your database settings
```
cp .env.example .env

```

##### generate APP_KEY and run migrations
```
php artisan key:generate
php artisan migrate:fresh
```

##### Endpoints

For get all records (Only a new record is added if it exceeds the current maximum)
```
{your_host}/api/collatz/records
```

For calculate iterations   
```
{your_host}/api/collatz/{number1}/{number2}
```
