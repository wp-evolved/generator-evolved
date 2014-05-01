# generator-genesis-evolution [![Build Status](https://secure.travis-ci.org/jimmynotjim/generator-genesis-evolution.png?branch=master)](https://travis-ci.org/jimmynotjim/generator-genesis-evolution)

> A Yeoman generator for [Genesis Skeleton - WordPress][1] themeing.
Genesis Skeleton - Evolution is a simple pair of parent and child themes for use with Genesis Skeleton - WordPress.

## Features

* Yeoman generator makes installation (or updating) on an existing Genesis Skeleton project simple.
* Parent theme creates a unified base for all Genesis Skeleton projects without making too many design decisions.
* Child theme takes control of the project's specific design requirements utilizing Bourbon for Sass utilities and Neat for grid alignments.
* Utilizes Bower for easy dependency management.
* Utilizes Grunt for an integrated CLI workflow with Genesis Skeleton.


## Installation

### Start your project with Genesis Skeleton

Follow the [Genesis Skeleton - WordPress setup instructions](https://github.com/genesis/wordpress#genesis-wordpress) to get started.

### Theme Generator and Grunt

Install generator-genesis-evolution and Grunt CLI globally (you should already have Node, NPM, Yeoman, Bower and Genesis Skeleton - WordPress installed from the previous step)

```
$ npm install -g generator-genesis-evolution grunt-cli
```

CD to your project and initiate the Gensis Evolution generator

```
$ yo genesis-evolution
```

It'll ask you a series of questions (many should already be pre-populated from the Genesis Skeleton setup).

#### Install Notes

When running the Evolution generator for the first time, it will overwrite the following files created by the Genesis Skeleton and warn you. This is expected.

* .gitignore
* bower.json

If you run the generator a second time (to keep up to date for instance) it will make updates to any of the included files that have been updated since the generator was last run. This is also expected, but **be sure to read the changelog before updating and to reply `NO` when asked to overwrite the child theme**. If you have any concerns or questions after the generator has finished, view your git diff.

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

Grunt isn't any more difficult to set up and use than Genesis Skeleton. If you're comfortable with Genesis Skeleton, you should be able to manage working with Grunt.

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

## Working with the Parent theme.

The goal of the parent theme is to give a structured base for your projects but not to assume any design decisions. Making decisions in the parent theme can lead to bloat and unnecessary overrides, we want our projects to be lean and fast.

### Functions

These are functions we find we use across all of our projects. It's not everything, since that could lead to the mentioned overrides, but it includes what we think is necessary.

### Templates

To keep from repeating ourselves, we aren't using WP templates in the traditional sense. There's no reason to have to open and close every template with the same code, so instead these templates are used with includes in their respective parent pages (index.php, page.php, and single.php).

### Modules

Modules are small chunks of content used throughout the project. The goal is to reuse our code and abstract out small differences.

### Styling

Trick heading, there is none. There is a `style.css` file but it's only for recognizing the parent theme.

## Working with the Child theme

The goal of the child theme is to setup the project specific elements. This is where we'll include the design specific decisions (and utilize Grunt). Feel free to edit, add and remove as necessary.

### Functions

This is where we set up project specific functions and global variables; enqueue the development and distribution assets; and require any outside functions.

### Templates & Modules

Same as the templates and modules in the parent theme, this is where you want to add any new templates or modules you need for your project.

### Styling

#### Bourbon and Neat

We use Bourbon/Neat for special functions, css3 mixins, and our grid. Bourbon has many awesome functions and mixins not in the Sass core that make working with scss even easier (such as tint/darken, px to em, modular scale, retina images, etc). Neat makes setting up and using a grid a breaze, especially when using the included media mixin. Instead of filling your markup with grid hooks, all of your grid layouts reside in your existing hooks where it belongs.

#### Base, Generic and Objects

Based on InuitCSS, this is were the styling for our resets, base styles, abstractions and custom objects we take from project to project reside. Feel free to include whatever you do or don't need in the style.scss to keep your final size down.

#### Modules and Layout

Rather than mix the custom styles with those we carry from project to project, we break them up into visual styles in the modules directory and layout styles in the layout directory. We often break up the layout files based on the modules we're using, but we still want to keep visual and layout styles separate to make finding and adjusting them easier.

### Scripting

To reduce http requests we limit our scripts to where they are needed and concatonate those that are used on the same pages. First we group them in directories based on where they will be called (header, footer, single posts, etc), then we break up and group the functions into single files based on their use (inits for libraries/plugins, custom page controls, etc). Grunt automatically goes through the directories and creates a corresponding file in dev/dist directories. We then enqueue those in functions.php.

### Images

Due to the nature of images, we can't easily replace those that are uncompressed with those that are. Images should be placed in `assets/img/src` and you should link to the compressed images located in `assets/img/min` for all environments. We've found that the imagemin grunt plugin will continue to compress the images if you outright replace the original, so we've decided to separate the two to avoid any artifacting issues.

## Version

This generator is currently considered unstable. Things will be moving while it gets sorted out. Be sure to read [the changelog] before updating.

## License

[MIT License](http://en.wikipedia.org/wiki/MIT_License)

[1]: https://github.com/genesis/wordpress/
[2]: http://yeoman.io/
[3]: http://nodejs.org/
[4]: http://bower.io/
[5]: https://help.github.com/articles/create-a-repo
[6]: https://github.com/jimmynotjim/generator-genesis-evolution/blob/master/CHANGELOG.md
