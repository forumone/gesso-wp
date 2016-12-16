module.exports = function(grunt) {
    var paths = {
        localDev: "http://wpsandbox:8888", // Set this to your site's localhost
        js: ['<%= pkg.themePath %>/js/**/*.js'],
        html: ['<%= pkg.themePath %>/**/*.{html,php,twig}', '<%= pkg.themePath %>/pattern-lab/source/**/*.{twig,json}'],
        images: ['<%= pkg.themePath %>/images/**/*.{png,jpg,jpeg,gif,webp,svg}'],
        css: ['<%= pkg.themePath %>/css/**/*.css'],
        sass: ['<%= pkg.themePath %>/sass/**/*.scss']
    };
    grunt.config.merge({
        browserSync: {
            bsFiles: {
                src: [paths.css, paths.html]
            },
            options: {
                minify: false,
                notify: false,
                open: true,
                proxy: paths.localDev,
                watchTask: true
            }
        }
    });

    grunt.loadNpmTasks('grunt-browser-sync');
};
