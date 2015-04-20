var gulp = require('gulp'),
	browserify = require('browserify'),
	watchify = require('watchify'),
	vinylSource = require('vinyl-source-stream'),

	bundler,
	source = './resources/js/index.js',
	destination = '.tmp/assets';

gulp.task('browserify.serve', browserifyServe);

gulp.task('browserify.build', browserifyBuild);

function browserifyServe() {
	bundler = watchify(browserify(source, watchify.args));
	bundler.on('update', bundle);
	return bundle();
}

function browserifyBuild() {
	bundler = browserify(source);
	return bundle();
}

function bundle() {
	return bundler.bundle()
	.on('error', function(err) { console.log(err); })
	.pipe(vinylSource('index.js'))
	.pipe(gulp.dest(destination));
}

