const { merge } = require('webpack-merge');
const common = require('./webpack.common');
const ESLintPlugin = require('eslint-webpack-plugin');
const path = require('path');

module.exports = merge(common, {
	mode: 'development',
	devtool: 'source-map',
	plugins: [
		new ESLintPlugin({
			overrideConfigFile: path.resolve(__dirname, '.eslintrc-dev.js'),
			useEslintrc: false,
		}),
	],
});
