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
          // Compress and combine all scripts, modify as needed
          'assets/js/scripts.min.js': [
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap.js',
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/affix.js',
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/alert.js',
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/button.js',
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/carousel.js',
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/collapse.js',
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/dropdown.js',
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tab.js',
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/transition.js',
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/scrollspy.js',
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/modal.js',
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tooltip.js',
            'assets/components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/popover.js',
            'assets/components/fitvids/jquery.fitvids.js',
            'assets/js/plugins/*.js',
            'assets/js/_*.js'
          ]
        },
        options: {
          // JS source map: to enable, uncomment the lines below and update sourceMappingURL based on your install
          // sourceMap: 'assets/js/scripts.min.js.map',
          // sourceMappingURL: '/app/themes/roots/assets/js/scripts.min.js.map'
        }
      }
    },
    watch: {
      sass: {
        files: [
          'assets/scss/*.scss'
        ],
        tasks: ['sass', 'autoprefixer', 'csso']
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['uglify']
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
    'uglify'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};
