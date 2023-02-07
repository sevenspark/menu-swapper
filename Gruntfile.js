module.exports = function (grunt) {



    grunt.initConfig({

        clean: {
            build: ['./build'],
        },
        copy: {
            build: {
                //cwd: 'source',
                src: ['**', '!**/node_modules/**', '!**/pro/**', '!**/wp-assets/**', '!bellows-pro.php', '!.gitignore', '!package.json', '!package-lock.json', '!README.md', '!Gruntfile.js', '!**/*.report.txt', '!**/_build_pro/**'],
                dest: './build',
                expand: true,

            },
        },
        wp_deploy: {
            deploy: {
                options: {
                    plugin_slug: 'menu-swapper',
                    svn_user: 'sevenspark',
                    build_dir: 'build', //relative path to your build directory
                    // assets_dir: 'wp-assets' //relative path to your assets directory (optional).
                },
            }
        },
    })


    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    // grunt.loadNpmTasks('grunt-wp-deploy');

    grunt.registerTas('clean', ['clean:build']);
    grunt.registerTask('build', ['copy:build']);
};
