var gulp 			= require('gulp'),
	 autoprefixer 	= require('gulp-autoprefixer'),
	 bourbon 		= require('bourbon').includePaths,
    connect			= require("gulp-connect"),
	 sass 			= require('gulp-sass'),
	 watch 			= require('gulp-watch'),
	 concat 			= require('gulp-concat'),
	 uglify 			= require('gulp-uglify'),
	 pump 			= require('pump'),
	 log	 			= require('fancy-log');

// SCSS paths
var paths = {
	scss: ["./_source/scss/**/*.scss"]
};

// Minify JS
gulp.task('js', function() {
	return gulp.src(['_source/js/_plugins.js','_source/js/_functions.js','_source/js/scripts.js'])
		.pipe(concat('scripts.js'))
		.pipe(uglify())
		.pipe(gulp.dest('assets/js/'))
		.on('end',function(){
			log('**************************************');
			log('************ JS COMPLETED ************');
			log('**************************************');
		});
});

// Compile SASS files
gulp.task('sass', function() {
	gulp.src(paths.scss)
		.pipe(sass({
			outputStyle: 'expanded',
			includePaths: [bourbon, 'node_modules/susy/sass', 'node_modules/breakpoint-sass/stylesheets']
		}).on('error', sass.logError))
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		.pipe(gulp.dest("assets/css/"))
		.on('end',function(){
			log('***************************************');
			log('************ CSS COMPLETED ************');
			log('***************************************');
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
gulp.task('default', ['connect', 'js', 'sass', 'watch']);