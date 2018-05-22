'use strict';
// common plugins
var gulp = require('gulp');
var plumber = require('gulp-plumber');
var util = require('gulp-util');
var sass = require('gulp-sass');
var babel = require('gulp-babel');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var jsConcat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
var browserSync = require('browser-sync').create();
var concatCss = require('gulp-concat-css');
var autoprefixer = require('gulp-autoprefixer');

//Error handling function
var onError = function (error) {
    util.log(util.colors.red('EROR APPEARED'));
    util.log(error.toString());
    util.log(util.colors.red('Error (' + error.plugin + '): ' + error.message));
    this.emit('end');
};

// copy vendor files from node modules

gulp.task('copy', function() {
    gulp.src(['node_modules/jquery/dist/jquery.min.js'])
        .pipe(gulp.dest('./libs'));
    gulp.src(['node_modules/normalize.css/normalize.css'])
        .pipe(gulp.dest('./dest'));
});

// js tasks

gulp.task('lib-js',function(){
    // gulp.src(['./js/libs/*.js'])
    gulp.src(['./libs/jquery.min.js',
        './libs/jquery.bxslider.min.js',
        './libs/jquery.modal.min.js'])
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(jsConcat('libs.js'))
        .pipe(uglify())
        .pipe(rename('libs.min.js'))
        .pipe(gulp.dest('./dest'));
});

gulp.task('js',function(){
    gulp.src('./js/*.js')
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(babel({
            presets: ['es2015']
        }))
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('./dest'))
        .pipe(browserSync.stream());
});

// other tasks

gulp.task('html', function(){
    gulp.src('./*.html')
        .pipe(browserSync.stream());
});

gulp.task('php', function() {
    gulp.src('./*.php')
        .pipe(browserSync.stream());
});

gulp.task('sass', function() {
    gulp.src('./sass/style.scss')
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(sass())
        .pipe(cleanCSS({ compatibility: 'ie8' }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('./dest'))
        .pipe(browserSync.stream());
});

gulp.task('watch', function(){
    gulp.watch('./sass/*.scss',['sass']);
    gulp.watch('./js/*.js',['js']);
    gulp.watch('./*.html',['html']);
    gulp.watch('./*.php',['php']);
});

gulp.task('serve', function() {
    browserSync.init({
        proxy: 'localhost:7894'
    });
});

gulp.task('default',['html','php','copy','lib-js','js','sass','serve','watch']);
