const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
// require('laravel-mix-postcss-config');

mix.js('resources/js/app.js', 'public/js')
    .sass('./resources/sass/app.scss', './public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
    });
    // .postCssConfig();

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css')
//     .postCssConfig();
