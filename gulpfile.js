'use strict';

const { src, dest, watch, series } = require("gulp");

const autoprefixer = require("gulp-autoprefixer");
const concat = require("gulp-concat");
const imagemin = require("gulp-imagemin");
const minify = require("gulp-minify");
const mjml = require("gulp-mjml");
const mjmlEngine = require("mjml");
const newer = require("gulp-newer");
const plumber = require("gulp-plumber");
const rename = require("gulp-rename");
const sass = require('gulp-sass')(require('sass'));

const outputDir = "./public";

// SCSS to CSS
function sassToCss() {
    return src("./resources/scss/*.*")
        .pipe(plumber())
        .pipe(
            sass({
                outputStyle: "expanded"
            })
        )
        .pipe(autoprefixer())
        .pipe(
            rename({
                extname: ".css"
            })
        )
        .pipe(dest(outputDir + "/css"));
}

function cssMini() {
    return src([outputDir + "/css/*.css", "!" + outputDir + "/css/*.min.css"])
        .pipe(
            rename({
                suffix: ".min"
            })
        )
        .pipe(dest(outputDir + "/css"));
}

// Optimize Images
function images() {
    return src("./resources/img/**/*")
        .pipe(newer("public/img"))
        .pipe(
            imagemin()
        )
        .pipe(dest(outputDir + "/img"));
}

// Concat JS Scripts
function concatJs() {
    return src(["./resources/js/*.js"])
        .pipe(concat("application.js"))
        .pipe(dest(outputDir + "/js"));
}

// Compress JS Script
function compressJsScripts() {
    return src(outputDir + "/js/application.js")
        .pipe(
            minify({
                ext: {
                    min: ".min.js"
                },
                ignoreFiles: ["*min.js"]
            })
        )
        .pipe(dest(outputDir + "/js"));
}

// Generate mjml
function emailTemplate() {
    return src("./resources/mjml/*.mjml")
        .pipe(mjml())
        .pipe(
            rename({
                extname: ".twig"
            })
        )
        .pipe(dest("./application/views/emails"));
}

// Watch files and run tasks
function watchFiles() {
    "use strict";
    watch("./resources/scss/**/*", series(sassToCss, cssMini));
    watch("./resources/js/**/*", series(concatJs, compressJsScripts));
    watch("./resources/img/**/*", images);
    watch("./resources/mjml/*.*", emailTemplate);
}

exports.sassToCss = sassToCss;
exports.cssMini = cssMini;
exports.images = images;
exports.concatJs = concatJs;
exports.emailTemplate = emailTemplate;
exports.compressJsScripts = series(concatJs, compressJsScripts);

exports.watch = watchFiles;
exports.default = series(sassToCss, cssMini, images, concatJs, emailTemplate, compressJsScripts);