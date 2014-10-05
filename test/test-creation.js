/*global describe, beforeEach, it */
'use strict';

var path = require('path');
var helpers = require('yeoman-generator').test;

describe('evolved generator', function () {
  beforeEach(function (done) {
    helpers.testDirectory(path.join(__dirname, 'temp'), function (err) {
      if (err) {
        return done(err);
      }

      this.app = helpers.createGenerator('evolved:app', [
        '../../app'
      ]);
      done();
    }.bind(this));
  });

  it('the generator can be required without throwing', function() {
    this.app = require('../app');
  });

  it('creates expected files', function (done) {
    var expected = [
      // add files you expect to exist here.
      'bower.json',
      'package.json',
      '.editorconfig',
      '.gitignore',
      '.jshintrc',
      'Gruntfile.js',
      'web/wp-content/themes/evolved-parent-theme',
      'web/wp-content/themes/tscom-theme'
    ];

    helpers.mockPrompt(this.app, {
      'projName':         'Temp-Site.com',
      'projShortName':    'tscom',
      'authorName':       'Test Author',
      'authorURI':        'test-author.com',
      'themesDir':        'web/wp-content/themes',
      'projDescription':  'test site just for testing',
      'projVersion':      '0.1.1'
    });

    this.app.options['skip-install'] = true;

    this.app.run({}, function () {
      helpers.assertFile(expected);
      done();
    });
  });
});
