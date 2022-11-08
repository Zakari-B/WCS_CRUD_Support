# Simple MVC - CRUD exercise

## Steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create _config/db.php_ from _config/db.php.dist_ file and add your DB parameters. Don't delete the _.dist_ file, it must be kept.

```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PASSWORD', 'your_db_password');
```

4. Import _database.sql_ in your SQL server, you can do it manually or use the _migration.php_ script which will import a _database.sql_ file.
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
6. Go to `localhost:8000` with your favorite browser.
7. From this starter kit, create your own web application.

## Goal

Using the ItemController example provided, try to create a BlogController and the other required files to implement a working CRUD for blog articles.

An article in the database must have :

-   An id
-   A title
-   A content

You can modify the database.sql file before using `php migrate.php` to create the required table with those fields.

As a reminder, CRUD stands for Create Update Read Delete, so the end result must implement the following methods :

-   Create (to add or insert a new article in the database)
-   Read (to read or view one or multiple articles in the database, so there wil need to be 2 methods, one to select all articles, and the other one to select only one)
-   Update (to modify one of the entries in the database)
-   Delete (to remove one of the entry from the database)

The routes.php file already provides the required routes but feel free to modify them if you want or need to.

### Bonus

Once you're done, try to add an user table in the database with a name and an id, and add a foreign key to the article table to link the article with the user who posted it.
