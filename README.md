# LARASTA

"Stage" application with laravel.

## Set up development

### 1. Fork the repo
Fork on your github account the original repo from XCarrel/larasta.

### 2. Clone it
Clone your fork of larasta on your local machine.

```bash
git clone https://github.com/USERNAME/larasta.git FLODER
```

### 3. Set up homestead
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

### 4. Install dependencies
Go to your project folder and run the installation of laravel dependencies.

```bash
cd /path/to/your/local/clone/of/larasta

# install composer dependencies
composer install

# install the npm dependencies
cd public && npm i
```

### 5. Set up your application key
When the dependencies are installed you must duplicate the ``.env.example`` file and rename it to ``.env``.

Then open your ``.env`` file and complete the informations four our specific development environnement (db connexion).

Finally, for laravel to work properly, you must generate the application key.

```bash
cd /path/to/your/local/clone/of/larasta

php artisan key:generate
```

### 6. Add the Intranet API key
To use the intranet API, we need the key and the secret.
To add it, you need to add 2 environment variables in the ``.env`` file of the project.

The name for the key variable is ``API_KEY`` and the name for the secret is ``API_SECRET``

### 7. Simulate intranet login

For your tests, you will want to try working as different users with different privilege levels

You can do that using the ``.env`` file, adding the following keys:

```
USER_ID=1234
USER_INITIALS='ABC'
USER_LEVEL=1
```

### Ready for development
Now, your fork of larasta is working on your machine, you can acces it by the domain name you specified in the Homestead configuration (Don't forget to add it on your host file).

If your have problems, you can check the laravel documentation :  
[Installation](https://laravel.com/docs/5.5/installation)  
[Configuration](https://laravel.com/docs/5.5/configuration)