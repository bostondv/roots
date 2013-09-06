'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'assets/js/*.js',
        'assets/js/plugins/*.js',
        '!assets/js/scripts.min.js'
      ]
    },
    sass: {
      dist: {
        files: {
          'assets/css/main.css': 'assets/scss/main.scss'
        }
      }
    },
    autoprefixer: {
      dist: {
        src: 'assets/css/main.css',
        dest: 'assets/css/main.css'
      },
    },
    csso: {
      dist: {
        files: {
          'assets/css/main.min.css': ['assets/css/main.css']
        }
      }
    },
    uglify: {
      dist: {
        files: {
          'assets/js/scripts.min.js': [
            'bower_components/sass-bootstrap/js/transition.js',
            'bower_components/sass-bootstrap/js/alert.js',
            'bower_components/sass-bootstrap/js/button.js',
            'bower_components/sass-bootstrap/js/carousel.js',
            'bower_components/sass-bootstrap/js/collapse.js',
            'bower_components/sass-bootstrap/js/dropdown.js',
            'bower_components/sass-bootstrap/js/modal.js',
            'bower_components/sass-bootstrap/js/tooltip.js',
            'bower_components/sass-bootstrap/js/popover.js',
            'bower_components/sass-bootstrap/js/scrollspy.js',
            'bower_components/sass-bootstrap/js/tab.js',
            'bower_components/sass-bootstrap/js/affix.js',
            'bower_components/fitvids/jquery.fitvids.js',
            'assets/js/plugins/*.js',
            'assets/js/_*.js'
          ]
        }
      }
    },
    watch: {
      sass: {
        files: [
          'assets/scss/*.scss',
          'assets/scss/partials/*.scss',
          'bower_components/sass-bootstrap/lib/*.scss'
        ],
        tasks: ['sass', 'autoprefixer', 'csso', 'version']
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['uglify', 'version']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: true
        },
        files: [
          'assets/css/main.min.css',
          'assets/js/scripts.min.js',
          'templates/*.php',
          '*.php'
        ]
      }
    },
    clean: {
      dist: [
        'assets/css/main.min.css',
        'assets/js/scripts.min.js'
      ]
    }
  });

  // Load tasks
  grunt.loadTasks('tasks');
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-csso');

  // Register tasks
  grunt.registerTask('default', [
    'clean',
    'sass',
    'autoprefixer',
    'csso',
    'uglify',
    'version'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};
