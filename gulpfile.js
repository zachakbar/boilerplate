'use strict';

// helpers
// https://github.com/gulpjs/gulp
// https://www.webstoemp.com/blog/switching-to-gulp4/

var autoprefixer = require('gulp-autoprefixer'),
		bourbon = require('bourbon').includePaths,
		concat = require('gulp-concat'),
		del = require("del"),
		gracefulFs = require('graceful-fs'),
		gulp = require('gulp'),
		mapStream  = require('map-stream'),
		notify = require('gulp-notify'),
		plumber = require("gulp-plumber"),
		sass = require('gulp-sass'),
		terser = require('gulp-terser');

var paths = {
			scripts: {
				src: ['_src/js/**/*.js'],
				dest: ['assets/js/']
			},
			styles: {
				src: ['_src/scss/**/*.scss'],
				dest: ['assets/css/'],
				inc: [bourbon, 'node_modules/breakpoint-sass/stylesheets']
			},
			adminstyles: {
				src: [
					'_src/scss/tdc-admin.scss',
				],
				dest: ['admin/css/'],
				inc: [bourbon,breakpoint]
			}
		};

// modified version of https://www.npmjs.com/package/gulp-touch
const updateTimestamp = function (options) {
	return mapStream(function (file, cb) {
		if (file.isNull()) {
			return cb(null, file);
		}
		return gracefulFs.utimes(file.path, new Date(), new Date(), cb.bind(null, null, file));
	});
};

// Clean assets
function clean() {
	return del('assets/js/scripts.js',paths.styles.dest);
}

// js
function scripts() {
	return gulp.src(paths.scripts.src)
		.pipe(plumber())
		.pipe(concat('scripts.js'))
		.pipe(terser())
		.pipe(gulp.dest(paths.scripts.dest))
		.pipe(notify({ message: 'JS complete!' }))
}
// css
function css() {
	return gulp.src(paths.styles.src)
		.pipe(plumber())
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: paths.styles.inc
		}).on('error', sass.logError))
		.pipe(autoprefixer())
		.pipe(gulp.dest(paths.styles.dest))
		.pipe(updateTimestamp())
		.pipe(notify({ message: 'CSS complete!' }));
}

// admin css
function admincss() {
	return gulp.src(paths.adminstyles.src)
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: paths.adminstyles.inc
		}).on('error', sass.logError))
		.pipe(autoprefixer())
		.pipe(gulp.dest(paths.adminstyles.dest))
		.pipe(updateTimestamp())
		.pipe(notify({ message: 'Admin CSS complete!' }));
}

// watch
function watch() {
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch(paths.styles.src, css);
  gulp.watch(paths.adminstyles.src, css);
}

var build = gulp.series(clean, gulp.parallel(watch, scripts, css, admincss));

// declare tasks
exports.clean = clean;
exports.scripts = scripts;
exports.styles = css;
exports.adminstyles = admincss;
exports.watch = watch;
exports.build = build;

// run 'gulp' cli command
exports.default = build;
