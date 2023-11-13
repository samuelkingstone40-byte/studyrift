const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js');
    
const tailwindcss = require('tailwindcss')

mix.css('resources/css/app.css', 'public/css')
   .options({
      processCssUrls: false,
      postCss: [ tailwindcss('tailwind.config.js') ],
})