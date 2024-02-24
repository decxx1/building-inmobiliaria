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
            'primary': '#007bff',
            'darkprimary': '#4c7198',
            'secondary': '#6c757d',
            'darksecondary': '#2c3e50',
            'info': '#17a2b8',
            'darkinfo': '#44a0de',
            'warning': '#ffc107',
            'darkwarning': '#f39d13',
            'danger': '#dc3545',
            'darkdanger': '#e74d3d',
            'success': '#28a745',
            'darksuccess': '#0cbf91',

        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
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
