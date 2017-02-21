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
        files: ['pattern-lab/source/**/*'], // IMPORTANT, You cannot use a package.json variable in this area. Must be configured to direct path to patternlab instance. Otherwise, new PL patterns will not load without restarting grunt.
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
