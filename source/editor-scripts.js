import domReady from '@wordpress/dom-ready';
import { unregisterBlockStyle } from '@wordpress/blocks';

domReady(() => {
	unregisterBlockStyle('core/button', 'fill');
	unregisterBlockStyle('core/button', 'outline');
});
