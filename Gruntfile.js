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
            'assets/components/bootstrap-sass/vendor/assets/javascripts/bootstrap.js',
            'assets/components/fitvids/jquery.fitvids.js',
            'assets/js/plugins/*.js',
            'assets/js/_*.js'
          ]
        }
      }
    },
    watch: {
      sass: {
        files: [
          'assets/scss/*.scss'
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
