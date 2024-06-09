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
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                SourceSansPro: ['Source Sans Pro', 'sans-serif'],
                Montserrat: ['Montserrat', 'sans-serif'],
            },
            colors:{
                "primary": {
                    50: "#EBF5FF",
                    100: "#D6ECFF",
                    200: "#A8D7FF",
                    300: "#80C3FF",
                    400: "#57B0FF",
                    500: "#299BFF",
                    600: "#0089FF",
                    700: "#0067C2",
                    800: "#004480",
                    900: "#002342",
                    950: "#00101F"
                },
                "secondary": {
                    50: "#F1F2F3",
                    100: "#E6E8EA",
                    200: "#CED1D4",
                    300: "#B5BABF",
                    400: "#9CA4AA",
                    500: "#848D95",
                    600: "#6C757D",
                    700: "#50575D",
                    800: "#363B3F",
                    900: "#1A1C1E",
                    950: "#0E0F10"
                },
                "info": {
                    50: "#E8FAFC",
                    100: "#D2F4F9",
                    200: "#A4E9F4",
                    300: "#77DEEE",
                    400: "#4AD3E8",
                    500: "#21C9E3",
                    600: "#17A2B8",
                    700: "#117888",
                    800: "#0B505B",
                    900: "#06282D",
                    950: "#031417"
                },
                "warning": {
                    50: "#FFFAEB",
                    100: "#FFF5D6",
                    200: "#FFEBAD",
                    300: "#FFE085",
                    400: "#FFD65C",
                    500: "#FFCC33",
                    600: "#FFC107",
                    700: "#C79500",
                    800: "#856300",
                    900: "#423200",
                    950: "#1F1700"
                },
                "danger": {
                    50: "#FCEEEF",
                    100: "#F9DCDF",
                    200: "#F4BEC3",
                    300: "#EE9BA3",
                    400: "#E87883",
                    500: "#E25563",
                    600: "#DC3545",
                    700: "#AE1E2C",
                    800: "#75141E",
                    900: "#390A0E",
                    950: "#1E0508"
                },
                "success": {
                    50: "#EAFAEE",
                    100: "#D6F5DD",
                    200: "#ADEBBB",
                    300: "#84E199",
                    400: "#5AD878",
                    500: "#35CF59",
                    600: "#28A745",
                    700: "#1E7B33",
                    800: "#145222",
                    900: "#0A2911",
                    950: "#051509"
                },
                'background-light': '#f4f6f9',
                'background-dark': '#121212',
                'background-semidark': '#191919',
                'surface-dark': '#1e1e1e',
                'backdrop-dark': '#121212d1',
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
