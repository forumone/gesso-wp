module.exports = function (grunt) {
  grunt.config.merge({
    watch: {
      gesso: {
        files : [ 'sass/**/*.scss'],
        tasks : [ 'gessoBuildStyles' ],
        options: {
          livereload: true
        }
      },
      php: {
        files : [ './**/*.{twig,php}' ],
        options: {
          livereload: true
        }
      },
      patternlab: {
        files: ['pattern-lab/source/**/*'],
        tasks: ['shell:patternlab'],
        options: {
          livereload: true
        }
      },
      svgs: {
        files : [ 'images/bg/*.svg' ],
        tasks : [ 'gessoBuildImages','gessoBuildStyles' ],
        options: {
          livereload: true
        }
      },
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-simple-watch');
}
