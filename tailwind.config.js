/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
   
  
    fontFamily: {
      sans: ['Graphik', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
    },
    extend: {
      colors: {
      
      },
    spacing: {
      '128': '32rem',
      '144': '36rem',
    },
    borderRadius: {
      '4xl': '2rem',
    }
    },
  },
  plugins: [
    require('flowbite/plugin'),
    require('tailwindcss-plugins/pagination')({}),
  ],
}

