const fs = require('fs').promises;

async function renderJson(data, themeSettingsPath) {
  const themeSettingsBuffer = await fs.readFile(themeSettingsPath);
  const themeSettings = JSON.parse(themeSettingsBuffer.toString());
  // Add the colors
  const palette = [];
  const brandColors = Object.keys(data.gesso.palette.brand);
  brandColors.forEach(color => {
    const variants = Object.keys(data.gesso.palette.brand[color]);
    variants.forEach(variant => {
      const paletteData = {
        slug: `${color}-${variant}`,
        name: `${color} ${variant}`,
        color: data.gesso.palette.brand[color][variant]
      };
      palette.push(paletteData);
    });
  });
  const grayscaleColors = Object.keys(data.gesso.palette.grayscale);
  grayscaleColors.forEach(color => {
    const paletteData = {
      slug: `${color}`,
      name: `${color}`,
      color: data.gesso.palette.grayscale[color]
    };
    palette.push(paletteData);
  });
  const otherColors = Object.keys(data.gesso.palette.other);
  otherColors.forEach(color => {
    const variants = Object.keys(data.gesso.palette.other[color]);
    variants.forEach(variant => {
      const paletteData = {
        slug: `${color}-${variant}`,
        name: `${color} ${variant}`,
        color: data.gesso.palette.other[color][variant]
      };
      palette.push(paletteData);
    });
  });
  if (!themeSettings.settings.color) {
    themeSettings.settings.color = {};
  }
  themeSettings.settings.color.palette = palette;

  // Add font families.
  const fontFamilies = [];
  const fontStacks = Object.keys(data.gesso.typography['font-family']);
  fontStacks.forEach(font => {
    const fontFamily = {
      name: data.gesso.typography['font-family'][font].name,
      slug: font,
      fontFamily: data.gesso.typography['font-family'][font].stack,
    };
    fontFamilies.push(fontFamily);
  });
  if (!themeSettings.settings.typography) {
    themeSettings.settings.typography = {};
  }
  themeSettings.settings.typography.fontFamilies = fontFamilies;

  // Add font sizes
  const fontSizes = [];
  const sizes = Object.keys(data.gesso.typography['font-size']);
  sizes.forEach(size => {
    const fontSize = {
      name: `${size}`,
      slug: `${size}`,
      size: data.gesso.typography['font-size'][size]
    };
    fontSizes.push(fontSize);
  });
  themeSettings.settings.typography.fontSizes = fontSizes;

  // Add layout constrains.
  if (!themeSettings.settings.layout) {
    themeSettings.settings.layout = {};
  }
  themeSettings.settings.layout.contentSize = data.gesso.constrains.sm;
  themeSettings.settings.layout.wideSize = data.gesso.constrains.md;
  return JSON.stringify(themeSettings);
}

module.exports = renderJson;
