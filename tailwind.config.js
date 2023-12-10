import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Pally', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'brand-brown': '#9a0d09',
                'brand-black': '#2b2a4c',
                'brand-light': '#eee2de',
                'brand-yellow': '#ea906c',
                'brand-white': '#f5f5f5',
            },
            maxWidth: {
                '8xl': '90rem',
            }
        },
    },

    plugins: [forms],
};
