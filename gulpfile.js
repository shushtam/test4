/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var elixir = require('laravel-elixir');
/*elixir(function(mix) {
 mix.less('app.less');
 });*/
elixir(function (mix) {
    mix.styles([
        '../../../public/bower_resources/bootstrap/dist/css/bootstrap.css',
        '../../../public/bower_resources/font-awesome/css/font-awesome.css',
        '../../../public/bower_resources/fullpage.js/dist/jquery.fullpage.css'
    ], 'public/css/style.css');
});
elixir(function (mix) {
    mix.scripts([
        '../../../public/bower_resources/jquery/dist/jquery.js',
        '../../../public/bower_resources/jquery-ui/jquery-ui.js',
        '../../../public/bower_resources/bootstrap/dist/js/bootstrap.min.js',
        '../../../public/bower_resources/jquery.easing/js/jquery.easing.js',
        '../../../public/bower_resources/fullpage.js/dist/jquery.fullpage.js'
    ], 'public/js/vendor.js');
});

var gulp = require('gulp'),
        uglify = require("gulp-uglify"),
        rename = require("gulp-rename"),
        minify = require("gulp-minify-css"),
        cleanCSS = require('gulp-clean-css'),
        tag_version = require('gulp-tag-version'),
        bump = require('gulp-bump'),
        cache = require('gulp-cached');
gulp.task('minjs', function () {
    gulp.src('public/js/vendor.js')
            .pipe(uglify())
            .pipe(rename("vendor.min.js"))
            .pipe(gulp.dest('public/js'));
});
gulp.task('mincss', function () {
    gulp.src('public/css/style.css')
            .pipe(cleanCSS())
            .pipe(rename("style.min.css"))
            .pipe(gulp.dest('public/css'));
});
gulp.task('bump', function () {
    gulp.src('./test.json')
            .pipe(bump())
            .pipe(gulp.dest('public'));
});
gulp.task('bump', function () {
    gulp.src('./test.json')
            .pipe(bump({type: 'major'}))
            .pipe(gulp.dest('public'));
});

gulp.task('tag', function () {
    return gulp.src(['./test.json']).pipe(tag_version());
});
/*gulp.task('lint', function(){
 return gulp.src('public/js')
 .pipe(cache('linting'))
 .pipe(jshint())
 .pipe(jshint.reporter())
 });*/


/*gulp.task('default', function () {
 // place code for your default task here
 });*/
