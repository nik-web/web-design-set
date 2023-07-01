# Create your own web design set.

## Introduction

Create a Laminas MVC project and add your own web design set use SASS and Js.

## Install

### Check if git is installed
```bash
$ git --version
git version 2.30.2
```

### Clone from GitHub
```bash
$ cd <directory to install>
$ git clone https://github.com/nik-web/web-design-set.git
```

### Check if composer is installed
```bash
$ composer
Composer version...
```

### Run Composer
```bash
$ cd <directory to install>/web-design-set
$ composer install
```

### Check if node is installed
```bash
$ node -v
v12.22.12
$ man node
node — server-side JavaScript runtime ...
```
### Check if npm is installed
```bash
$ npm -v
7.5.2
$ man npm
npm - javascript package manager ...
```

### Run npm
https://docs.npmjs.com/cli/v9/commands/npm-install
```bash
$ cd <directory to install>/web-design-set
$ npm install
```
This install dart-sass
https://sass-lang.com/dart-sass   
https://www.npmjs.com/package/sass

### Run sass scripts
```bash
$ npm run compile:sass
$ npm run compile-min:sass
```

## Customizing basis data

```bash
$ vim scss/_custom.scss
```

## Create or update basic-copy
Run this script from project folder

```bash
    $ cd <directory to install>/web-design-set
    $ ./bin/update-basis-copy
```

## Add the provider data

```bash
    $ cd <directory to install>/web-design-set/module/Application/src/ValueObject/
    $ cp Provider.php.dist Provider.php
```
Enter your data into the constants in this file.

## Running Unit Tests

The testing support is present, you can run the tests using:
```bash
$ cd path/to/install
$ ./vendor/bin/phpunit
```

## Run on web server

Once installed, you can test it out immediately using PHP's built-in web server:

```bash
$ cd path/to/install
$ php -S 0.0.0.0:8080 -t public
```
OR use the composer alias:

```bash
$ composer serve
```

Visit the site at:
http://localhost:8080/

## Use in other projects in the same directory.

```bash
    $ cd path/to/<other-project>
    $ mkdir bin/
    $ cp ../web-design-set/bin/update-basis-copy bin/
    $ chmod -v 755 bin/update-basis-copy
    $ mkdir scss/
    $ cp ../web-design-set/scss/_custom.scss scss/
    $ chmod -v 755 scss/_custom.scss
    $ cp ../web-design-set/scss/styles.scss scss/
    $ chmod -v 755 scss/styles.scss
```
  
## Use development mode

```bash
$ ./vendor/bin/laminas-development-mode enable  # enable development mode
$ ./vendor/bin/laminas-development-mode disable # disable development mode
```