/* eslint-disable */

const postcssNormalize = require("postcss-normalize");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const gradientTransparencyFix = require("postcss-gradient-transparency-fix");
const tailwindcss = require("tailwindcss");

module.exports = {
	plugins: [
		tailwindcss(),
		autoprefixer(),
		postcssNormalize(),
		cssnano({
			preset: "default",
		}),
		gradientTransparencyFix(),
	],
};
