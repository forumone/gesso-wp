module.exports = function (grunt) {
  grunt.registerTask('default', [
    'gessoBuild',
    'concurrent'
    // 'simple-watch'
  ]);
};
