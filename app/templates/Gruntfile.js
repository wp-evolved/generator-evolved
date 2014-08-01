'use strict';
module.exports = function(grunt) {

  // Load Grunt tasks declared in the package.json file
  require('load-grunt-tasks')(grunt);

  // Project configuration.
  grunt.initConfig({

    // Save the package.json data for variable usage
    pkg:    grunt.file.readJSON('package.json'),

    // Set up the banner from the package.json data
    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %> */\n',

    // Constants
    NAME:       '<%= pkg.name %>',
    SHORT_NAME: '<%= pkg.shortName.toLowerCase() %>',
    BOWER_DIR:  'bower_components',
    PARENT_DIR: 'web/wp-content/themes/evolution-parent-theme',
    CHILD_DIR:  'web/wp-content/themes/<%= SHORT_NAME %>-theme',
    ASSETS_DIR: '<%= CHILD_DIR %>/assets',
    DIST_DIR:   '<%= ASSETS_DIR %>/dist',
    DEV_DIR:    '<%= ASSETS_DIR %>/dev',
    SRC_DIR:    '<%= ASSETS_DIR %>/src',
    IMG_DIR:    '<%= ASSETS_DIR %>/img',
    IMG_FILES:  '**/*.{png,gif,jpg,jpeg}',

    // Task configuration

    // Cleans the appropriate directory to prepare for compiled source files
    clean: {
      dev: {
        src: '<%= DEV_DIR %>/*'
      },
      dist: {
        src: '<%= DIST_DIR %>/*'
      }
    },

    // Concatonates the source JS files to header, footer and single files
    concat: {
      options: {
        banner:       '<%= banner %>',
        stripBanners: true
      },
      header: {
        src: [
          '<%= SRC_DIR %>/js/header/libs/**/*.js',
          '<%= SRC_DIR %>/js/header/**/*.js'
        ],
        dest: '<%= DEV_DIR %>/header.js'
      },
      footer: {
        src: [
          '<%= SRC_DIR %>/js/footer/libs/**/*.js',
          '<%= SRC_DIR %>/js/footer/**/*.js'
        ],
        dest: '<%= DEV_DIR %>/footer.js'
      },
      single: {
        src: [
          '<%= SRC_DIR %>/js/single/libs/**/*.js',
          '<%= SRC_DIR %>/js/single/**/*.js'
        ],
        dest: '<%= DEV_DIR %>/single.js'
      }
    },

    // Minifies the concatonated js files from the /dev dir to the /dist dir
    uglify: {
      all: {
        options: {
          banner: '<%= banner %>'
        },
        files: [{
          expand: true,
          cwd: '<%= DEV_DIR %>/',
          src: '**/*.js',
          dest: '<%= DIST_DIR %>/',
          ext: '.min.js'
        }]
      }
    },

    // Lints all the js files for errors
    jshint: {
      gruntfile: {
        options: {
          jshintrc: '.jshintrc'
        },
        src: 'Gruntfile.js'
      },
      src: {
        options: {
          jshintrc: '<%= SRC_DIR %>/.jshintrc'
        },
        src: [
          '<%= SRC_DIR %>/js/**/*.js',
          '!<%= SRC_DIR %>/js/**/libs/**/*.js'
        ]
      }
    },

    // Compiles the sass from the source dir
    sass: {
      dist: {
        options: {
          style: 'compressed',
          force: true
        },
        src:  '<%= SRC_DIR %>/scss/style.scss',
        dest: '<%= DIST_DIR %>/style.min.css'
      },
      dev : {
        options: {
          style:        'expanded',
          lineNumbers:  true
        },
        src:  '<%= SRC_DIR %>/scss/style.scss',
        dest: '<%= DEV_DIR %>/style.css'
      }
    },

    // Minimizes all the images to the /min directory
    imagemin: {
      all: {
        options: {},
        files: [{
          expand: true,
          cwd: '<%= IMG_DIR %>/src/',
          src: '<%= IMG_FILES %>',
          dest: '<%= IMG_DIR %>/min/'
        }]
      }
    },

    // Scan CSS colors with Colorguard
    colorguard: {
      options: {},
      files: {
        src: ['<%= DEV_DIR %>/style.css']
      }
    },

    // Sets up grunt to watch for file changes and fire the appropriate task
    watch: {
      sass: {
        files: '<%= SRC_DIR %>/scss/**/*.scss',
        tasks: 'sass:dev'
      },
      js: {
        files: '<%= SRC_DIR %>/js/**/*.js',
        tasks: [
          'jshint:src',
          'concat:header',
          'concat:footer',
          'concat:single'
        ]
      },
      img: {
        files: '<%= IMG_DIR %>/<%= IMG_FILES %>',
        tasks: [
          'imagemin:all'
        ]
      },
      livereload: {
        options: {
          livereload: true
        },
        files: [
          '<%= CHILD_DIR %>/**'
        ]
      }
    }
  });

  // Default task.
  grunt.registerTask('default', [
    'jshint',
    'concat',
    'uglify'
  ]);

  // easier to remember than jshint
  grunt.registerTask('lint', [
    'jshint'
  ]);

  // Build for distribution (staging or production)
  grunt.registerTask('build', [
    'clean:dist',
    'jshint',
    'concat:header',
    'concat:footer',
    'concat:single',
    'uglify:all',
    'sass:dist',
    'imagemin:all',
    'colorguard'
  ]);

  // Build for local dev
  grunt.registerTask('build:dev', [
    'jshint:src',
    'concat:header',
    'concat:footer',
    'concat:single',
    'sass:dev',
    'imagemin:all',
    'colorguard'
  ]);
};
