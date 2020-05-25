'use strict';

// helpers
// https://github.com/gulpjs/gulp
// https://www.webstoemp.com/blog/switching-to-gulp4/

var bourbon = require('bourbon').includePaths;
var breakpoint = 'node_modules/breakpoint-sass/stylesheets';
var del = require("del");
var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var concat = require('gulp-concat');
var notify = require('gulp-notify');
var plumber = require("gulp-plumber");
var sass = require('gulp-sass');
var terser = require('gulp-terser');

const gracefulFs = require('graceful-fs'),
			mapStream  = require('map-stream');

// modified version of https://www.npmjs.com/package/gulp-touch
const updateTimestamp = function (options) {
	return mapStream(function (file, cb) {
		if (file.isNull()) {
			return cb(null, file);
		}
		// Update file modification and access time
		return gracefulFs.utimes(file.path, new Date(), new Date(), cb.bind(null, null, file));
	});
};

// PATH objects
var paths = {
	scripts: {
		src: ['_src/js/**/*.js'],
		dest: ['assets/js/']
	},
	blocksjs: {
		src: ['_src/js/blocks/**/*.js'],
		dest: ['assets/js/blocks/']
	},
	styles: {
		src: [
			'_src/scss/admin.scss',
			'_src/scss/critical.scss',
			'_src/scss/styles.scss',
			'_src/scss/base/*.scss',
			'_src/scss/_core/**/*.scss',
			'_src/scss/_elements/**/*.scss',
			'_src/scss/_site/**/*.scss'
		],
		dest: ['assets/css/'],
		inc: [bourbon,breakpoint]
	},
	blockscss: {
		src: ['_src/scss/blocks/**/*.scss'],
		dest: ['assets/css/blocks/'],
		inc: [bourbon,breakpoint]
	}
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

// blocks js
function blocksjs() {
	return gulp.src(paths.blocksjs.src)
		.pipe(plumber())
		.pipe(terser())
		.pipe(gulp.dest(paths.blocksjs.dest))
		.pipe(notify({ message: 'Blocks JS complete!' }))
}

// css
function css() {
	return gulp.src(paths.styles.src)
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: paths.styles.inc
		}).on('error', sass.logError))
		.pipe(autoprefixer())
		.pipe(gulp.dest(paths.styles.dest))
		.pipe(updateTimestamp())
		.pipe(notify({ message: 'CSS complete!' }));
}

// blocks css
function blockscss() {
	return gulp.src(paths.blockscss.src)
		.pipe(sass({
			outputStyle: 'compressed',
			includePaths: paths.blockscss.inc
		}).on('error', sass.logError))
		.pipe(autoprefixer())
		.pipe(gulp.dest(paths.blockscss.dest))
		.pipe(notify({ message: 'Blocks CSS complete!' }));
}

// watch
function watch() {
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch(paths.blocksjs.src, blocksjs);
  gulp.watch(paths.styles.src, css);
  gulp.watch(paths.blockscss.src, blockscss);
}

var build = gulp.series(clean, gulp.parallel(watch, scripts, blocksjs, css, blockscss));

// declare tasks
exports.clean = clean;
exports.scripts = scripts;
exports.blocksjs = blocksjs;
exports.styles = css;
exports.blockscss = blockscss;
exports.watch = watch;
exports.build = build;

// run 'gulp' cli command
exports.default = build;