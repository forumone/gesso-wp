const path = require('path');
module.exports = (config) => {
	return {
		...config,
		devServer: {
			...config.devServer,
			static: path.resolve(process.cwd(), '../../..'),
		},
		output: {
			...config.output,
			clean: false,
		},
		resolve: {
			alias: {
				Source: path.resolve(__dirname, '../source'),
				F1BlockLibrary: path.resolve(
					__dirname,
					'../../../plugins/f1-block-library/build'
				),
			},
		},
	};
};
