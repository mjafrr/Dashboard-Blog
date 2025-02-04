// Gulp file
const { src, dest, watch, series, parallel } = require('gulp');
const del = require('del');
const browserSync = require('browser-sync');
const postcss = require('gulp-postcss');
const concat = require('gulp-concat');
const tersers = require('gulp-terser');
const cleanCSS = require('gulp-clean-css');
const purgecss = require('gulp-purgecss');
const logSymbols = require('log-symbols');

//Load Previews on Browser on dev
function livePreview(done) {
  browserSync.init({
    files: "./**/*.html",
    startPath: "./",
    server: {
      baseDir: "./",
    },
    port: 3100 || 5000
  });
  done();
}
function watchFiles() {
  watch("./**/*.html", series(devStyles, previewReload));
  watch(["./tailwind.config.js", "./src/tailwind/**/*"], series(devStyles, previewReload));
  watch("./src/js/script.js", series(previewReload));
  console.log("\n\t" + logSymbols.info, "Watching for Changes..\n");
}
// reload
function previewReload(done) {
  console.log("\n\t" + logSymbols.info, "Reloading Browser Preview.\n");
  browserSync.reload();
  done();
}
// delete dist
function devClean() {
  console.log("\n\t" + logSymbols.info, "Cleaning dist folder for fresh start.\n");
  return del(["./dist"]);
}
// generate css
function devStyles() {
  const tailwindcss = require('tailwindcss');
  return src("./src/tailwind/tailwindcss.css")
    .pipe(postcss([
      tailwindcss("./tailwind.config.js"),
      require('autoprefixer'),
    ]))
    .pipe(concat({ path: 'style.css' }))
    .pipe(dest("./src/css"));
}
// minify css
function prodStyles() {
  return src("./src/css/style.css")
    .pipe(concat('style.css'))
    .pipe(cleanCSS({ compatibility: 'ie8' }))
    .pipe(dest("./dist/css"));
}
// minify js
function prodScripts() {
  return src([
    "vendors/alpinejs/dist/cdn.min.js",
    "vendors/glightbox/dist/js/glightbox.min.js",
    "vendors/@splidejs/splide/dist/js/splide.min.js",
    "vendors/hc-sticky/dist/hc-sticky.js",
    "src/js/script.js"
  ])
    .pipe(concat({ path: 'script.js' }))
    .pipe(tersers())
    .pipe(dest("./dist/js"));
}
// finish log
function buildFinish(done) {
  console.log("\n\t" + logSymbols.info, `Production is complete.\n`);
  done();
}
// Clean vendors
function cleanvendor() {
  return del(["./vendors/"]);
}
// Copy File from vendors
function copyvendors() {
  return src([
    './node_modules/*glightbox/**/*',
    './node_modules/*alpinejs/**/*',
    './node_modules/*bootstrap-icons/**/*',
    './node_modules/*hc-sticky/**/*',
    './node_modules/*@splidejs/splide/**/*'
  ])
    .pipe(dest('./vendors/'))
}

exports.updatevendors = series(cleanvendor, copyvendors);
exports.default = series(devClean, devStyles, livePreview, watchFiles);
exports.prod = series(
  devClean,
  parallel(prodStyles, prodScripts), //Run All tasks in parallel
  buildFinish
);