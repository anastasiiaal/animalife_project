/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.{vue,js,ts,jsx,tsx}",
    "./templates/**/*.{html,twig}"
  ],
  theme: {
    extend: {},
    screens: {
      // 1199px => 1400
      '2xl': {'max': '1400px'},

      // 993px => 1199px
      'xl': {'max': '1199px'},

      // 768px => 992px
      'lg': {'max': '992px'},

      // 577px => 767px
      'md': {'max': '767px'},

      // 0 => 576px
      'sm': {'max': '576px'},
    }
  },
  plugins: [],
}

