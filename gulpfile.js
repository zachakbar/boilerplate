'use strict';

// helpers 
// https://github.com/gulpjs/gulp
// https://www.webstoemp.com/blog/switching-to-gulp4/

var bourbon = require('bourbon').includePaths;
var del = require("del");
var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var notify = require('gulp-notify');
var plumber = require("gulp-plumber");
var sass = require('gulp-sass');
var terser = require('gulp-terser');

// PATH objects
var paths = {
	scripts: {
		src: ['_src/js/**/*.js'],
		dest: ['assets/js/']
	},
	styles: {
		src: ['_src/scss/**/*.scss'],
		dest: ['assets/css/'],
		inc: [bourbon, 'node_modules/breakpoint-sass/stylesheets']
	}
};

// Clean assets
function clean() {
	return del(paths.scripts.dest,paths.styles.dest);
}

// js
function scripts() {
	return gulp.src(paths.scripts.src)
		.pipe(plumber())
		.pipe(concat('scripts.js'))
		.pipe(terser())
		.pipe(gulp.dest('assets/js/'))
		.pipe(notify({ message: 'JS complete!' }))
}
// css
function css() {
	return gulp.src(paths.styles.src)
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: paths.styles.inc
		}).on('error', sass.logError))
		.pipe(autoprefixer())
		.pipe(gulp.dest('assets/css/'))
		.pipe(notify({ message: 'CSS complete!' }));
}

// watch
function watch() {
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch(paths.styles.src, css);
}

var build = gulp.series(clean, gulp.parallel(watch, scripts, css));

// declare tasks
exports.clean = clean;
exports.scripts = scripts;
exports.styles = css;
exports.watch = watch;
exports.build = build;

// run 'gulp' cli command 
exports.default = build;