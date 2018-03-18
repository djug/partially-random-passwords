Password Based Roles and Actions (PoC)
---
this demo project shows how we can implement a password based roles and actions system.

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
cd password-based-roles-actions
composer install

```

-after the installation ends, you can view the launch the demo:
```
php artisan serve
```
and then visit `http://127.0.0.1:8000`

## How to test
- Register a new account
- Login click on your username (upper right corner), and create new sub-account (all what you have to do is choose passwords for the restricted and trigger account).
- Logout and try to login with the email address you used to register and the "restricted account" password, you should see now a different welcome message (it means that you are inside the restricted account).
- Logout and login one more time with the trigger password this time, you'll see a different welcome page as well.
- logout and try to login again, you'll see an error message (the account was disabled since you logged in with the trigger account in the previous step).



