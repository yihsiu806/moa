![](https://github.com/yihsiu806/moa/blob/main/banner.png?raw=true)

# MOA Data Sharing Platform

A platform for the ministry of agriculture to share data internally.

![](https://github.com/yihsiu806/moa/blob/c12f6bbe5251c3b26482722f9c4901de078ce19e/screenshot.jpg)

## Deploy the Website

[Deploy with Apache or Nginx](https://crimson-octave-778.notion.site/MOA-Data-Sharing-Platform-Deployment-Documentation-6ae9270ed68149df9dfef6af0b235eab)

## Development Prerequisite

Your system must have following softwares installed.

* `php7.4`
* `composer`
* `nodejs`
* `mysql`
* `nginx`
* `phpmyadmin`

Here we use `Ubuntu 20` as the devdlopment/deploy machine.

If you are using Windows, please refer to [Laravel](https://laravel.com/) for more information about how to develop Lavavel project on Windows.

### Update System

```sh
sudo apt update
```

### Install `php` on Ubuntu

```
sudo apt install php php-cli php7.4-fpm
```

Check `php` version:

```sh
php --version
```

### Install `composer` on Ubuntu

```sh
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

```sh
sudo mv composer.phar /usr/local/bin/composer
```

Check `composer` version:

```sh
composer --version
```

### Install `nodejs` on Ubuntu

```sh
sudo mkdir -p /usr/local/lib/nodejs
```

```sh
wget https://nodejs.org/dist/v16.14.2/node-v16.14.2-linux-x64.tar.xz
```

```sh
sudo tar -xJvf node-v16.14.2-linux-x64.tar.xz -C /usr/local/lib/nodejs
```

```sh
sudo ln -s /usr/local/lib/nodejs/node-v16.14.2-linux-x64/bin/node /usr/local/bin/
sudo ln -s /usr/local/lib/nodejs/node-v16.14.2-linux-x64/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm
sudo ln -s /usr/local/lib/nodejs/node-v16.14.2-linux-x64/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx
```

Check nodejs version:

```sh
node -v
npm -v
```

### Install `MySQL` on Ubuntu

```sh
sudo apt install mariadb-server
```

Create a database and add a new user for the project.
Use your own `your_username` and `your_password`.
You will use them later.

```sh
sudo mysql -u root
```

Create database:

```sh
create database moa;
```

Create new user with `your_username` and `your_password`:

```sh
create user 'your_username'@'localhost' identified by 'your_password';
```

Grant privileges to the user:

```sh
grant all privileges on moa.* to 'your_username'@'localhost';
```

Exit mysql command line:

```sh
quit
```

### Install `nginx` and `phpmyadmin` on Ubuntu

```sh
sudo apt install nginx
```

```sh
sudo apt install phpmyadmin php-mbstring php-zip php-gd php-json php-curl
```

Press `Tab` to choose `Ok`:

![](https://github.com/yihsiu806/moa/blob/6f11100b8fb2fe0e633126e1c83f9d365a9a265d/phpmyadmin-1.jpg)

Press `Tab` to choose `No`:

![](https://github.com/yihsiu806/moa/blob/6f11100b8fb2fe0e633126e1c83f9d365a9a265d/phpmyadmin-2.jpg)

Create a symlink to web directory:

```sh
sudo ln -s /usr/share/phpmyadmin/ /var/www/html/phpmyadmin
```

Edit nginx config file:

```sh
sudo vi /etc/nginx/sites-enabled/default
```

Paste following config:

```
server {
    listen 80 default_server;
    listen [::]:80 default_server;

    server_name _;

    index index.php index.html;

    root /var/www/html;

    location / {
        try_files $uri $uri/ /index.php?q=$uri&$args;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
    }
}
```

Reload nginx:

```sh
sudo systemctl reload nginx
```


Visit `phpmyadmin` in your browser, use `your_username` and `your_password` to log in.

http://127.0.0.1/phpmyadmin/

![](https://github.com/yihsiu806/moa/blob/6f11100b8fb2fe0e633126e1c83f9d365a9a265d/phpmyadmin-3.jpg)


If encounter any problem, please make sure all required services is running: 

```sh
sudo systemctl start nginx
sudo systemctl start php7.4-fpm
sudo systemctl start mysql
```

Make sure that firewall allow port 80:

```sh
sudo ufw allow 80
```

## Project Installation

Clone the repo locally:

```sh
git clone https://github.com/yihsiu806/moa.git
```

```sh
cd moa
```

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm ci
```

Build assets:

```sh
npm run dev
```

Generate application key:

```sh
php artisan key:generate
```

Setup configuration:

```sh
cp .env.example .env
```

Modify `.env`:

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=moa
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

Run the dev server (the output will give the address):

```sh
php artisan serve
```

You're ready to go! Visit Ping CRM in your browser, and login with:

| Username | Password      |
| -------- | ------------- |
| admin    | admin_2022    |
| division | division_2022 |
| viewer   | viewer_2022   |

Please refer to the [Development Documentation](https://www.notion.so/MOA-Data-Sharing-Platform-Documentation-381e07afd3d84254b611681b8ded2fec) for more information about the code structure.
