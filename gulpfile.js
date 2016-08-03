var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var less        = require('gulp-less');
var path        = require('path');

var LessAutoprefix = require('less-plugin-autoprefix');
var autoprefix     = new LessAutoprefix({ browsers: ['last 2 versions'] });


gulp.task('theme-dark-blue', function() {

    return gulp.src('./AdminBundle/Resources/Public/theme/DarkBlue.less')
        .pipe(less({
            paths: [ path.join(__dirname, 'less', 'includes') ],
            compress: true,
            plugins: [autoprefix]
        }))
        .pipe(gulp.dest('./AdminBundle/Resources/Public/theme'));
});


gulp.task('theme-brown', function() {

    return gulp.src('./AdminBundle/Resources/Public/theme/Brown.less')
        .pipe(less({
            paths: [ path.join(__dirname, 'less', 'includes') ],
            compress: true,
            plugins: [autoprefix]
        }))
        .pipe(gulp.dest('./AdminBundle/Resources/Public/theme'));
});


gulp.task('theme-watch', ['theme-dark-blue', 'theme-brown'], function (done) {
    browserSync.reload();
    done();
});


gulp.task('serv', ['theme-dark-blue', 'theme-brown'], function () {
    browserSync.init({
        proxy: "necktie.docker/app_dev.php/admin"
    });

    gulp.watch("./AdminBundle/Resources/Public/theme/DarkBlue.less", ['theme-watch']);
    gulp.watch("./AdminBundle/Resources/Public/theme/Brown.less", ['theme-watch']);
});


gulp.task('default', ['serv', 'theme-brown', 'theme-dark-blue']);