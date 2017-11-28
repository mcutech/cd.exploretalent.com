let gulp = require('gulp'),
  $ = require('gulp-load-plugins')(),
  _ = require('lodash'),
  composer = require('gulp-uglify/composer'),
  del = require('del'),
  gulpUtil = require('gulp-util'),
  lazypipe = require('lazypipe'),
  mbf = require('main-bower-files'),
  pump = require('pump'),
  runSequence = require('run-sequence'),
  uglifyEs = require('uglify-es'),
  uglifySaveLicense = require('uglify-save-license'),
  assets,
  destination = 'public',
  sources = [
    '.tmp/layouts/master.blade.php'
  ]

gulp.task('clean', clean)
gulp.task('clean.artifact', cleanArtifact)
gulp.task('fonts', _.partial(fonts, destination))
gulp.task('fonts.tmp', _.partial(fonts, '.tmp'))
gulp.task('build.finalize', buildFinalize)
gulp.task('copy.build', copyBuild)
gulp.task('build', build)

function clean (done) {
  del([ '.tmp' ], function () {
    done()
  })
}

function cleanArtifact (done) {
  del([
    destination + '/assets',
    destination + '/layouts'
  ], function () {
    done()
  })
}

function fonts (destination) {
  return gulp.src(mbf())
    .pipe($.filter('**/*.{eot,svg,ttf,woff,woff2,otf}'))
    .pipe(gulp.dest(destination + '/fonts'))
}

function buildFinalize () {
  let minify = composer(uglifyEs, console)

  return gulp.src(sources)

    .pipe($.useref(
      {searchPath: './'},
      lazypipe().pipe($.sourcemaps.init, {loadMaps: true})
    ))

    // generate cache bust only for non-php files
    .pipe($.if('!*.php', $.rev()))

    .pipe($.if(
      '*.js',
      minify({
        output: {
          comments: uglifySaveLicense
        }
      })
    ))

    .pipe($.if('*.css', $.cleanCss()))

    .pipe($.revReplace({
      replaceInExtensions: ['.php']
    }))

    .pipe($.rename(function (path) {
      if (path.extname === '.php') {
        path.dirname = 'layouts'
      }
    }))

    .pipe($.sourcemaps.write('maps'))

    .pipe(gulp.dest('.tmp/' + destination))
}

function copyBuild () {
  return gulp.src('.tmp/' + destination + '/**/*')
    .pipe(gulp.dest(destination))
}

function build () {
  runSequence(
    'clean',
    ['fonts', 'sass', 'browserify.build'],
    'inject',
    'build.finalize',
    'clean.artifact',
    'copy.build',
    'clean'
  )
}
