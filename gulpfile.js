var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var less        = require('gulp-less');
var path        = require('path');


var LessAutoprefix = require('less-plugin-autoprefix');
var autoprefix     = new LessAutoprefix({ browsers: ['last 2 versions'] });


gulp.task('themes', function() {

    return gulp.src(['./AdminBundle/Resources/Public/less/*', './AdminBundle/Resources/Public/theme/*'])
        .pipe(less({
            paths: [ path.join(__dirname, 'less', 'includes') ],
            compress: true,
            plugins: [autoprefix]
        }))
        .pipe(gulp.dest('./AdminBundle/Resources/Public/theme'));
});


gulp.task('themes-watch', ['themes'], function (done) {
    browserSync.reload();
    browserSync.reload();
    done();
});


gulp.task('serv', ['themes'], function () {
    browserSync.init({
        proxy: "necktie.docker/app_dev.php/admin"
    });

    gulp.watch("./AdminBundle/Resources/Public/theme/DarkBlue.less", ['themes-watch']);
    gulp.watch("./AdminBundle/Resources/Public/theme/Brown.less", ['themes-watch']);
});


gulp.task('default', ['serv', 'themes']);