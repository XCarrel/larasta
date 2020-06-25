# LARASTA

"Stage" application with laravel.

## Requirement
* composer
* npm
* PHP 7.4 or later
* On php.ini you must have to enable the following modules :
  * curl
  * fileinfo
  * gd2
  * mbstring
  * exif
  * pdo_mysql

## Set up development

### 1. Clone the repository
Clone https://github.com/CPNV-ES/larasta.git on your local machine.

### 2. Set up homestead (optional)
Follow the installation steps for homestead [here](https://laravel.com/docs/5.5/homestead).

Once homestead are installed, you must add to your homestead configuration the path to your fresh clone of larasta.

Homestead.yaml :
```yaml
# Set up the synced folders
folders:
    - map: /path/to/your/local/clone/of/larasta
      to: /path/in/the/vm

# Set up the nginx virtualhost
sites:
    - map: domainname.dev
      to: /path/in/the/vm
```

### 3. Install dependencies
Go to your project folder and run the installation of laravel dependencies.

```bash
cd /path/to/your/local/clone/of/larasta

# install composer dependencies
composer i

# install the npm dependencies
npm i
```

To create all js and css files

```bash
# install the npm dependencies
npm run dev
```

### 4. Set up your application key
When the dependencies are installed you must duplicate the ``.env.example`` file and rename it to ``.env``.

Then open your ``.env`` file and complete the informations four our specific development environnement (db connexion).

Finally, for laravel to work properly, you must generate the application key.

```bash
cd /path/to/your/local/clone/of/larasta

php artisan key:generate
```

### 5. Create and seed the database

In terminal, use the next command to create database with required data:
```
php artisan mysql:createdb larasta
php artisan migrate --seed
```

if you want add test data:
```
php artisan db:seed --class="TestDataSeeder"
```

### 6. Fix some file system details

Laravel accesses a storage directory through a link and backup locations. Initialise it with:

```
php artisan make:tree
```

After cloning, some files/folders have bad access attributes. let's take the blunt approach and

```
chmod -R 777 *
```

### 7. Login

For your tests, you will want to try working as different users with different privilege levels

You can do that using the ``.env`` file, adding the following keys:

```
USER_ID=1
```

The default admin user as the id 1, If you want to change is privilege. You have to modify it directly in the database.

To get the information of the authentified user use this method `Auth::user()` in your code.

The github authentication only work on the swisscenter server.

### 10. PHP version
There are some issues between the version of Laravel used in this project and the most recents PHP versions. The PHP version used with the project should be PHP 7.4.

### Ready for development
Now, your fork of larasta is working on your machine, you can acces it by the domain name you specified in the Homestead configuration (Don't forget to add it on your host file).

If your have problems, you can check the laravel documentation :  
[Installation](https://laravel.com/docs/5.5/installation)  
[Configuration](https://laravel.com/docs/5.5/configuration)
