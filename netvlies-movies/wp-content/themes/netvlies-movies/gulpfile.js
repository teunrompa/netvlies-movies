const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const browserSync = require("browser-sync").create();

function buildStyles() {
  return gulp
    .src("./scss/**/*.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(gulp.dest("./css"));
}

function watch(){
  gulp.watch("./scss/**/*.scss", buildStyles);
  gulp.watch("./*.html").on("change", browserSync.reload);
}

exports.buildStyles = buildStyles;
exports.watch = watch;