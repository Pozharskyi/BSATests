module.exports = function(grunt) {

    grunt.initConfig({
        browserify: {
            main:{
              src:'resources/assets/js/app/main.js',
              dest:'public/js/main.js'
            },
            bundle: {
                src: 'resources/assets/js/app/main.js',
                dest: 'public/js/bundle.js',
                options: {
                    debug: true
                }
            }
        },
        uglify: {
            bundle: {
                src: 'public/js/bundle.js',
                dest: 'public/js/bundle.js'
            },
            main:{
                src:'resources/assets/js/app/main.js',
                dest:'public/js/main.js'
            }
        },
        watch: {
            options: {
                livereload: true
            },
            js:{
                files: ['resources/assets/**/*.js'],
                tasks: ['browserify:bundle']
            },
            css:{
                files: ['resources/assets/**/*.css'],
                tasks: ['concat:css']
            }

        },
        concat: {
            vendor_js: {
                src: 'bower_components/bootstrap/dist/js/bootstrap.js',
                dest: 'public/js/bower_vendors.js'
            },
            vendor_css: {
                src: ['bower_components/bootstrap/dist/css/bootstrap.css'],
                dest: 'public/css/bower_vendors.css'
            },
            css: {
                src: 'resources/css/*.css',
                dest: 'public/css/main.css'
            }
        }
    });

    grunt.loadNpmTasks('grunt-browserify');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');

    grunt.registerTask('stage', ['browserify','concat']);
    grunt.registerTask('prod', ['browserify', 'uglify', 'concat']);
    grunt.registerTask('dev', ['browserify','concat','watch']);

};