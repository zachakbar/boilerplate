var gulp 			= require('gulp'),
	 autoprefixer 	= require('gulp-autoprefixer'),
    connect			= require("gulp-connect"),
	 compass 		= require('gulp-compass'),
	 watch 			= require('gulp-watch'),
	 concat 			= require('gulp-concat'),
	 minify 			= require('gulp-minify'),
	 plumber			= require('gulp-plumber'),
	 gutil 			= require('gulp-util');

// SCSS paths
var paths = {
	scss: ["./_source/scss/**/*.scss"]
};

// Configure Compass settings
var compass_config = {
	css: 'assets/css',
	javascript: 'assets/js',
	sass: '_source/scss',
	image: 'assets/img',
	sourcemap: false,
	relative: true,
	logging: false,
	comments: true,
	environment: 'development',
	style: 'compressed',
	require: ['susy', 'breakpoint', 'bourbon']
};

// Minify JS
gulp.task('js', function() {
	return gulp.src(['_source/js/_plugins.js','_source/js/_functions.js','_source/js/scripts.js'])
		.pipe(plumber())
		.pipe(concat('scripts.js'))
		.pipe(minify({
			ext:{
				min:'-min.js'
			},
			preserveComments: 'some'
		}))
		.pipe(gulp.dest('assets/js/'))
		.on('end',function(){
			gutil.log('**************************************');
			gutil.log('************ JS COMPLETED ************');
			gutil.log('**************************************');
		});
});

// Compile SASS files
gulp.task('sass', function() {
	gulp.src(paths.scss)
		.pipe(plumber())
		.pipe(compass(compass_config))
		.on('error', function(error) {
			console.log(error);
			this.emit('end');
		})
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		.pipe(gulp.dest("assets/css/"))
		.on('end',function(){
			gutil.log('***************************************');
			gutil.log('************ CSS COMPLETED ************');
			gutil.log('***************************************');
		});
});

// Set up localhost server
gulp.task('connect', function() {
  connect.server({
    port: 8000,
    livereload: true
  });
});

// Watch
gulp.task("watch", function() {
	watch('_source/scss/**/*.scss', function() { gulp.start('sass'); });
	watch('_source/js/**/*.js', function() { gulp.start('js'); });
});

// Compile all gulp tasks
gulp.task('default', ['js', 'sass', 'watch', 'connect']);