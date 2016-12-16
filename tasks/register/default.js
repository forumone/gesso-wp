module.exports = function (grunt) {
  grunt.registerTask('default', [
    'bower',
    'gessoBuild',
    'browserSync',
    'simple-watch'
  ]);
};
