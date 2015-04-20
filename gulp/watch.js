var gulp = require('gulp');

gulp.task('watch', watch);

function watch() {
	gulp.watch(['resources/scss/**/*.scss'], ['sass']);
}
