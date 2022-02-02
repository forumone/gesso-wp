import domReady from '@wordpress/dom-ready';
import { registerBlockStyle, unregisterBlockStyle } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

domReady(() => {
	// BUTTONS
	unregisterBlockStyle('core/button', 'fill');
	unregisterBlockStyle('core/button', 'outline');
	registerBlockStyle('core/button', {
		name: 'primary',
		label: __('Primary'),
		isDefault: true,
	});
	registerBlockStyle('core/button', {
		name: 'secondary',
		label: __('Secondary'),
		isDefault: false,
	});
	registerBlockStyle('core/button', {
		name: 'danger',
		label: __('Danger'),
		isDefault: false,
	});

	// CARDS
	registerBlockStyle('f1-block-library/query-cards', {
		name: 'feature',
		label: __('Feature'),
	});
	registerBlockStyle('f1-block-library/manual-cards', {
		name: 'feature',
		label: __('Feature'),
	});

	// LINK
	registerBlockStyle('f1-block-library/standalone-link', {
		name: 'arrow',
		label: __('Arrow'),
	});
});
