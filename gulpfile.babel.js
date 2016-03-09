// created 2016-02-29 for luskin

'use strict';

import autoprefixer from 'autoprefixer';
import browserSync from 'browser-sync';
import gulp from 'gulp';
import gulpLoadPlugins from 'gulp-load-plugins';
import minifyCss from 'gulp-minify-css';
import pngquant from 'imagemin-pngquant';

const $ = gulpLoadPlugins();
const reload = browserSync.reload;

// Define input paths by type
var inputstream = {

   scss:    ['./library/scss/**/*.scss', '!./library/scss/breakpoints', '!./library/scss/modules', '!./library/scss/partials', '!./library/scss/sections'],
   v_scss:  ['./library/plugins/**/*.scss', './library/vendors/**/*.scss'],

   v_css:   ['./library/plugins/**/*.css', '!./library/plugins/**/*.min.css', '!./library/plugins/**/*.pack.css'],

   js:      ['./library/js/**/*.js', '!./library/js/**/*.pack.js', '!./library/js/**/*.min.js', '!./library/js/libs/*.htc'],
   v_js:    ['./library/plugins/**/*.js', '!./library/plugins/**/*.pack.js', '!./library/plugins/**/*.min.js', '!./library/plugins/**/*.htc'],

   images:  ['./library/images/**/*'],
   v_imgs:  ['./library/plugins/**/*'],

   php:     ['./*.php']

};

// run scss/sass tasks for non-vendor files
gulp.task('scss', function () {
  return gulp.src(inputstream.scss)
    .pipe($.plumber())

    // write out the non-minified versions
    .pipe($.sass.sync({
      outputStyle: 'nested', // nested, expanded, compact, or compressed
      precision: 10,
      includePaths: ['.']
    }).on('error', $.sass.logError))
    .pipe($.postcss([
      autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']})
    ]))
    .pipe($.size({
      showFiles: true
    }))
    .pipe(gulp.dest('./library/css'))

    // write out the minified versions
    .pipe($.sourcemaps.init())
    .pipe($.sass.sync({
      outputStyle: 'compressed', // nested, expanded, compact, or compressed
      precision: 10,
      includePaths: ['.']
    }).on('error', $.sass.logError))
    .pipe($.postcss([
      autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']})
    ]))
    .pipe($.sourcemaps.write())
    .pipe($.rename(function (path) {
      path.basename += ".min";
      return path;
    }))
    .pipe($.size({
      showFiles: true
    }))
    .pipe(gulp.dest('./library/css'))

    .pipe(reload({stream: true}));
});

// run scss/sass tasks within vendor files
gulp.task('v_scss', function () {
  return gulp.src(inputstream.v_scss, { base: "./" })
    .pipe($.plumber())

    // write out the non-minified versions
    .pipe($.sass.sync({
      outputStyle: 'nested', // nested, expanded, compact, or compressed
      precision: 10,
      includePaths: ['.']
    }).on('error', $.sass.logError))
    .pipe($.postcss([
      autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']})
    ]))
    .pipe($.size({
      showFiles: true
    }))
    //.on('error', $.gutil.log)
    .pipe(gulp.dest('.'))

    // write out the minified versions
    .pipe($.sourcemaps.init())
    .pipe($.sass.sync({
      outputStyle: 'compressed', // nested, expanded, compact, or compressed
      precision: 10,
      includePaths: ['.']
    }).on('error', $.sass.logError))
    .pipe($.postcss([
      autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']})
    ]))
    .pipe($.sourcemaps.write())
    .pipe($.rename(function (path) {
      path.basename += ".min";
      return path;
    }))
    .pipe($.size({
      showFiles: true
    }))
    //.on('error', $.gutil.log)
    .pipe(gulp.dest('.'))

    .pipe(reload({stream: true}));
});

// run css tasks within vendor files
gulp.task('v_css', function () {
  return gulp.src(inputstream.v_css, { base: "./" })
    .pipe($.plumber())

    // minify all css files
    .pipe(minifyCss())
    .pipe($.postcss([
      autoprefixer({browsers: ['> 1%', 'last 2 versions', 'Firefox ESR']})
    ]))
    .pipe($.rename(function (path) {
      path.basename += ".min";
      return path;
    }))
    //.pipe($.concat('luskin-css-styles.min.css'))
    .pipe($.size({
      showFiles: true
    }))
    //.on('error', $.gutil.log)
    .pipe(gulp.dest('.'))

    .pipe(reload({stream: true}));
});

// run javascript tasks for non-vendor files
gulp.task('js', function () {
  return gulp.src(inputstream.js, { base: "./" })
    .pipe($.plumber())

    // write out beautified versions
    .pipe($.babel())
    .pipe($.jsbeautifier({
      indent_level: 4,
      indent_char: ' ',
      space_after_anon_function: true
    }))
    .pipe($.size({
      showFiles: true
    }))
    //.on('error', $.gutil.log)
    .pipe(gulp.dest('.'))

    // write out the minified versions
    .pipe($.sourcemaps.init())
    .pipe($.babel())
    .pipe($.uglify())
    .pipe($.sourcemaps.write())
    .pipe($.rename(function (path) {
      path.basename += ".min";
      return path;
    }))
    .pipe($.size({
      showFiles: true
    }))
    //.on('error', $.gutil.log)
    .pipe(gulp.dest('.'))

    .pipe(reload({stream: true}));
});

// run javascript tasks for vendor files
gulp.task('v_js', function () {
  return gulp.src(inputstream.v_js, { base: "./" })
    .pipe($.plumber())

    // write out beautified versions
    .pipe($.babel())
    .pipe($.jsbeautifier({
      indent_level: 4,
      indent_char: ' ',
      space_after_anon_function: true
    }))
    .pipe($.size({
      showFiles: true
    }))
    //.on('error', $.gutil.log)
    .pipe(gulp.dest('.'))

    // write out the minified versions
    .pipe($.sourcemaps.init())
    .pipe($.babel())
    .pipe($.uglify())
    //.pipe($.concat())
    .pipe($.sourcemaps.write())
    .pipe($.rename(function (path) {
      path.basename += ".min";
      return path;
    }))
    .pipe($.size({
      showFiles: true
    }))
    //.on('error', $.gutil.log)
    .pipe(gulp.dest('.'))

    .pipe(reload({stream: true}));
});

// run image tasks for non-vendor files
gulp.task('images', function () {
  return gulp.src(inputstream.images, { base: "./" })
    .pipe($.plumber())

    .pipe($.imagemin({
      progressive: true,
      svgoPlugins: [{removeViewBox: false}],
      use: [pngquant()]
    }))
    .pipe($.size({
      showFiles: true
    }))
    //.on('error', $.gutil.log)
    .pipe(gulp.dest('.'))

    .pipe(reload({stream: true}));
});

// run image tasks for vendor files
gulp.task('v_imgs', function () {
  return gulp.src(inputstream.v_imgs, { base: "./" })
    .pipe($.plumber())

    .pipe($.imagemin({
      progressive: true,
      svgoPlugins: [{removeViewBox: false}],
      use: [pngquant()]
    }))
    .pipe($.size({
      showFiles: true
    }))
    //.on('error', $.gutil.log)
    .pipe(gulp.dest('.'))

    .pipe(reload({stream: true}));
});

// run php beautifier
gulp.task('php', function () {
  return gulp.src(inputstream.php, { base: "./" })
    .pipe($.plumber())
    
    .pipe($.phpcbf({
      bin: 'phpcbf',
      standard: 'PSR2',
      warningSeverity: 0
    }))
    .pipe($.size({
      showFiles: true
    }))
    //.on('error', $.gutil.log)
    .pipe(gulp.dest('.'))

    .pipe(reload({stream: true}));
});

// run js lint
gulp.task('lint', function () {
    // ESLint ignores files with "node_modules" paths.
    // So, it's best to have gulp ignore the directory as well.
    // Also, Be sure to return the stream from the task;
    // Otherwise, the task may end before the stream has finished.
    // e.g.: return gulp.src(['**/*.js','!node_modules/**'])
    return gulp.src(inputstream.js, inputstream.v_js, { base: "./" })
    // eslint() attaches the lint output to the "eslint" property
    // of the file object so it can be used by other modules.
    .pipe($.eslint())
    // .pipe($.eslint({
    //   extends: 'eslint:recommended',
    //   ecmaFeatures: {
    //       'modules': true
    //   },
    //   rules: {
    //     'strict': 2
    //   },
    //   globals: {
    //     'jQuery':false,
    //     '$':true
    //   },
    //   envs: [
    //     'browser'
    //   ]
    // }))
    // eslint.format() outputs the lint results to the console.
    // Alternatively use eslint.formatEach() (see Docs).
    .pipe($.eslint.format())
    //.pipe($.eslint.formatEach('compact', process.stderr))
    // To have the process exit with an error code (1) on
    // lint error, return the stream and pipe to failAfterError last.
    .pipe($.eslint.failAfterError());
});

// remove files/folders
gulp.task('clean', function () {
  return gulp.src('./tmp', {read: false})
    .pipe($.clean());
});

// watch streams
gulp.task('watch', function() {
  gulp.watch(inputstream.scss,    ['scss']);
  gulp.watch(inputstream.v_scss,  ['v_scss']);
  gulp.watch(inputstream.v_css,   ['v_css']);
  gulp.watch(inputstream.js,      ['js']);
  gulp.watch(inputstream.v_js,    ['v_js']);
  gulp.watch(inputstream.images,  ['images']);
  gulp.watch(inputstream.v_imgs,  ['v_imgs']);
});

gulp.task('build', ['clean', 'scss', 'v_scss', 'v_css', 'js' ,'v_js', 'images', 'v_imgs'], () => {
  return
});

// default task (called when you run `gulp` from cli)
gulp.task('default', ['clean'], () => {
  gulp.start('build');
});

