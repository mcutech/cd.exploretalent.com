var gulp = require('gulp'),
	reload = require('browser-sync').reload;

gulp.task('watch', watch);

function watch() {
	gulp.watch(['resources/scss/**/*.scss'], ['sass']);
	gulp.watch(['resources/views/layouts/master.blade.php'], ['inject']);
	gulp.watch(['.tmp/**/*', 'resources/**/*.php', 'app/**/*.php'])
		.on('change', reload);
}
