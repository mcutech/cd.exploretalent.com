let gulp = require('gulp'),
  mbf = require('main-bower-files'),
  wiredep = require('wiredep').stream,
  $ = require('gulp-load-plugins')()

gulp.task('sass', ['sass.bower', 'sass.index'])

gulp.task('sass.bower', sassBower)
gulp.task('sass.index', sassIndex)

function sassBower () {
  return gulp.src('resources/scss/bower.scss')
    .pipe($.cssGlobbing({ extensions: '.scss' }))
    .pipe(wiredep())
    .pipe($.sass({style: 'expanded'}))
    .on('error', function handleError (err) {
      console.error(err.toString())
      this.emit('end')
    })
    .pipe($.autoprefixer())
    .pipe(gulp.dest('.tmp/assets'))
}

function sassIndex () {
  return gulp.src('resources/scss/index.scss')
    .pipe($.cssGlobbing({ extensions: '.scss' }))
    .pipe($.sass({style: 'expanded'}))
    .on('error', function handleError (err) {
      console.error(err.toString())
      this.emit('end')
    })
    .pipe(gulp.dest('.tmp/assets'))
}
