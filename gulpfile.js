'use strict';

// //////////////////////////////
// Required
// //////////////////////////////

/*** General ***/
var gulp = require('gulp'),
    concat = require('gulp-concat'),
    sourceMaps = require('gulp-sourcemaps');

/*** Css ***/
var sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    gulpPlumber = require('gulp-plumber'),
    cleanCSS = require('gulp-clean-css');

/*** JS ***/
var uglify = require('gulp-uglify'),
    jshint = require('gulp-jshint');

/*** Font ***/
var iconfont = require('gulp-iconfont'),
    iconfontCss = require('gulp-iconfont-css');

/*** svg ***/
var svgSprite = require('gulp-svg-sprite');;

/*** Images ***/
var tinyimg = require('gulp-tinyimg');

/*** Others ***/
var inject = require('gulp-inject'),
    mainBowerFiles = require('main-bower-files'),
    rename = require('gulp-rename'),
    stylish = require('jshint-stylish'),
    browserSync = require('browser-sync').create(),
    clean = require('gulp-clean'),
    runSequence = require('run-sequence'),
    changed = require('gulp-changed');


// //////////////////////////////
// Settings
// //////////////////////////////
var g_app = {
  scss : ['src/scss/**/*.scss', 'src/css/**/*.css'],
  js : ['src/js/**/*.js', '!src/js/**/*.min.js']
}

var g_dest = {
  css : [],
  js : [],
  img : [],
  html : [],
  min_css : [],
  min_js : []
}

// //////////////////////////////
// svg
// //////////////////////////////

//Basic configuration example
var config = {
  mode:{
    css:{		// Activate the «css» mode
      render:{
        css: true	// Activate CSS output (with default options)
      }
    }
    }
};

gulp.task('sprite', function () {
  return gulp.src('src/icons/*.svg')
    .pipe(svgSprite(config))
    .pipe(gulp.dest('dev/svg'));
});

// gulp.task('sprites', function () {
//   return gulp.src('src/icons/*.svg')
//     .pipe(svgSprite())
//     .pipe(gulp.dest('dev/svg'));
// });

// //////////////////////////////
// Icon-font
// //////////////////////////////
var runTimestamp = Math.round(Date.now()/1000);

gulp.task('iconfont', function(){
  return gulp.src(['src/icons/*.svg'])
    .pipe(iconfontCss({
      fontName: 'iconFont',
      //path: 'src/scss/_icons.scss',
      targetPath: '/src/scss/_icons.scss',
      fontPath: 'dev/fonts/icon'
    }))
    .pipe(iconfont({
      fontName: 'iconFont', // required
      //prependUnicode: true, // recommended option

      formats: ['ttf', 'eot', 'woff', 'woff2'],
      appendCodepoints: true,
      appendUnicode: false,
      normalize: true,
      fontHeight: 1000,
      centerHorizontally: true

      //formats: ['ttf', 'eot', 'woff'], // default, 'woff2' and 'svg' are available
      //timestamp: runTimestamp, // recommended to get consistent builds when watching files
    }))
      .on('glyphs', function(glyphs, options) {
        console.log(glyphs, options);
      })
    .pipe(gulp.dest('dev/fonts/icon'));
});

// //////////////////////////////
// Compress Image Max-500
// //////////////////////////////
gulp.task('tinyimg', function(){
  return gulp.src('src/images/**/*.+(png|jpg)', { base: "./" })
    .pipe(tinyimg('61uPfAZ_VG-SueItJODqBWEj4pnFNGeP'))
    .pipe(gulp.dest('.'));
});

gulp.task('moveImg', function(){
  return gulp.src('src/images/**/*.+(png|jpg|gif|svg)', { base: "./src/" })
    .pipe(gulp.dest('./dev/'));
});

// //////////////////////////////
// CSS Task
// //////////////////////////////
gulp.task('clean-css', function (){
  console.log("************************* clean-css *************************");
  // return gulp.src(['dev/css/**/*.css', 'dev/maps/**/*.css.map'], {read: false})
  //   .pipe(clean());
});

gulp.task('sass',['sass-vendor'], function(){
  console.log("************************* css *************************");
  return gulp.src(g_app.scss)
    .pipe(sourceMaps.init())
    .pipe(gulpPlumber())
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(cleanCSS({debug: true}, function(details) {
        //console.log(details.name + ': ' + details.stats.originalSize);
        //console.log(details.name + ': ' + details.stats.minifiedSize);
    }))
    .pipe(concat('app.min.css'))
    .pipe(sourceMaps.write('../maps',{
      mapFile: function(mapFilePath) {
        return mapFilePath.replace('.css.map', '.map');
      }
    }))
    .pipe(gulp.dest('dev/css'));
});

gulp.task('sass-vendor',['clean-css'], function(){
    console.log("************************* vendor-css *************************");
    return gulp.src(mainBowerFiles('**/*.css'))
      .pipe(sourceMaps.init())
      .pipe(cleanCSS({debug: true}, function(details) {
          //console.log(details.name + ': ' + details.stats.originalSize);
          //console.log(details.name + ': ' + details.stats.minifiedSize);
      }))
      .pipe(concat('vendor.min.css'))
      .pipe(sourceMaps.write('../maps',{
        mapFile: function(mapFilePath) {
          return mapFilePath.replace('.css.map', '.map');
        }
      }))
      .pipe(gulp.dest('dev/css'));
});

// //////////////////////////////
// Script Task
// //////////////////////////////
gulp.task('clean-script', function () {
  console.log("************************* clean-script *************************");
  // return gulp.src(['dev/js/**/*.js', 'dev/maps/**/*.js.map'], {read: false})
  //   .pipe(clean());
});

gulp.task('script',['script-vendor'], function(){
  console.log("************************* script *************************");
  return gulp.src(g_app.js)
    //.pipe(sourceMaps.init())
    .pipe(jshint())
    .pipe(jshint.reporter(stylish))
    .pipe(concat('app.min.js'))
    .pipe(uglify())
    // .pipe(sourceMaps.write('../maps',{
    //   mapFile: function(mapFilePath) {
    //     return mapFilePath.replace('.js.map', '.map');
    //   }
    // }))
    .pipe(gulp.dest('dev/js'));
});

gulp.task('script-vendor',['clean-script'], function(){
  console.log("************************* vendor-script *************************");
  return gulp.src(mainBowerFiles('**/*.js'))
    //.pipe(sourceMaps.init())
    .pipe(concat('vendor.min.js'))
    //.pipe(uglify())
    // .pipe(sourceMaps.write('../maps',{
    //   mapFile: function(mapFilePath) {
    //     return mapFilePath.replace('.js.map', '.map');
    //   }
    // }))
    .pipe(gulp.dest('dev/js'));
});

// //////////////////////////////
// Inject Task
// //////////////////////////////
// gulp.task('inject', function (){
//   console.log("************************* inject *************************");
//   var target = gulp.src('html/*.+(html|php)');
//   //var target = gulp.src(['html/include/include-css.html', 'html/include/include-js.html']);
//   var sources = gulp.src(['dev/**/*.js', 'dev/**/*.css'],{read: false});
//   return target.pipe(inject(sources,{relative: true}))
//     .pipe(gulp.dest('html'));
//     //.pipe(gulp.dest('html/include/'));
// });

// //////////////////////////////
// Watch Task
// //////////////////////////////
gulp.task('watch', function(){
  console.log("************************* watch *************************");
  gulp.watch(['src/js/**/*.js'], ['script']);
  gulp.watch(['src/scss/**/*.scss', 'src/css/**/*.css'], ['sass']);
});

// //////////////////////////////
// Default Task
// //////////////////////////////
gulp.task('default', function(callback){
  //runSequence(['script','sass', 'moveImg'],'inject','watch', callback);
  runSequence(['script','sass', 'moveImg'],'watch', callback);
});
