# generator-theme [![Build Status](https://secure.travis-ci.org/jimmynotjim/generator-theme.png?branch=master)](https://travis-ci.org/jimmynotjim/generator-theme)

> A Yeoman generator for [Genesis WordPress][1] themeing.
Genesis Theme is a simple pair of parent and child themes for use with Genesis WordPress.

## Features

* Yeoman generator makes installation (or updating) on an existing Genesis project simple.
* Parent theme creates a unified base for all Genesis projects without making too many design decisions.
* Child theme takes control of the project's specific design requirements utilizing Bourbon for Sass utilities and Neat for grid alignments.
* Utilizes Bower for easy dependency management.
* Utilizes Grunt for an integrated CLI workflow with Genesis.


## Installation

### Start your project with Genesis

Follow the Genesis setup instructions to get started.

### Theme Generator and Grunt

Install generator-genesis-theme and Grunt CLI globally (you should already have Node, NPM, Yeoman, Bower and Genesis Wordpress installed from the previous step)

```
$ npm install -g generator-genesis-theme grunt-cli
```

CD to your project and initiate the Gensis Theme generator

```
$ yo genesis-theme
```

It'll ask you a series of questions (many should already be pre-populated from the Genesis setup).

## Getting Started

### Install Dev Dependencies

The NPM and Bower dependencies should be automatically installed, but if they fail run:

```
npm install
```

This will install grunt and all of the grunt plugins needed for concatonation, minification, image compression, js and sass compilation, and the necessary components for live reload (these are declared in package.json).

```
bower install
```

This will install our theme dependencies like js libraries, bourbon, and neat (these are declared in bower.json).

### Install Sass

```
sudo gem install sass
```

This installs the sass gem for sass compilation.

### Get started with Grunt

Grunt isn't any more difficult to set up and use than Genesis. If you're comfortable with Genesis, you should be able to manage working with Grunt.

#### Main Tasks

At it's core Grunt is extremely powerful, but most of the time we're only going to be utilizing it for a few standard tasks.

```
grunt build:dev
```

To start our new project we need to run the `build:dev` task. When running our project locally we want to build and concatonate our assets but not minify them. This task creates a `dev` directory and runs all the tasks required to build the assets.

*Since these unminified files are only used locally, we also want to be sure we don't track these files in Git.*

```
grunt watch
```

After our `dev` directory is created, we can run the `watch` task to set Grunt to automatically build the `dev` assets and reload the browser when necessary with LiveReload.

*After running `watch` refresh the browser once to connect the LiveReload script.*

```
grunt build
```

This task builds our production assets concatonating and minifying all the necessary files. These are the files used in staging and production environments.

#### Available Grunt tasks

Although `watch`, `build`, and `build:dev` should get you through 90% of your workflow there are other tasks (and subtasks) you can run in the current Grunt setup.

```
grunt clean:dev		# Removes all files from the assets/dev dir
grunt clean:dist	# Removes all files from the assets/dist dir
grunt lint			# Lints all js files (including the Gruntfile) for errors
grunt concat		# Concatonates all the separate scripts into header, footer and single source files
grunt uglify		# Minifies the concatonated scripts in the assets/dist dir
grunt sass:dist		# Compiles sass files (in expanded mode) to the assets/dev dir
grunt sass:dev		# Compiles sass files (in compressed mode) to the assets/dist dir
grunt imagemin		# Compresses images from /img/src directory to the /img/min directory
```

#### Further info

For further reading on Bower and Grunt, checkout these posts

* Get Up and Running with Grunt - http://coding.smashingmagazine.com/2013/10/29/get-up-running-grunt/
* Twitter Bower & Grunt - http://gpiot.com/blog/twitter-bower-grunt-get-started-with-assets-management/

### Working with the Parent theme.

The goal of the parent theme is to give a structured base for your projects but not to assume any design decisions. Making decisions in the parent theme can lead to bloat and unnecessary overrides, we want our projects to be lean and fast.

#### Functions

These are functions we find we use across all of our projects. It's not everything, since that could lead to the mentioned overrides, but it includes what we think is necessary.

#### Templates

To keep from repeating ourselves, we aren't using WP templates in the traditional sense. There's no reason to have to open and close every template with the same code, so instead these templates are used with includes in their respective parent pages (index.php, page.php, and single.php).

#### Modules

Modules are small chunks of content used throughout the project. The goal is to reuse our code and abstract out small differences.

#### Styling

Trick heading, there is none. There is a `style.css` file but it's only for recognizing the parent theme.

### Working with the Child theme

The goal of the child theme is to setup the project specific elements. This is where we'll include the design specific decisions (and utilize Grunt). Feel free to edit, add and remove as necessary.

#### Functions

These are project specific functions, global variables, separate out the development and distribution assets, and require any outside functions.


### Styling

#### Bourbon and Neat

#### Base, Generic and Objects

#### Modules and Layout


### Scripting

### Images

## License

[MIT License](http://en.wikipedia.org/wiki/MIT_License)

[1]: https://github.com/genesis/wordpress/
[2]: http://yeoman.io/
[3]: http://nodejs.org/
[4]: http://bower.io/
[5]: https://help.github.com/articles/create-a-repo
