module.exports = {
	theme: {
		container: {
			center: true,
			padding: {
				DEFAULT: "1rem",
				sm: "1rem",
				lg: "1rem",
				xl: "0",
				"2xl": "0",
			},
		},
		extend: {
		},
	},
	plugins: [
		require('tailwindcss-container-bleed'),
	]
};
