'use strict';
var util = require('util');
var path = require('path');
var yeoman = require('yeoman-generator');
var fs = require('fs-extra');
var chalk = require('chalk');


var TestGeneratorGenerator = yeoman.generators.Base.extend({
  init: function () {
    this.pkg = require('../package.json');
    this.prompts = [];
    this.bower = require(path.join(this.env.cwd, 'bower.json'));

    this.on('end', function () {
      this.config.save();
      this.log.info('Running ' + chalk.yellow('bower install') + ' & ' + chalk.yellow('npm install') + ' for you to install the required dependencies. If this fails, try running the command yourself.');
      this.installDependencies({
        bower: true,
        npm: true,
        skipMessage: true,
        callback: function() {
          this.log.ok('All done! Run ' + chalk.yellow('grunt build:dev') + ' and ' + chalk.yellow('grunt watch') + ' to get started!');
        }.bind(this)
      });
    });
  },
  promptForName: function() {
    var existing = function() {
      try {
        return this.bower.name;
      } catch(e) {};
    }.bind(this);

    this.prompts.push({
      required: true,
      type: 'text',
      name: 'projName',
      message: 'Project Name (e.g. MySite)',
      default: function() {
        return existing() || path.basename(this.env.cwd);
      }.bind(this)
    });
  },
  promptForShortName: function() {
    var existing = function() {
      try {
        return this.bower.shortName;
      } catch(e) {};
    }.bind(this);

    this.prompts.push({
      required: true,
      type: 'text',
      name: 'projShortName',
      message: 'Project short name (e.g. ms)',
      default: function() {
        return existing() || path.basename(this.env.cwd).replace(/[^A-Z]/g, '').toLowerCase();
      }.bind(this)
    });
  },
  promptForAuthorName: function() {
    var existing = function() {
      try {
        return this.bower.author.name;
      } catch(e) {};
    }.bind(this);

    this.prompts.push({
      type: 'text',
      name: 'authorName',
      message: 'Author Name (e.g. John Smith)',
      default: function() {
        return existing() || '';
      }.bind(this)
    });
  },
  promptForAuthorURI: function() {
    var existing = function() {
      try {
        return this.bower.author.url
      } catch(e) {};
    }.bind(this);

    this.prompts.push({
      type: 'text',
      name: 'authorURI',
      message: 'Author URI (e.g. www.johnsmith.com)',
      default: function() {
        return existing() || '';
      }.bind(this)
    });
  },
  promptForDescription: function() {
    var existing = function() {
      try {
        return this.bower.description;
      } catch(e) {};
    }.bind(this);

    this.prompts.push({
      type: 'text',
      name: 'projDescription',
      message: 'Project Description',
      default: function() {
        return existing() || '';
      }.bind(this)
    });
  },
  promptForVersion: function() {
    var existing = function() {
      try {
        return this.bower.version;
      } catch(e) {};
    }.bind(this);

    this.prompts.push({
      type: 'text',
      name: 'projVersion',
      message: 'Project version',
      default: function() {
        return existing() || '0.1.0';
      }.bind(this)
    });
  },
  promptForWeb: function() {
    this.prompts.push({
      type: 'text',
      name: 'web',
      message: 'WordPress directory',
      default: 'web'
    });
  },
  promptForChild: function() {

    var existing = function(response) {
      var childLoc = path.join(response.web, 'wp-content/themes/', response.projShortName + '-theme');

      try {
        var style = this.readFileAsString(path.join(childLoc, 'style.css'));

        if (style.length) {
          return true;
        }
      } catch(e) {}
    }.bind(this);

    this.prompts.push({
      when: function(response) {
        return existing(response);
      },
      type: 'confirm',
      name: 'writeChild',
      message: 'Overwrite existing child theme?',
      default: 'no'
    });
  },
  ask: function() {
    var done = this.async();

    // have Yeoman greet the user.
    console.log(this.yeoman);

    this.prompt(this.prompts, function(props) {
      this.props = props;

      done();
    }.bind(this));
  },
  ready: function() {
    this.log.write('\n');
    this.log.info( chalk.green('Here we go!') );
  },
  writeProjectFiles: function() {
    this.log.info('Writing project files...');

    this.copy('Gruntfile.js', 'Gruntfile.js');

    this.template('editorconfig', '.editorconfig');
    this.template('gitignore', '.gitignore');
    this.template('jshintrc', '.jshintrc');
    this.template('bower.json', 'bower.json');
    this.template('package.json', 'package.json');
    //this.template('README.md', 'README.md');
  },
  writeThemeFiles:  function() {
    this.log.info('Writing theme files...');

    var existing = function(location) {
      try {
        var style = this.readFileAsString(path.join(location, 'style.css'));

        if (style.length) {
          return true;
        } else {
          return false;
        }
      } catch(e) {}
    }.bind(this);

    var parLoc = path.join(this.props.web, 'wp-content/themes/genesis-parent-theme');
    var childLoc = path.join(this.props.web, 'wp-content/themes/', this.props.projShortName + '-theme');
    var writeChild = !existing(childLoc) || this.props.writeChild;

    this.directory('themes/genesis-parent-theme', parLoc);

    if (writeChild) {
      this.directory('themes/genesis-child-theme', childLoc);
    }
  },
  cleanUp: function() {
    this.log.info('Cleaning up...');

    var root = path.join(this.props.web, 'wp-content/themes/', this.props.projShortName + '-theme');
    var files = this.expandFiles('**/.gitkeep', {dot: true, cwd: root});

    for (var i = 0; i < files.length; i++) {
      var file = path.join(root, files[i]);

      fs.remove(file, function(err) {
        console.log(file);
        if (err) return this.log.info( chalk.red(err) );
      });
    }
  }
});

module.exports = TestGeneratorGenerator;