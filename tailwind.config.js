/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/*.html",
  ],
  theme: {
    extend: {},
    screens: {
      'xs': '475px',
      '2xs': '125px',
      ...defaultTheme.screens,
    },
  },
  plugins: [],
}
