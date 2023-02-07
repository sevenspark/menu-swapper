module.exports = function (grunt) {



    grunt.initConfig({

        clean: {
            build: {
                src: ['./__/build'],
            },
        },
        copy: {
            build: {
                src: ['**', '!**/node_modules/**', '!**/__/**', '!**/wp-assets/**', '!bellows-pro.php', '!.gitignore', '!package.json', '!package-lock.json', '!README.md', '!Gruntfile.js', '!**/*.report.txt', '!**/_build_pro/**'],
                dest: './__/build',
                expand: true,
            },
        },
        wp_deploy: {
            deploy: {
                options: {
                    plugin_slug: 'menu-swapper',
                    svn_user: 'sevenspark',
                    build_dir: '__/build', //relative path to your build directory
                    // assets_dir: 'wp-assets' //relative path to your assets directory (optional).
                },
            }
        },
    })


    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    // grunt.loadNpmTasks('grunt-wp-deploy');

    // grunt.registerTask('clean', ['clean:build']); // causes issues due to same task name I believe
    grunt.registerTask('build', ['clean:build', 'copy:build']);
};
