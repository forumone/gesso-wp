const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const StylelintPlugin = require('stylelint-webpack-plugin');
const embeddedSass = require('sass-embedded');
const path = require('path');
const glob = require('glob');
const RemovePlugin = require('remove-files-webpack-plugin');
const DependencyExtractionPlugin = require('@wordpress/dependency-extraction-webpack-plugin');

module.exports = {
	entry: () => {
		// Grab any JS files.
		const jsFiles = glob
			.sync('source/**/*.js', {
				ignore: ['**/_*'],
			})
			.reduce((entries, currentFile) => {
				const updatedEntries = entries;
				const filePaths = currentFile.split(path.sep);
				const sourceDirIndex = filePaths.indexOf('source');
				if (sourceDirIndex >= 0) {
					const fileName = path.basename(currentFile, '.js');
					const newFilePath = `js/${fileName}`;
					// Throw an error if duplicate files detected.
					if (updatedEntries[newFilePath]) {
						throw new Error(
							`More than one file named ${fileName}.js found.`
						);
					}
					updatedEntries[newFilePath] = {
						import: path.resolve(__dirname, currentFile),
					};
				}
				return updatedEntries;
			}, {});
		// Grab any SCSS files that aren't prefixed with _.
		const scssFiles = glob
			.sync('source/**/*.scss', {
				ignore: ['**/_*'],
			})
			.reduce((entries, currentFile) => {
				const updatedEntries = entries;
				const filePaths = currentFile.split(path.sep);
				const sourceDirIndex = filePaths.indexOf('source');
				if (sourceDirIndex >= 0) {
					const fileName = path.basename(currentFile, '.scss');
					const newFilePath = `css/${fileName}`;
					// Throw an error if duplicate files detected.
					if (updatedEntries[newFilePath]) {
						throw new Error(
							`More that one file named ${fileName}.scss found.`
						);
					}
					updatedEntries[newFilePath] = {
						import: `./${currentFile}`,
					};
				}
				return updatedEntries;
			}, {});
		return {
			...jsFiles,
			...scssFiles,
		};
	},
	plugins: [
		new MiniCssExtractPlugin(),
		new RemovePlugin({
			after: {
				test: [
					{
						folder: './build/css',
						method: (absolutePath) =>
							new RegExp(/\.js(\.map)?$/, 'm').test(absolutePath),
						recursive: true,
					},
				],
			},
		}),
		new StylelintPlugin({
			exclude: ['node_modules', 'build', 'storybook'],
		}),
		new DependencyExtractionPlugin(),
	],
	module: {
		rules: [
			{
				test: /\.scss$/i,
				exclude: /node_modules/,
				use: [
					{
						loader: MiniCssExtractPlugin.loader,
						options: {
							publicPath: '/wp-content/themes/gesso/build/',
						},
					},
					'css-loader',
					'postcss-loader',
					{
						loader: 'sass-loader',
						options: {
							implementation: embeddedSass,
							sassOptions: {
								includePaths: [
									path.resolve(__dirname, 'source'),
								],
							},
						},
					},
				],
			},
			{
				test: /\.(js|jsx)$/,
				exclude: /node_modules/,
				use: ['babel-loader'],
			},
			{
				test: /fonts\/.*\.(woff2?|ttf|otf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/i,
				exclude: ['/node_modules/'],
				type: 'asset/resource',
				generator: {
					filename: 'fonts/[hash][ext][query]',
				},
			},
			{
				test: /\.(png|svg|jpg|gif|webp)$/i,
				exclude: [
					/images\/_sprite-source-files\/.*\.svg$/,
					'/node_modules/',
				],
				type: 'asset',
				generator: {
					filename: 'images/[hash][ext][query]',
				},
			},
		],
	},
	resolve: {
		modules: [path.resolve(__dirname, 'source'), 'node_modules'],
	},
	output: {
		path: path.resolve(__dirname, 'build'),
	},
};
