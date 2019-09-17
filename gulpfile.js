'use strict';

const { dest, lastRun, parallel, series, src, watch } = require('gulp');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const sassGlob = require('gulp-sass-glob');
const stylelint = require('gulp-stylelint');
const postcss = require('gulp-postcss');
const config = require('./patternlab-config.json');
const patternlab = require('@pattern-lab/core')(config);

const webpack = require('webpack');
const util = require('util');
const asyncWebpack = util.promisify(webpack);

function lintStyles() {
  return src('**/*.scss', { cwd: './source', since: lastRun(lintStyles) }).pipe(
    stylelint({
      configFile: '.stylelintrc.yml',
      failAfterError: true,
      reporters: [{ formatter: 'string', console: true }],
    }),
  );
}

function buildStyles() {
  return src('*.scss', { cwd: './source' })
    .pipe(sassGlob())
    .pipe(sourcemaps.init())
    .pipe(sass({
      includePaths: ['./node_modules/breakpoint-sass/stylesheets'],
      precision: 10
    }))
    .pipe(
      postcss([
        require('postcss-assets')(),
        require('autoprefixer')({
          remove: false,
        }),
      ]),
    )
    .pipe(sourcemaps.write('.'))
    .pipe(dest('css'));
}

function buildPatternlab() {
  return patternlab.build({cleanPublic: true, watch: false});
}

async function bundleScripts(mode) {
  const webpackConfig = require('./webpack.config')(mode);
  const stats = await asyncWebpack(webpackConfig);
  if (stats.hasErrors()) {
    throw new Error(stats.compilation.errors.join('\n'));
  }
}

const gessoBundleScripts = (exports.gessoBundleScripts = () => bundleScripts('production'));
const gessoBundleScriptsDev = () => bundleScripts('development');

function fileWatch() {
  watch(
    ['source/**/*.scss', 'images/*.svg'],
    { usePolling: true, interval: 1500 },
    series(
      lintStyles,
      buildStyles
    ),
  );
  watch(
    'source/**/*.{twig,json,yaml,yml,md}',
    { usePolling: true, interval: 1500 },
    buildPatternlab
  );
  watch(
    'js/src/**/*.js',
    { usePolling: true, interval: 1500 },
    gessoBundleScriptsDev
  );
}

const gessoBuildPatternlab = exports.gessoBuildPatternlab = buildPatternlab;
const gessoBuildStyles = exports.gessoBuildStyles = series(lintStyles, buildStyles);

const buildTasks = (isProduction = true) => {
  const scriptTask = isProduction ? gessoBundleScripts : gessoBundleScriptsDev;
  return parallel(scriptTask, gessoBuildStyles, gessoBuildPatternlab);
};

exports.gessoBuild = buildTasks(true);
const gessoWatch = exports.gessoWatch = fileWatch;

exports.default = series(buildTasks(false), gessoWatch);