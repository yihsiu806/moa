# MOA Data Sharing Platform

A platform for the ministry of agriculture to share data internally.

![](screenshot.png)

## Prerequisite

Your system must have following softwares installed.

* `php7.4`
* `composer`
* `nodejs`
* `mysql`
* `nginx`
* `phpmyadmin`

I use `Ubuntu 20` as my devdlopment/deploy machine.

### Install `php` on Ubuntu

```
sudo apt update
sduo apt install php-cli
```

Check `php` version

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

Check `composer` version

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
sudo ln -s /usr/local/lib/nodejs/node-v16.14.2-linux-x64/bin/n
ode /usr/local/bin/
sudo ln -s /usr/local/lib/nodejs/node-v16.14.2-linux-x64/lib/n
ode_modules/npm/bin/npm-cli.js /usr/local/bin/npm
sudo ln -s /usr/local/lib/nodejs/node-v16.14.2-linux-x64/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx
```

Check nodejs version
```sh
node -v
npm -v
```

### Install `MySQL` on Ubuntu

```sh
sudo apt install mariadb-server
```

Create database and a user for the project.
Use your own `your_username` and `your_password`.
You will need them later.

```sh
sudo myadmin -u root

create database moa;
create user 'your_username'@'localhost' identified by 'your_password';
grant all privileges on moa.* to 'your_username'@'your_password';
```

### Install `nginx` and `phpmyadmin` on Ubuntu

```sh
sudo apt install nginx
```

```sh
sudo apt install phpmyadmin php-mbstring php-zip php-gd php-json php-curl
```

Press `Tab` to choose `Ok`
![](phpmyadmin-1.png)

Press `Tab` to choose `No`

![](phpmyadmin-2.png)


Create a symlink to web directory
```sh
sudo ln -s /usr/share/phpmyadmin/ /var/www/phpmyadmin
```

Edit nginx config
```sh


```

Make all required services is started. 
```sh
sudo systemctl start nginx
sudo systemctl start php7.4-fpm
sudo systemctl start mysql
```

Visit `phpmyadmin` in your browser, use `your_username` and `your_password` to log in.

## Project Installation

Clone the repo locally:

```sh
https://github.com/yihsiu806/moa.git
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

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Set `.env`

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

- **Username:** johndoe@example.com
- **Password:** secret

Please refer to the (wiki)[https://github.com/yihsiu806/moa/wiki] for more information about the code structure.

## Deploy the website with `nginx`

After install the project, you can deploy the website by nginx.

Modify nginx config:

```sh

```

Create symlink:
```sh

```

Change privilege:
```sh

```

## Deploy the website with `apache`