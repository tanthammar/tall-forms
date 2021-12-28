const mix = require('laravel-mix')

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss/nesting'),
        require('tailwindcss'),
        // require('autoprefixer'), automatic w Laravel Mix 6
    ]);

mix.sourceMaps()
mix.version()
