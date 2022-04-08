import domReady from '@wordpress/dom-ready';
import { registerBlockStyle, unregisterBlockStyle } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { createHigherOrderComponent } from '@wordpress/compose';
import { addFilter } from '@wordpress/hooks';
import classnames from 'classnames';
import { assign } from 'lodash';

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

	// SEARCH
	registerBlockStyle('core/search', {
		name: 'collapsed',
		label: __('Collapsed'),
	});

	// TEXT
	registerBlockStyle('core/paragraph', {
		name: 'no-max-width',
		label: __('No Max Width'),
	});
	registerBlockStyle('core/heading', {
		name: 'no-max-width',
		label: __('No Max Width'),
	});

	const withSearchIcon = createHigherOrderComponent((BlockEdit) => {
		return (props) => {
			if (
				props.name !== 'core/search' ||
				!props.attributes?.className.includes('is-style-collapsed')
			)
				return <BlockEdit {...props} />;
			return (
				<div className="collapsed-search">
					<button type="button" className="collapsed-search__toggle">
						<svg
							xmlns="http://www.w3.org/2000/svg"
							viewBox="0 0 24 24"
							fill="currentColor"
							width="24px"
							height="24px"
						>
							<path d="M0 0h24v24H0z" fill="none" />
							<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
						</svg>
					</button>
					<div className="collapsed-search__content">
						<BlockEdit {...props} />
					</div>
				</div>
			);
		};
	}, 'withSearchIcon');
	addFilter('editor.BlockEdit', 'gesso/with-search-icon', withSearchIcon);

	const shouldNotHaveNarrowConstrain = (blockType, props) => {
		return (
			!blockType.name ||
			!['core/paragraph', 'core/heading'].includes(blockType.name) ||
			(props?.className &&
				props?.className.includes('is-style-no-max-width'))
		);
	};

	const addNarrowConstrainClasses = (props) =>
		assign(props, {
			className: classnames(
				props?.className || '',
				'l-constrain',
				'l-constrain--small'
			),
		});

	const removeNarrowConstrainClass = (props) => {
		if (!props?.className) return props;
		return assign(props, {
			className: props?.className
				.replace('l-constrain--small', '')
				.replace('l-constrain', ''),
		});
	};

	const withNarrowConstrain = createHigherOrderComponent((BlockListBlock) => {
		return (props) => {
			let newAttributes;
			if (shouldNotHaveNarrowConstrain(props, props.attributes)) {
				newAttributes = removeNarrowConstrainClass(props.attributes);
			} else if (
				props.attributes.className &&
				props.attributes.className.includes('l-constrain')
			) {
				newAttributes = props.attributes;
			} else {
				newAttributes = addNarrowConstrainClasses(props.attributes);
			}
			const newProps = assign(props, {
				attributes: newAttributes,
			});
			return <BlockListBlock {...newProps} />;
		};
	}, 'withNarrowConstrain');
	addFilter(
		'editor.BlockListBlock',
		'gesso/with-narrow-constrain',
		withNarrowConstrain
	);

	const addNarrowConstrain = (props, blockType) => {
		if (shouldNotHaveNarrowConstrain(blockType, props)) {
			return props;
		}
		if (props.className && props.className.includes('l-constrain')) {
			return props;
		}
		return addNarrowConstrainClasses(props);
	};
	addFilter(
		'blocks.getSaveContent.extraProps',
		'gesso/add-narrow-constrain',
		addNarrowConstrain
	);
});
