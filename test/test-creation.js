/*global describe, beforeEach, it*/
'use strict';

var path    = require('path');
var helpers = require('yeoman-generator').test;


describe('theme generator', function () {
    beforeEach(function (done) {
        helpers.testDirectory(path.join(__dirname, 'temp'), function (err) {
            if (err) {
                return done(err);
            }

            this.app = helpers.createGenerator('genesis-evolution:app', [
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
            ['bower.json', /"name": "temp-site"/],
            ['package.json', /"name": "temp-site"/],
            '.jshintrc',
            '.editorconfig',
            'Gruntfile.js',
            'web/wp-content/themes/evolution-parent-theme',
            'web/wp-content/themes/ts-theme'
        ];

        helpers.mockPrompt(this.app, {
            'projName': 'temp-site',
            'projShortName': 'ts',
            'authorName': 'Test Author',
            'authorURI': 'test-author.com',
            'web': 'web',
            'projDescription': 'test site just for testing',
            'projVersion': '0.1.1'
        });

        this.app.options['skip-install'] = true;

        this.app.run({}, function () {
            helpers.assertFiles(expected);
            done();
        });
    });

});
