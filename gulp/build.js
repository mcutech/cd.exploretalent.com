var gulp = require('gulp'),
	$ = require('gulp-load-plugins')(),
	_ = require('lodash'),
	del = require('del'),
	runSequence = require('run-sequence'),
	uglifySaveLicense = require('uglify-save-license'),
	mbf = require('main-bower-files'),

	assets,
	sources,
	destination,

	sources = [
		'.tmp/layouts/master.blade.php'
	];

	destination = 'public';

gulp.task('clean', clean);
gulp.task('clean.artifact', cleanArtifact);
gulp.task('fonts', _.partial(fonts, destination));
gulp.task('fonts.tmp', _.partial(fonts, '.tmp'));
gulp.task('build.finalize', buildFinalize);
gulp.task('copy.build', copyBuild);
gulp.task('build', build);

function clean(done) {
	del([ '.tmp' ], function() {
		done();
	});
}

function cleanArtifact(done) {
	del([ destination + '/assets' ], function() {
		done();
	});
}

function fonts(destination) {
	return gulp.src(mbf())
		.pipe($.filter('**/*.{eot,svg,ttf,woff,woff2,otf}'))
		.pipe(gulp.dest(destination + '/fonts'));
}

function buildFinalize() {
	return gulp.src(sources)

	.pipe(assets = $.useref.assets({searchPath: './'}))

	.pipe($.rev())

	.pipe($.if('*.js',
		$.uglify({preserveComments: uglifySaveLicense}))
	)

	.pipe(assets.restore())

	.pipe($.useref())

	.pipe($.revReplace({
		replaceInExtensions: ['.js', '.css', '.php']
	}))

	.pipe($.rename(function(path) {
		if(path.extname === '.php') {
			path.dirname = 'layouts';
		}
	}))

	.pipe(gulp.dest('.tmp/' + destination));

}

function copyBuild() {
	return gulp.src('.tmp/' + destination + '/**/*')
		.pipe(gulp.dest(destination));
}

function build() {
	runSequence(
		'clean',
		['fonts', 'sass', 'browserify.build'],
		'inject',
		'build.finalize',
		'clean.artifact',
		'copy.build',
		'clean'
	);
}

