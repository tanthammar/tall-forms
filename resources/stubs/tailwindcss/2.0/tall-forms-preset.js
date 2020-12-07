const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: {
        content: [
            './app/**/*.php',
            //if Jetstream
            './vendor/laravel/jetstream/**/*.blade.php',
            //if Jetstream or Breeze
            './storage/framework/views/*.php',
            //endif Jetstream or Breeze
            // Tall-forms start
            './config/tall-forms.php',
            './vendor/tanthammar/tall-forms/**/*.php',
            './vendor/tanthammar/tall-forms-sponsors/**/*.php',
            // Tall-forms end
            // Add the file formats applicable to your project
            './resources/**/*.html',
            './resources/**/*.js',
            './resources/**/*.jsx',
            './resources/**/*.ts',
            './resources/**/*.tsx',
            './resources/**/*.php',
            './resources/**/*.vue',
            './resources/**/*.twig',
        ],
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
    ],
};
