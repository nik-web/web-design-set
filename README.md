# Create your own web design set.

## Introduction
Create your own web design set use SASS and Js.

## Install on Debian 11

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

### Create a package.json file
https://docs.npmjs.com/cli/v9/commands/npm-init
```bash
$ npm init
```

### Install sass
https://sass-lang.com/dart-sass   
https://www.npmjs.com/package/sass
```bash
$ npm install sass --save-dev
```

## SASS Setup
https://sass-lang.com/guide

### Create this folders and files
```bash
$ mkdir scss/
$ touch scss/styles.scss
$ mkdir -p public/css/
$ mkdir scss/basis/
$ touch scss/basis/_index.scss
```

### Add the scripts
```bash
$ vim package.json
```
Add this line, to watch and output to directories by using folder paths as your input and output, and separating them with a colon.
```vim
"compile:sass": "sass --watch scss:public/css"
```
Add this line, to compile min. css
```vim
"compile-min:sass": "sass scss/styles.scss:public/css/styles.min.css --style compressed"
```

### Run sass scripts
```bash
$ npm run compile:sass
$ npm run compile-min:sass
```

## Customizing basis data
```bash
$ vim scss/_custom.scss
```
Add this to import basis
```vim
// Import basis-data
@import "./basis/index.scss";
``` 
```bash
$ vim scss/style.scss
```
Add this  
```vim
@use 'custom';
```  
The @use rule loads mixins, functions, and variables from other Sass stylesheets, and combines CSS from multiple stylesheets together.   
Stylesheets loaded by @use are called "modules".

## Create basic data

### Create directory structure



## Create or update basic-copy
Run this script from project folder

```bash
    $ cd path/to/install
    $ ./bin/update-basis-copy
```  

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

## Running Unit Tests

To run the unit tests, you need to do one of the following:

- Install the MVC test support with [laminas-test](https://docs.laminas.dev/laminas-test/)

```bash
$ cd path/to/install
$ composer require --dev laminas/laminas-test
```

Once testing support is present, you can run the tests using:

```bash
$ cd path/to/install
$ ./vendor/bin/phpunit