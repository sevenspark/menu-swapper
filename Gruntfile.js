module.exports = function (grunt) {



    grunt.initConfig({

        build: {
            //cwd: 'source',
            src: ['**', '!**/node_modules/**', '!**/pro/**', '!**/wp-assets/**', '!bellows-pro.php', '!.gitignore', '!package.json', '!Gruntfile.js', '!**/*.report.txt', '!**/_build_pro/**'],
            dest: './build',
            expand: true,

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
};