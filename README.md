App test
========

run composer

```
composer install
```

add your access_key in **index.php**

```php
new \MessageBird\Client('your access key');
```

execute command line to send the sms
```php
php index.php
```

When the user send a sms will save in **DBSms** folder and the php runned in command line will process this file.
Each sms sent will save a file.json and after sent remove the file!

I know I could used database to save this list sms But I resolved save in file to application not depends a database.