'use strict';
var util = require('util');
var path = require('path');
var yeoman = require('yeoman-generator');
//var chalk = require('chalk');


var ThemeGenerator = module.exports = function ThemeGenerator(args, options, config) {
  yeoman.generators.Base.apply(this, arguments);

  this.pkg = JSON.parse(this.readFileAsString(path.join(__dirname, '../package.json')));
  this.prompts = [];
  this.bower = JSON.parse(this.readFileAsString(path.join(this.env.cwd, 'bower.json')));

  this.on('end', function () {
    this.installDependencies({
      bower: true,
      npm: true,
      skipInstall: options['skip-install'],
      skipMessage: true
    });
  });

  this.sourceRoot(path.join(__dirname, 'templates'));
};

util.inherits(ThemeGenerator, yeoman.generators.Base);

ThemeGenerator.prototype.promptForName = function() {
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
};

ThemeGenerator.prototype.promptForShortName = function() {
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
};

ThemeGenerator.prototype.promptForAuthorName = function() {
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
};

ThemeGenerator.prototype.promptForAuthorURI = function() {
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
};

ThemeGenerator.prototype.promptForDescription = function() {
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
};

ThemeGenerator.prototype.promptForVersion = function() {
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
};

ThemeGenerator.prototype.promptForWeb = function() {
  this.prompts.push({
    type: 'text',
    name: 'web',
    message: 'WordPress directory',
    default: 'web'
  });
};

ThemeGenerator.prototype.ask = function() {
  var done = this.async();

  // have Yeoman greet the user.
  console.log(this.yeoman);

  this.prompt(this.prompts, function(props) {
    this.props = props;

    done();
  }.bind(this));

};

ThemeGenerator.prototype.ready = function() {
  this.log.write('\n');
  this.log.info('Here we go!');
};

ThemeGenerator.prototype.writeProjectFiles = function() {
  this.log.info('Writing project files...');

  this.copy('Gruntfile.js', 'Gruntfile.js');

  this.template('editorconfig', '.editorconfig');
  this.template('jshintrc', '.jshintrc');
  this.template('bower.json', 'bower.json');
  this.template('package.json', 'package.json');
  //this.template('README.md', 'README.md');
};

ThemeGenerator.prototype.writeThemeFiles = function() {
  this.log.info('Writing theme files...');

  this.directory('themes/genesis-parent-theme', path.join(this.props.web, 'wp-content/themes/genesis-parent-theme'));
  this.directory('themes/genesis-child-theme', path.join(this.props.web, 'wp-content/themes/', this.props.projShortName + '-theme'));
};

module.exports = ThemeGenerator;
