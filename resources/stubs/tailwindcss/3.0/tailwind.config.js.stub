const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './app/**/*.php',
        //if Jetstream
        './vendor/laravel/jetstream/**/*.blade.php',
        //if Jetstream and Breeze
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        // Tall-forms
        './config/tall-forms.php',
        './vendor/tanthammar/tall-forms/**/*.php',
        './vendor/tanthammar/tall-forms-sponsors/**/*.php',
        // File formats applicable to most projects
        './resources/**/*.{html,js,jsx,ts,tsx,php,vue,twig}',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
              current: 'currentColor',
            },
        },
    },

    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
    ],
};
