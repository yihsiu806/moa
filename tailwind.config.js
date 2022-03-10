const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'white': '#ffffff',
                'green': '#056839',
                'green-light': '#058344',
                'yellow': '#fdb515',
                'yellow-light': '#ffc615',
                'yellow-dark': '#D9940F',
                'grey-dark': '#5F6368',
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
