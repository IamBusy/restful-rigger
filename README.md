# restful-rigger
A project to help startups to develop a restful style backend swiftly based on [Laravel5.5](https://laravel.com)

In the past few months or years, I developed several backend of web projects. These projects have some
features in common that they are **developed for startups**, **required rapid iteration of business** and 
**bad performance can be ignored**. 

So a idea struck to me that why I don't write a rigger to help me develop this kind of projects.

# Install
```
git clone https://github.com/IamBusy/restful-rigger.git
cd restful-rigger
composer install
cp .env.example .env
```

Then configure the `.env` file according to your environment
When database source is configured, then you can execute cmds 
to use base authentication and authorization function.

```
php artisan passport:install
```

This will create tables in your database, and then you can
modify `OAUTH_CLIENT_SECRET` `OAUTH_CLIENT_ID` according to the
record in `oauth_clients` table.