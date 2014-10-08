'use strict';
var gulp  = require('gulp');
var glob  = require('glob');
var del   = require('del');
var $     = require('gulp-load-plugins')();
var pkg   = require('./package.json');

var _short_name   = '<%%= pkg.shortName.toLowerCase() %>',
var _bower_dir    = 'bower_components';
var _theme_dir    = '<%= props.themesDir %>';
var _child_dir    = _theme_dir + '/' + _short_name;
var _assets_dir   = _child_dir + '/assets';
var _src_dir      = _assets_dir + '/src';
var _dist_dir     = _assets_dir + '/dist';
var _dev_dir      = _assets_dir + '/dev';
var _img_dir      = _assets_dir + '/img';
var _banner       = '/*! <%%= pkg.title || pkg.name %> - v<%%= pkg.version %> - <%%= (new Date).toDateString() %> */\n';
var _clrgrd_opts  = {
  whitelist: [
    ['#fff', '#fefefe']
  ]
};

// Cleans the dist directory
gulp.task('clean:dist', function() {
  del(_dist_dir + '/**.*');
});


// Cleans the dev directory
gulp.task('clean:dev', function() {
  del(_dev_dir + '/**.*');
});


// Lints the gulpfile for errors
gulp.task('lint:gulpfile', function() {
  gulp.src('gulpfile.js')
    .pipe( $.jshint() )
    .pipe( $.jshint.reporter('default') );
});


// Lints the source js files for errors
gulp.task('lint:src', function() {
  var _src = [
    _src_dir + '/js/**/*.js',
    '!**/libs/**/*.js'
  ];
  var _options = {
    lookup: _src_dir + '/.jshintrc'
  };

  gulp.src(_src)
    .pipe( $.jshint(_options) )
    .pipe( $.jshint.reporter('default') );
});


// Concatonates, minifies and renames the source JS files for Dist
gulp.task('scripts:dist', function() {
  glob.sync(_src_dir + '/js/*', function(err, matches) {
    if (err) { throw err; }

    if (matches.length) {
      matches.forEach(function(match) {
        var dir = match.split('/js/')[1];
        var scripts = [
          _src_dir + '/js/' + dir + '/libs/**/*.js',
          _src_dir + '/js/' + dir + '/**/*.js'
        ];

        gulp.src(scripts)
          .pipe( $.plumber() )
          .pipe( $.concat(dir + '.js') )
          .pipe( $.uglify() )
          .pipe( $.header(_banner, {pkg : pkg}) )
          .pipe( $.rename(dir + '.min.js') )
          .pipe( gulp.dest(_dist_dir) );
      });
    }
  });
});


// Concatonates the source JS files for Dev
gulp.task('scripts:dev', function() {
  glob.sync(_src_dir + '/js/*', function(err, matches) {
    if (err) { throw err; }

    if (matches.length) {
      matches.forEach(function(match) {
        var dir = match.split('/js/')[1];
        var scripts = [
          _src_dir + '/js/' + dir + '/libs/**/*.js',
          _src_dir + '/js/' + dir + '/**/*.js'
        ];

        gulp.src(scripts)
          .pipe( $.plumber() )
          .pipe( $.concat(dir + '.js') )
          .pipe( gulp.dest(_dev_dir) );
      });
    }
  });
});


// Compiles and compresses the source Sass files for Dist
gulp.task('styles:dist', function() {
  var _sass_opts = {
    loadPath:     _bower_dir,
    style:        'compressed',
    lineNumbers:  false
  };

  gulp.src(_src_dir + '/scss/style.scss')
    .pipe( $.plumber() )
    .pipe( $.rubySass(_sass_opts) )
    .pipe( $.colorguard(_clrgrd_opts) )
    .pipe( $.rename('style.min.css') )
    .pipe( gulp.dest(_dist_dir) );
});


// Compiles the source Sass files for Dev
gulp.task('styles:dev', function() {
  var _sass_opts = {
    loadPath:     _bower_dir,
    style:        'expanded',
    lineNumbers:  true
  };

  gulp.src(_src_dir + '/scss/style.scss')
    .pipe( $.plumber() )
    .pipe( $.rubySass(_sass_opts) )
    .pipe( $.colorguard(_clrgrd_opts) )
    .pipe( gulp.dest(_dev_dir) );
});


// Minimizes all the images
gulp.task('images', function() {
  var _options = {
    progressive: true
  };
  gulp.src(_img_dir + '/*')
    .pipe( $.imagemin(_options) )
    .pipe( gulp.dest(_img_dir) );
});


// Lints all the js files for errors
gulp.task('lint', [
  'lint:gulpfile',
  'lint:src'
]);


// Builds for distribution (staging or production)
gulp.task('build', [
  'clean:dist',
  'lint',
  'scripts:dist',
  'styles:dist',
  'images'
]);


// Builds for development (local)
gulp.task('build:dev', [
  'lint:src',
  'scripts:dev',
  'styles:dev',
]);


// Builds assets and reloads the page when any php, html, img or dev files change
gulp.task('watch', function() {
  $.livereload.listen();

  gulp.watch(_src_dir + '/scss/**/*', ['sass:dev']);
  gulp.watch(_src_dir + '/js/**/*', [
    'lint:src',
    'scripts:dev'
  ]);

  gulp.watch([
    _child_dir + '/**/*.php',
    _child_dir + '/**/*.html',
    _dev_dir + '/**/*',
    _img_dir + '/*'
  ]).on('change', $.livereload.changed);
});


// Backup default task just triggers a build
gulp.task('default', ['build']);
