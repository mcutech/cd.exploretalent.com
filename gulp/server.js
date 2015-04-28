var gulp = require('gulp'),
	browserSync = require('browser-sync'),
	runSequence = require('run-sequence').use(gulp),
	spawn = require('child_process').spawn,
	args = require('yargs').argv;

gulp.task('serve', function(callback) {
	runSequence(
		'clean',
		'clean.artifact',
		'fonts',
		['sass', 'browserify.serve'],
		'inject',
		'serve.start',
		'watch',
		callback
	);
});

gulp.task('serve.start', function() {

	var host = '127.0.0.1:' + (args.port || 8000);

	var files = [
		'.tmp/**/*.css',
		'.tmp/**/*.js',
		'.tmp/**/*.php',
		'resources/views/**/*.php',
		'app/**/*.php'
	];

	var phpServer = spawn('php', ['-S', host, '-t', 'public', 'router.php']);

	var killPhpServer = function() {
		console.log('Server Killed');
		phpServer.kill();
		browserSync.exit();
		process.exit();
	};

	browserSync({
		proxy: host,
		ghostMode: false
	});

	process.stdin.resume();

	process.on('exit', killPhpServer);
	process.on('SIGINT', killPhpServer);

});
