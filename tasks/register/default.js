module.exports = function (grunt) {
  grunt.registerTask('default', [
    'bower',
    'gessoBuild',
    'concurrent'
    // 'simple-watch'
  ]);
};
