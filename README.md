
## Requirements

- PHP >= 7.4



## Installation

- Run command "composer install".
- Run command "composer dump-autoload".


## Run Project
- Run command "php artisan serve".
- Use url: http://127.0.0.1:8000/

## Notes
```php
I have created below keys in AWS sceret manager:
DB_USERNAME
DB_PASSWORD	
STRIPE_KEY
STRIPE_SECRET
MAIL_USERNAME
MAIL_PASSWORD

And access all above key in HomeController using laravel config method.

I have used AWS secret manager for storing important keys.
I have created my own service provider "SecretManagerServiceProvider" and service "AwsSecretManagerService".
At the time of laravel bootstrapping, all values will be assigned to the env variable. 
Now we can access all keys values using laravel config methods.
When we change any value on AWS it will change automaticaly in our project.

```

