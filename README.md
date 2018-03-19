Partially random passwords (PoC)
---
this demo project shows how we can implement a system with partially random passwords, to protect users passwords from keyloggers

## How to install
- clone the repo and create a new database
- edit `.env` file and update the following
```
DB_DATABASE=DB_NAME
DB_USERNAME=DB_USERNAME
DB_PASSWORD=DB_PASSWORD
```
- install the dependencies of the demo
```
cd partially-random-passwords
composer install

```

-after the installation ends, you can view the launch the demo:
```
php artisan serve
```
and then visit `http://127.0.0.1:8000`

## How to test
- Register a new account
- Login and click on your username (upper right corner), and choose a new password and the details of the random part (position and length)
- Logout and try to login with the email address you used to register and your password. you should see an error message.
- try to login again but this time use the random part with your password. the login should be successful 
- logout and try to login again with the same password and the same random part, you should see and error message telling you that the password was used before.
- logout and try to login again using a different random part. the login should be successful this time as well.




