var gulp = require('gulp'),
	browserify = require('browserify'),
	watchify = require('watchify'),
	$ = require('gulp-load-plugins')(),
	vinylSource = require('vinyl-source-stream'),
	vinylBuffer = require('vinyl-buffer'),
	pkg = require('../package.json'),

	bundler,
	source = './resources/js/index.js',
	destination = '.tmp/assets';

gulp.task('browserify.serve', browserifyServe);

gulp.task('browserify.build', browserifyBuild);

function browserifyServe() {
	bundler = watchify(browserify(source, watchify.args));
	bundler.on('update', serverBundle);

	return serverBundle();

	function serverBundle() {
		return bundler.bundle()
		.on('error', function(err) { console.log(err); })
		.pipe(vinylSource('index.js'))
		.pipe(vinylBuffer())
		.pipe($.preprocess({context: pkg.preprocess.development}))
		.pipe(gulp.dest(destination));
	}
}

function browserifyBuild() {
	bundler = browserify(source);
	return bundler.bundle()
	.on('error', function(err) { console.log(err); })
	.pipe(vinylSource('index.js'))
	.pipe(vinylBuffer())
	.pipe($.preprocess({context: pkg.preprocess.production}))
	.pipe(gulp.dest(destination));
}
