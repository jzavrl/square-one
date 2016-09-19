# Square One
Drupal 7 and Drupal 8 starter theme files with Gulp tasks.

## Installation
To start using the theme, download it to your themes directory and rename all instances of the word _square-one_ into your own theme name. After that you will also need to install node modules in order to get your Gulp tasks working.

```sh
cd .npm
npm install
gulp
```

This will install all of the needed node modules and also run the initial tasks including the watcher task. After that it's up to you to start developing and writting some CSS, JS, Twig and PHP code.

## Structure
Here is a quick rundown of the structure of the theme files and folders.

### Gulp
```
.npm
    |-- gulp
        |-- tasks
            |-- images.js
            |-- scripts.js
            |-- styles.js
            |-- watch.js
        |-- config.json
    |-- gulpfile.js
    |-- package.json
```

Inside of the _gulp_ folder you can find a folder with broken down task _.js_ files and also a _config.json_ file which contains all the configuration such as input and output files for the compiler, names, autoprefixer settings etc. The tasks and config file is then pulled into the _gulpfile.js_ file which defined the dependencies, loads modules and prepares the tasks. You can then run each task respectively ...

```sh
gulp images
gulp scripts
gulp styles
gulp watch
```

... or all of them in the same order ...

```sh
gulp
```

### Assets and source files
```
assets
    |-- images
    |-- scripts
        |-- vendor
    |-- stylesheets
sass
    |-- core
    |-- modules
    |-- pages
    |-- vendor
    |-- application.scss
scripts
    |-- app
        |-- app.js
```

All the source files are located inside _sass_ and _scripts_ folder whereas _assets_ contains the gulp processed files and also any images the theme should use. Any vendor files should also go into their respective folders. JS vendor files should go directly into _assets/scripts/vendor_ and any CSS vendor files should go into _sass/vendor_ and also to be imported into the _sass/vendor/_vendor.scss_ file to be compiled with the rest of the files.
