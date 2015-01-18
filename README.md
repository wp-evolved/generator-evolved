# Generator Evolved [![Build Status](https://secure.travis-ci.org/wp-evolved/generator-evolved.png?branch=master)](https://travis-ci.org/wp-evolved/generator-evolved)

> A Yeoman generator for [Evolved for WordPress][1] 

## Features

Auto installs (or updates) the Evolved for WordPress and all its dev dependencies to quickly get you up and running.

## Installation

### Node, NPM

The generator and Evolved depend on multiple Node tools for installation. To get started install Node and NPM from [nodejs.org][5].

## [Yeoman][6] and [Bower][7]

You'll need these Node tools installed *globally* to setup and build your project's files

```bash
npm install -g yo bower
```

## [Grunt][8] or [Gulp][9]

Evolved was originally built to utilize Grunt as it's build tool. Since that time, Gulp has become better supported. We prefer Gulp for it's ability to process tasks without writing files to disk, but we will continue to support both as long as interest remains.

```bash
npm install -g grunt-cli
```

**or **

```bash
npm install -g gulp
```


## Evolved Generator

```bash
npm install -g generator-evolved
```

CD to your project and start the Evolved generator

```bash
$ yo evolved
```

The installer will ask you a series of questions to help customize your installation. Follow the prompts until the installation is complete.

**Installation Notes**

*When running the Evolved generator it may overwrite existing files. This is expected but be sure run `git status` and `git diff` to compare what was updated and keep anything your project needs.*

**When updating an existing project, be sure to read the changelog before running the generator to see what's changed and reply `NO` when asked to overwrite the existing child theme or you may lose all your changes in the child theme**


### Options

By default the Evolved generator will install the latest release of the Evolved Theme. If you are looking for an older version, a specific branch or even a commit, you can pass those as an argument prefixed with `@`.

```bash
$ yo evolved @fix-display-thumbnails // Installs the themes from the fix-display-thumbnails branch
$ yo evolved @v1.0.0 // Installs the themes from version 1.0.0
$ yo evolved @157389b // Installs the themes from commit 157389b
```


### Install Dev Dependencies

The Node and Bower dependencies should be automatically installed, but if they fail run:

```
npm install
```

This will install your build tool and all of it's plugins needed for concatonation, minification, image compression, js and sass compilation, and the necessary components for live reload (these are declared in package.json).

```
bower install
```

This will install your theme dependencies like js libraries, [Bourbon][10], and [Neat][11] (these are declared in bower.json).


### Install Sass

If you don't have Sass installed on your machine you'll need to install that next

```
sudo gem install sass
```


## Getting Started

That's it for the generator. Read Evolved's [documentation][2] to get started building your project.


## Version

This project is stable but continuously under development. Be sure to read [the changelog][3] before updating.


## License

[MIT License][4]


[1]: https://github.com/wp-evolved/evolved-theme
[2]: https://github.com/wp-evolved/evolved-theme/blob/master/README.md
[3]: https://github.com/wp-evolved/generator-evolved/blob/master/CHANGELOG.md
[4]: http://en.wikipedia.org/wiki/MIT_License
[5]: http://nodejs.org/
[6]: http://yeoman.io/
[7]: http://bower.io/
[8]: http://gruntjs.com/
[9]: http://gulpjs.com/
[10]: http://bourbon.io/
[11]: http://neat.bourbon.io/
