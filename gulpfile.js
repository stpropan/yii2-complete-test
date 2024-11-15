const gulp = require('gulp');
const concat = require('gulp-concat');
const cleanCss = require('gulp-clean-css');
const uglyfyJs = require('gulp-uglify');

// Concat and minify CSS files
gulp.task('build-css', (cb) => {
    return gulp.src('web/src/css/*.css')
        .pipe(concat('site.css'))
        .pipe(cleanCss())
        .pipe(gulp.dest('web/dist/css'));
});

gulp.task('build-js', (cb) => {
    return gulp.src('web/src/js/*.js')
        .pipe(uglyfyJs())
        .pipe(gulp.dest('web/dist/js'));
});

gulp.task('session-start', (cb) => {
    return gulp.series('build-css', 'build-js')(cb);
})

gulp.task('default', gulp.series('session-start'));