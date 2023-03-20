import Twig from 'twig';
import { addDecorator } from '@storybook/react';
import keysort from '../lib/keysort';

import '../dist/css/styles.css';

function setupTwig(twig) {
	twig.cache();
	keysort(twig);
	return twig;
}

setupTwig(Twig);

addDecorator((storyFn) => {
	return storyFn();
});

export const parameters = {
	layout: 'fullscreen',
	options: {
		storySort: {
			method: 'alphabetical',
			order: [
				'Global',
				['Color Palette', '*'],
				'Layouts',
				'Components',
				'Templates',
				'Pages',
			],
			includeName: true,
		},
	},
};
