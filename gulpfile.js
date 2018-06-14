var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var minify = require('gulp-minify');
var plumber = require('gulp-plumber');

gulp.task('sass:lk', function() {
    return gulp.src('resources/assets/sass/main_lk.scss')
        .pipe(plumber())
        .pipe(sass().on('error', sass.logError)
        )
        .pipe(autoprefixer({
            browsers: ['last 10 versions', 'opera 12', 'safari 8', 'ie 8']
        }))
        .pipe(gulp.dest('public/css'));
});

gulp.task('js:lk', function(){
    return gulp.src('resources/assets/js/app_lk.js')
        .pipe(plumber())
        .pipe(minify())
        .pipe(gulp.dest('public/js'));
});

gulp.task('src_css:lk', function(){
    return gulp.src(['resources/assets/css/**/*'])
    .pipe(gulp.dest('public/css'));
});

gulp.task('src_js:lk', function(){
    return gulp.src(['resources/assets/js/**/*'])
    .pipe(gulp.dest('public/js'));
});

gulp.task('src_img:lk', function(){
    return gulp.src(['resources/assets/img/**/*'])
    .pipe(gulp.dest('public/img'));
});

gulp.task('watch', function() {
    gulp.watch('./sass/**/*.scss', ['sass:lk']);
    gulp.watch('./js/app_lk.js', ['js:lk']);
});
