'use strict';

// We declare Gulp dependencies
var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');

// We declare our sass input / output vars
var input = './templates/src/scss/*.scss';
var output = './templates/src/css';

// We set sass compile options
var sassOptions = {
	errLogToConsole: true,
	outputStyle: 'expanded'
};

// We start to run our gulp tasks
gulp.task('sass', function () {
  return gulp
    .src(input)
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(gulp.dest(output));
});