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

const inputDir = "./resources";
const outputDir = "./public";

// SCSS to CSS
function sassToCss() {
    return src(inputDir + "/scss/*.*")
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
    return src(inputDir + "/img/**/*")
        .pipe(newer("public/img"))
        .pipe(
            imagemin()
        )
        .pipe(dest(outputDir + "/img"));
}

// Concat JS Scripts
function concatJs() {
    return src([inputDir + "/js/application.js", inputDir + "/js/auth.js"])
//        .pipe(concat("application.js"))
        .pipe(dest(outputDir + "/js"));
}

// Compress JS Script
function compressJsScripts() {
    return src([outputDir + "/js/application.js", outputDir + "/js/auth.js"])
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
    return src(inputDir + "/mjml/*.mjml")
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
    watch(inputDir + "/scss/**/*", series(sassToCss, cssMini));
    watch(inputDir + "/js/**/*", series(concatJs, compressJsScripts));
    watch(inputDir + "/img/**/*", images);
    watch(inputDir + "/mjml/*.*", emailTemplate);
}

exports.sassToCss = sassToCss;
exports.cssMini = cssMini;
exports.images = images;
exports.concatJs = concatJs;
exports.emailTemplate = emailTemplate;
exports.compressJsScripts = series(concatJs, compressJsScripts);

exports.watch = watchFiles;
exports.default = series(sassToCss, cssMini, images, concatJs, emailTemplate, compressJsScripts);
