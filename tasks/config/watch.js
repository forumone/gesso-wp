module.exports = function (grunt) {
  grunt.config.merge({
    watch: {
      gesso: {
        files : [ '<%= pkg.themePath %>/sass/**/*.scss' ],
        tasks : [ 'gessoBuildStyles' ],
        options: {
          livereload: true
        }
      },
      patternlab: {
        files: ['public/wp-content/themes/gesso/pattern-lab/source/**/*'],
        tasks: ['shell:patternlab'],
        options: {
          livereload: true
        }
      },
      svgs: {
        files : [ '<%= pkg.themePath %>/images/bg/*.svg' ],
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
