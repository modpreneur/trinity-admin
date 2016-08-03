var gulp = require('gulp');

var less  = require('gulp-less');
var path  = require('path');
var watch = require('gulp-watch');

var LessAutoprefix = require('less-plugin-autoprefix');
var autoprefix = new LessAutoprefix({ browsers: ['last 2 versions'] });

gulp.task('admin', function() {

    return watch('./AdminBundle/Resources/Public/less/admin.less')
        .pipe(less({
            paths: [ path.join(__dirname, 'less', 'includes') ],
            compress: true,
            plugins: [autoprefix]
        }))
        .pipe(gulp.dest('./AdminBundle/Resources/Public/css/'));
});

gulp.task('theme-brown', function() {

    return watch('./AdminBundle/Resources/Public/theme/Brown/theme.less')
        .pipe(less({
            paths: [ path.join(__dirname, 'less', 'includes') ],
            compress: true,
            plugins: [autoprefix]
        }))
        .pipe(gulp.dest('./AdminBundle/Resources/Public/theme/Brown'));
});


gulp.task('theme-dark-blue', function() {

    return watch('./AdminBundle/Resources/Public/theme/DarkBlue/theme.less')
        .pipe(less({
            paths: [ path.join(__dirname, 'less', 'includes') ],
            compress: true,
            plugins: [autoprefix]
        }))
        .pipe(gulp.dest('./AdminBundle/Resources/Public/theme/DarkBlue'));
});


gulp.task('default', ['admin', 'theme-brown', 'theme-dark-blue']);