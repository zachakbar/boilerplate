'use strict';

// helpers 
// https://github.com/gulpjs/gulp
// https://www.webstoemp.com/blog/switching-to-gulp4/

var bourbon = require('bourbon').includePaths;
var del = require("del");
var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var eslint = require("gulp-eslint");
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

// lint
function scriptsLint() {
	return gulp.src(paths.scripts.src)
    .pipe(plumber())
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
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

// run eslint on js then run other tasks
var js = gulp.series(scriptsLint, scripts);
var build = gulp.series(clean, gulp.parallel(watch, js, css));

// declare tasks
exports.clean = clean;
exports.scriptsLint = scriptsLint;
exports.scripts = scripts;
exports.styles = css;
exports.watch = watch;
exports.build = build;

// run 'gulp' cli command 
exports.default = build;