/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  darkMode: 'class', // or 'media' or 'class'
	theme: {
		extend: {},
	},
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
