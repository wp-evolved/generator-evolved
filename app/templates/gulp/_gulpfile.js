'use strict';

/**
 * Required node plugins
 */
var gulp  = require('gulp');
var glob  = require('glob');
var del   = require('del');
var $     = require('gulp-load-plugins')();


/**
 * Set up prod/dev tasks
 */
var is_prod       = !($.util.env.dev);


/**
 * Set up project variables
 */
var pkg           = require('./package.json');
var _banner       = '/*!' + (pkg.title || pkg.name) + ' - v' + pkg.version + ' - ' + (new Date()).toDateString() + '*/\n';
var _short_name   = pkg.shortName.toLowerCase();


/**
 * Set up file paths
 */
var _bower_dir    = 'bower_components';
var _theme_dir    = '<%= props.themesDir %>';
var _child_dir    = _theme_dir + '/' + _short_name + '-theme';
var _assets_dir   = _child_dir + '/assets';
var _src_dir      = _assets_dir + '/src';
var _dist_dir     = _assets_dir + '/dist';
var _dev_dir      = _assets_dir + '/dev';
var _img_dir      = _assets_dir + '/img';
var _build_dir    = (is_prod) ? _dist_dir : _dev_dir;


/**
 * Colorguard settings
 */
var _clrgrd_opts  = {
  whitelist: [
    ['#fff', '#fefefe']
  ]
};


/**
 * Error notification settings
 */
function errorAlert(err) {
  $.notify.onError({
    message:  '<%%= error.message %>',
    sound:    'Sosumi'
  })(err);
}


/**
 * Clean the dist/dev directories
 */
gulp.task('clean', function() {
  del( _build_dir + '/**/*' );
});


/**
 * Lints the gulpfile for errors
 */
gulp.task('lint:gulpfile', function() {
  gulp.src('gulpfile.js')
    .pipe( $.jshint() )
    .pipe( $.jshint.reporter('default') )
    .on( 'error', errorAlert );
});


/**
 * Lints the source js files for errors
 */
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
    .pipe( $.jshint.reporter('default') )
    .on( 'error', errorAlert );
});


/**
 * Lints all the js files for errors
 */
gulp.task('lint', [
  'lint:gulpfile',
  'lint:src'
]);


/**
 * Concatenates, minifies and renames the source JS files for dist/dev
 */
gulp.task('scripts', function() {
  var matches = glob.sync(_src_dir + '/js/*');

  if (matches.length) {
    matches.forEach( function(match) {
      var dir     = match.split('/js/')[1];
      var scripts = [
        _src_dir + '/js/' + dir + '/libs/**/*.js',
        _src_dir + '/js/' + dir + '/**/*.js'
      ];

      gulp.src(scripts)
        .pipe( $.plumber({ errorHandler: errorAlert }) )
        .pipe( $.concat(dir + '.js') )
        .pipe( is_prod ? $.uglify() : $.util.noop() )
        .pipe( is_prod ? $.header(_banner, { pkg: pkg }) : $.util.noop() )
        .pipe( is_prod ? $.rename(dir + '.min.js') : $.util.noop() )
        .pipe( gulp.dest(_build_dir) )
        .on( 'error', errorAlert )
        .pipe(
          $.notify({
            message:  (is_prod) ? dir + ' scripts have been compiled and minified' : dir + ' dev scripts have been compiled',
            onLast:   true
          })
        );
    });
  }
});


/**
 * Compiles and compresses the source Sass files for dist/dev
 */
gulp.task('styles', function() {
  var _sass_opts = {
    loadPath:     _bower_dir,
    style:        is_prod ? 'compressed' : 'expanded',
    lineNumbers:  !is_prod
  };

  gulp.src(_src_dir + '/scss/style.scss')
    .pipe( $.plumber({ errorHandler: errorAlert }) )
    .pipe( $.rubySass(_sass_opts) )
    .on( 'error', function(err) {
      new $.util.PluginError(
        'CSS',
        err,
        {
          showStack: true
        }
      );
    })
    .pipe( $.colorguard(_clrgrd_opts) )
    .pipe( is_prod ? $.rename({ suffix: '.min' }) : $.util.noop() )
    .pipe( gulp.dest(_build_dir) )
    .on( 'error', errorAlert )
    .pipe(
      $.notify({
        message:  (is_prod) ? 'Styles have been compiled and minified' : 'Dev styles have been compiled',
        onLast:   true
      })
    );
});


/**
 * Minimizes all the images
 */
gulp.task('images', function() {
  var _options = {
    progressive: true,
    svgoPlugins: [{
      removeViewBox: false,
      removeHiddenElems: false
    }]
  };
  gulp.src(_img_dir + '/*')
    .pipe( $.imagemin(_options) )
    .pipe( gulp.dest(_img_dir) )
    .pipe(
      $.notify({
        message:  'Images have been compressed',
        onLast:   true
      })
    );
});


/**
 * Builds for distribution (staging or production)
 */
gulp.task('build', [
  'clean',
  'lint',
  'scripts',
  'styles',
  'images'
]);


/**
 * Builds assets and reloads the page when any php, html, img or dev files change
 */
gulp.task('watch', function() {
  $.livereload.listen();

  gulp.watch(_src_dir + '/scss/**/*', [
    'styles'
  ]);
  gulp.watch(_src_dir + '/js/**/*', [
    'lint:src',
    'scripts'
  ]);
  gulp.watch([
    _child_dir + '/**/*.php',
    _child_dir + '/**/*.html',
    _dev_dir + '/**/*',
    _img_dir + '/*'
  ]).on( 'change', $.livereload.changed );
});


/**
 * Backup default task just triggers a build
 */
gulp.task('default', [ 'build' ]);
