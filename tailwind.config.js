/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  darkMode: 'class', // or 'media' or 'class'
	theme: {
    fontFamily: {
        'sans': ['Source Sans Pro', 'sans-serif'],
        'mono': ['Prompt', 'sans-serif'],
        'lato': ['Lato', 'sans-serif'],
    },
    extend: {
      colors: {
        transparent: 'transparent',
        current: 'currentColor',
        'main-blue': '#F8F9FD',
        'main-blue-dark': '#38537C',
        'purple': '#3f3cbb',
        'main-grey': '#B3B3B3',
        'blue-dark': '#466288',
        'midnight': '#121063',
        'metal': '#565584',
        'tahiti': '#3ab7bf',
        'silver': '#ecebff',
        'bubble-gum': '#ff77e9',
        'bermuda': '#78dcca',
        'very-light-blue': "#F8F8FA",
        'grey-light-blue': "#CDD3DB",
        'light-blue': "#75A3E3",
        'btn-cta-blue': "#355070"
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
