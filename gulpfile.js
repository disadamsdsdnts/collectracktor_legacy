var gulp = require('gulp');
var bs = require('browser-sync').create(); // create a browser sync instance.
var sass = require('gulp-sass');

gulp.task('sass', function () {
    return gulp.src('css/**/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('css'));
});

gulp.task('browser-sync', function () {
    bs.init({
        proxy: "https://zatoichi.adammartin.es"
    });
});

gulp.task('sass', function () {
    return gulp.src('css/**/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('css/'))
        .pipe(bs.reload({ stream: true })); // prompts a reload after compilation
});

gulp.task('watch', ['browser-sync'], function () {
    gulp.watch("css/**/*.scss", ['sass']);
    gulp.watch("admin/**/*.php").on('change', bs.reload);
    gulp.watch("collections/**/*.php").on('change', bs.reload);
    gulp.watch("config/**/*.php").on('change', bs.reload);
    gulp.watch("install/**/*.php").on('change', bs.reload);
    gulp.watch("users/**/*.php").on('change', bs.reload);
    gulp.watch("*.php").on('change', bs.reload);
});

