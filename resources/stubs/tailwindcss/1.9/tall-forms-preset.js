const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    experimental: {
        applyComplexClasses: true,
    },

    purge: {
        content: [
            './vendor/laravel/jetstream/**/*.blade.php',
            './storage/framework/views/*.php',
            './app/**/*.php',
            './config/tall-forms.php', //your config
            './vendor/tanthammar/tall-forms/**/*.php', //this package files
            './vendor/tanthammar/tall-forms-sponsors/**/*.php', //the sponsor fields
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
};
