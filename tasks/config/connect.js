// Connect:
// Run http server to serve files
// https://github.com/gruntjs/grunt-contrib-connect

module.exports = function (grunt) {
  grunt.config.merge({
    connect: {
      server: {
        options: {
          base:
            [
            '<%= pkg.themePath %>/pattern-lab/public',
            '<%= pkg.themePath %>/pattern-lab',
            '<%= pkg.themePath %>/css',
            '<%= pkg.themePath %>/images',
            '<%= pkg.themePath %>/js',
            '<%= pkg.themePath %>/bower_components',
            '<%= pkg.themePath %>/'
            ]
          ,
          hostname: '127.0.0.1',
          keepalive: true,
          livereload: true, // needed for live reload setting in Watch tasks
          open: true, // open in a new tab when started
          port: 3333,
          // debug: true
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-connect');
}
