let gulp = require('gulp'),
  $ = require('gulp-load-plugins')(),
  mbf = require('main-bower-files')

gulp.task('inject', inject)

function inject () {
  let target = gulp.src('resources/views/layouts/master.blade.php'),
    sources = gulp.src([
      './.tmp/**/*.js',
      './.tmp/**/*.css',
      '!./src/**/*.spec.js'
    ], { read: false }),
    bower = gulp.src(
      mbf(),
      { read: false }
    )

  return target
    .pipe($.inject(sources))
    .pipe($.inject(bower, { name: 'bower' }))
    .pipe(gulp.dest('.tmp/layouts'))
}
