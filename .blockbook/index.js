import { registerBlockType, registerTheme } from 'blockbook-cli/src/app/api';
import themeStyles from '!!raw-loader!../build/css/blockbook.css';

import 'F1BlockLibrary/accordion';
import 'F1BlockLibrary/accordion-item';
import 'F1BlockLibrary/back-to-top';
import 'F1BlockLibrary/copyright';
import 'F1BlockLibrary/skiplinks';
import 'F1BlockLibrary/mega-menu';
import 'F1BlockLibrary/single-card';

// Themes
registerTheme({
	name: 'gesso',
	title: 'Gesso',
	editorStyles: themeStyles,
});

// Blocks
const blocks = [
	'core/archives',
	'core/audio',
	'core/buttons',
	'core/calendar',
	'core/categories',
	'core/code',
	'core/columns',
	'core/cover',
	'core/embed',
	'core/file',
	'core/gallery',
	'core/group',
	'core/heading',
	'core/image',
	'core/latest-posts',
	'core/list',
	'core/media-text',
	'core/paragraph',
	'core/preformatted',
	'core/pullquote',
	'core/quote',
	'core/rss',
	'core/search',
	'core/separator',
	'core/social-links',
	'core/spacer',
	'core/table',
	'core/tag-cloud',
	'core/verse',
	'core/video',
	'f1-block-library/accordion',
	'f1-block-library/back-to-top',
	'f1-block-library/copyright',
	'f1-block-library/skiplinks',
	'f1-block-library/mega-menu',
	'f1-block-library/single-card',
];
blocks.forEach((block) => registerBlockType(block));
