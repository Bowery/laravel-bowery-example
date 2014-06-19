laravel-example
===============


An example Laravel application powered by Bowery.

## Short version
1. Type `bowery connect` to do an initial upload of your files.
2. `bowery ssh web`, then run 

```
// so the .phar file is executable
cd /application && chmod +x laravel.phar

// generate the laravel app and move it to the parent
./laravel.phar new todo && mv todo/* . && rm -rf todo

// install the generators package
patch composer.json < composer.json.patch

// update composer
composer update --dev

// enable the generators for artisan
patch app/config/app.php < app.php.patch

// say yes to all steps except "Do you want to go ahead and migrate the database? [yes|no]"
php artisan generate:resource task --fields="description:text, completed:boolean"

// fixes routing with laravel
patch /etc/apache2/sites-enabled/000-default.conf < 000-default.conf.patch

// ensures the file exists so we don't get permissions issues along the way
touch /application/app/storage/logs/laravel.log

// make sure it's writable by Apache
chown -R www-data:www-data /application/app/storage

// start Apache for the first time
service apache2 restart

// to go back to your local computer
exit

```

3. `bowery ssh db`, and then run

```
// connect to mysql (your_password is the default password)
mysql --user=root --password=your_password

// the default root user is only available on localhost
CREATE USER 'root'@'%' IDENTIFIED BY 'your_password';

// give that user access to all database operations
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;

// create our database
create database todo;

// exit back to command line
exit

// exit back to local machine
exit

```

4. Run `bowery pull` (say yes to overwriting) and then `bowery connect`. Keep connect running and open a new terminal window.

```
$ bowery pull
Looks like you're trying to pull down an app into a non-empty directory
Proceeding will overwrite the contents of this directory.
Are you sure you want to proceed?(y/n): y
$ bowery connect
Hey there Zach. Connecting you to Bowery now...
Services are availble in the forms:
  <name>.<id>.boweryapps.com
  <port>.<name>.<id>.boweryapps.com
Skipping file changes for db, no path given.
Service db is available at:
  db.53a2055dc03a70946c000007.boweryapps.com
  3306.db.53a2055dc03a70946c000007.boweryapps.com
Uploading file changes to web, check "bowery logs" for details.
Service web is available at:
  web.53a2055dc03a70946c000007.boweryapps.com
Service web upload complete. Syncing file changes.
```

5. Run `patch app/config/database.php < database.php.patch` in the folder on your local machine since database.php.patch needs to exist locally.

6. `bowery ssh web` and then run

```
// basically, this searches our .htaccess file for the database address and writes it to the .env.php file

echo "<?php return array('DB_PORT_3306_ADDR' => '"$(cat /application/.htaccess | grep DB_PORT_3306_ADDR | awk '{print $3}')"');" > /application/.env.php

// migrate the database creating tables-continue if prompted
php artisan migrate

// exit back to local machine
exit

```

7. Move files into their correct locations

```
$ mkdir app/views/layouts
$ mv ./step7/main.blade.php ./app/views/layouts/main.blade.php
$ mv ./step7/BaseController.php ./app/controllers/BaseController.php
$ mv ./step7/routes.php ./app/routes.php
$ mv ./step7/TasksController.php ./app/controllers/TasksController.php 
$ mv ./step7/create.blade.php ./app/views/tasks/create.blade.php
$ mv ./step7/edit.blade.php ./app/views/tasks/edit.blade.php
$ mv ./step7/index.blade.php ./app/views/tasks/index.blade.php
$ mv ./step7/Task.php ./app/models/Task.php



```

## Longer version

1.  Add services
```
$ bowery add web
Image: php55
Path: .
Ports:
Start Command:
Build Command:
Test Command:

$ bowery add db
Image: mysql
Path:
Ports: 3306
Start Command:
Build Command:
Test Command:
```






