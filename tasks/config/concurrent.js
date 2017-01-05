module.exports = function (grunt) {
  grunt.config.merge({
    concurrent: {
      target: ['connect', 'watch'],
      options: {
          logConcurrentOutput: true
      }
    }
  });

  grunt.loadNpmTasks('grunt-concurrent');
};
