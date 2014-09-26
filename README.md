# Generator Evolved [![Build Status](https://secure.travis-ci.org/wp-evolved/generator-evolved.png?branch=master)](https://travis-ci.org/wp-evolved/generator-evolved)

> A Yeoman generator for [Evolved for WordPress][1] 

## Features

Auto installs (or updates) the Evolved for WordPress and all its dev dependencies to quickly get you up and running.

## Installation

### Node, NPM

The generator and Evolved depend on multiple Node tools for installation. To get started install Node and NPM from [nodejs.org][5].

## [Yeoman][6], [Bower][7], [Grunt][8] and Evolved Generator

You'll need these Node tools installed *globally* to setup and build your project's files

```bash
npm install -g yo bower grunt-cli generator-evolved
```

CD to your project and start the Evolved generator

```bash
$ yo evolved
```

The installer will ask you a series of questions to help customize your installation. Follow the prompts until the installation is complete.

**Installation Notes**

*When running the Evolved generator it may overwrite existing files. This is expected but be sure run `git status` and `git diff` to compare what was updated and keep anything your project needs.*

**When updating an existing project, be sure to read the changelog before running the generator to see what's changed and reply `NO` when asked to overwrite the existing child theme or you may lose all your changes in the child theme**

### Install Dev Dependencies

The Node and Bower dependencies should be automatically installed, but if they fail run:

```
npm install
```

This will install Grunt and all of the Grunt plugins needed for concatonation, minification, image compression, js and sass compilation, and the necessary components for live reload (these are declared in package.json).

```
bower install
```

This will install your theme dependencies like js libraries, [Bourbon][9], and [Neat][10] (these are declared in bower.json).


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
[9]: http://bourbon.io/
[10]: http://neat.bourbon.io/
