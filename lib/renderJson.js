const fs = require('fs').promises;

function addToPalette(data, colorType, palette) {
	for (const [color, variants] of Object.entries(
		data.gesso.palette[colorType]
	)) {
		if (typeof variants === 'string') {
			const colorData = {
				slug: `${colorType}-${color}`,
				name: `${colorType}-${color}`,
				color: `${variants}`,
			};
			palette.push(colorData);
		} else {
			for (const [variant, colorValue] of Object.entries(variants)) {
				const colorData = {
					slug: `${colorType}-${color}-${variant}`,
					name: `${colorType} ${color} ${variant}`,
					color: `${colorValue}`,
				};
				palette.push(colorData);
			}
		}
	}
}

function addToFontFamilies(data, key, fontFamilies) {
	for (const [fontKey, font] of Object.entries(data.gesso.typography[key])) {
		const fontFamily = {
			name: font.name,
			slug: fontKey,
			fontFamily: font.stack,
		};
		fontFamilies.push(fontFamily);
	}
}

function addToFontSizes(data, key, fontSizes) {
	for (const [size, value] of Object.entries(data.gesso.typography[key])) {
		const fontSize = {
			name: `${size}`,
			slug: `${size}`,
			size: value,
		};
		fontSizes.push(fontSize);
	}
}

function addToCustomSettings(data, key, settings) {
	for (const [label, value] of Object.entries(data.gesso[key])) {
		settings[label] = value;
	}
}

async function renderJson(data, themeSettingsPath) {
	const themeSettingsBuffer = await fs.readFile(themeSettingsPath);
	const themeSettings = JSON.parse(themeSettingsBuffer.toString());
	// Add the colors
	const palette = [];
	addToPalette(data, 'brand', palette);
	addToPalette(data, 'grayscale', palette);
	addToPalette(data, 'other', palette);
	if (!themeSettings.settings.color) {
		themeSettings.settings.color = {};
	}
	themeSettings.settings.color.palette = palette;

	// Add font families.
	const fontFamilies = [];
	addToFontFamilies(data, 'font-family', fontFamilies);
	if (!themeSettings.settings.typography) {
		themeSettings.settings.typography = {};
	}
	themeSettings.settings.typography.fontFamilies = fontFamilies;

	// Add font sizes
	const fontSizes = [];
	addToFontSizes(data, 'font-size', fontSizes);
	themeSettings.settings.typography.fontSizes = fontSizes;

	// Add layout constrains.
	if (!themeSettings.settings.layout) {
		themeSettings.settings.layout = {};
	}
	if (!themeSettings.settings.custom) {
		themeSettings.settings.custom = {};
	}
	if (!themeSettings.settings.custom.constrain) {
		themeSettings.settings.custom.constrain = {};
	}
	const constrains = {};
	addToCustomSettings(data, 'constrains', constrains);
	themeSettings.settings.layout.contentSize = data.gesso.constrains.md;
	themeSettings.settings.layout.wideSize = data.gesso.constrains.lg;
	themeSettings.settings.custom.constrain = constrains;

	return JSON.stringify(themeSettings);
}

module.exports = renderJson;
