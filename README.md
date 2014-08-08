# generator-genesis-evolution [![Build Status](https://secure.travis-ci.org/jimmynotjim/generator-genesis-evolution.png?branch=master)](https://travis-ci.org/jimmynotjim/generator-genesis-evolution)

> A Yeoman generator for modern WordPress theme development.
Genesis Skeleton - Evolution is a simple pair of parent and child themes to help you start and manage your theme development process.


## Features

* [Yeoman][2] generator makes installation (or updating) the theme, dev utilities and task files simple.
* Parent theme creates a unified base for all projects without making too many design decisions.
* Child theme takes control of the project's specific design requirements utilizing [Bourbon][8] for Sass utilities, [Neat][9] for grid alignments and borrows from [Inuit CSS][10] for a solid base.
* Utilizes [Bower][4] for easy dependency management.
* Utilizes [Grunt][7] for an integrated CLI workflow.


## Installation

### Start your project

`cd` to your project root

*The generator was originally created to work with [Genesis Skeleton - WordPress][1], but is no longer dependent on it. That said, Genesis Skeleton is a great tool to get your WordPress environments set up and automated. If you choose to use it, follow those [instructions](https://github.com/genesis/wordpress#genesis-wordpress) before running the Evolution generator.*

### Node, NPM, Yeoman and Bower

The theme generator depends on these tools for installation. To get started install Node and NPM from [nodejs.com](http://nodejs.org/). Then install Yeoman and Bower globally

```
npm install -g yo bower
```

*If using Genesis Skeleton - WP this should already be completed*

### Theme Generator and Grunt

Install generator-genesis-evolution and Grunt CLI globally

```
$ npm install -g generator-genesis-evolution grunt-cli
```

**Note - v0.2.0 or later of the generator requires Sass 3.3 or later. Run `npm install -g generator-genesis-evolution@~0.1.*` if you're not up to date with Sass**

CD to your project and initiate the Gensis Evolution generator

```
$ yo genesis-evolution
```

It'll ask you a series of questions to help you with installation.

#### Install Notes

When running the theme generator, it may overwrite existing files that already exist. This is expected but be sure to use a diff tool to compare what was updated and keep what you need.

**Be sure to read the changelog before running the generator on a project that's been previously generated and reply `NO` when asked to overwrite the child theme or you will lose all your child theme changes**


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

Grunt is is a great automated build tool and we've set it up so that you can concentrate on building your theme instead of optimizing how it's delivered. 

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
grunt colorguard    # Compares your css files for colors that are too-similar and conflict with each other
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

Trick heading, there is none. There is a `style.css` file but it's only for recognizing the parent theme. All styling should be done in the child theme to avoid duplicate http requests and cascade issues.


## Working with the Child theme

The goal of the child theme is to setup project specific elements. This is where we'll include the design specific decisions (and utilize Grunt). Feel free to edit, add and remove as necessary.

### Functions

This is where we set up project specific functions and global variables; enqueue the development and distribution assets; and require any outside functions.

### Templates & Modules

Same as the templates and modules in the parent theme, this is where you want to add any new templates or modules you need for your project. For example, if you want to customize single posts, create a `single.php` file in the child theme and it will override the parent.

### Styling

#### Bourbon and Neat

We use Bourbon/Neat for special functions, css3 mixins, and our grid. Bourbon has many awesome functions and mixins not included in the Sass core that make working with scss even easier (such as tint/darken, px to em, modular scale, retina images, etc). Neat makes setting up and using a grid a breaze, especially when using the included media mixin. Instead of filling your markup with grid hooks, all of your grid layouts reside in your layout styles where it belongs.

#### Base, Generic and Objects

Based on Inuit CSS, this is where the styling for our resets, base styles, abstractions and custom objects we take from project to project reside. Feel free to include whatever you do or don't need in the style.scss to keep your final size down.

#### Modules and Layout

Rather than mix the custom styles with those we carry from project to project, we break them up into visual styles in the modules directory and layout styles in the layout directory. We often break up the layout files based on the modules we're using, but we still want to keep visual and layout styles separate to make finding and adjusting them easier.

### Scripting

To reduce http requests we limit our scripts to where they are needed and concatonate those that are used on the same pages. First we group them in directories based on where they will be called (header, footer, single posts, etc), then we break up and group the functions into single files based on their use (inits for libraries/plugins, custom page controls, etc). Grunt automatically goes through the directories and creates a corresponding file in dev/dist directories. We then enqueue those in functions.php.

### Images

The Imagemin Grunt task will automatically compress your images during the build process. Just drop in what you need in whatever folder structure you like and link to them as you normally would. No extra work needed.


## Version

This generator is currently considered unstable. Things will be moving while it gets sorted out. Be sure to read [the changelog][6] before updating.


## License

[MIT License](http://en.wikipedia.org/wiki/MIT_License)

[1]: https://github.com/genesis/wordpress/
[2]: http://yeoman.io/
[3]: http://nodejs.org/
[4]: http://bower.io/
[5]: https://help.github.com/articles/create-a-repo
[6]: https://github.com/jimmynotjim/generator-genesis-evolution/blob/master/CHANGELOG.md
[7]: http://gruntjs.com/
[8]: http://bourbon.io/
[9]: http://neat.bourbon.io/
[10]: https://github.com/csswizardry/inuit.css/
