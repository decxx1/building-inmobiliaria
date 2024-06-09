import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

const { addDynamicIconSelectors } = require('@iconify/tailwind');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx,vue}',
        'node_modules/flowbite/**/*.{js,jsx,ts,tsx}',
    ],

    theme: {
        colors:{
            'primary': '#0089ff',
            'primary-hover': '#4d84e2',
            'primary-dark': '#235487',
            'secondary': '#6c757d',
            'secondary-dark': '#2c3e50',
            'secondary-hover': '#8d99ae',
            'info': '#17a2b8',
            'info-dark': '#44a0de',
            'info-hover': '#52a9c2',
            'warning': '#ffc107',
            'warning-dark': '#f39d13',
            'warning-hover': '#f6c34e',
            'danger': '#dc3545',
            'danger-dark': '#e74d3d',
            'danger-hover': '#ed7d7d',
            'success': '#28a745',
            'success-dark': '#00bc8c',
            'success-hover': '#218838',
            'background-light': '#f4f6f9',
            'background-dark': '#121212',
            'background-semidark': '#191919',
            'surface-dark': '#1e1e1e',
            'backdrop-dark': '#121212d1',
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                SourceSansPro: ['Source Sans Pro', 'sans-serif'],
                Montserrat: ['Montserrat', 'sans-serif'],
            },
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin'),
        // Iconify plugin
        addDynamicIconSelectors(),
    ],
};
