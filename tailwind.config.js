import defaultTheme from 'tailwindcss/defaultTheme';
import colors from 'tailwindcss/colors';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.vue',
        './resources/**/*.js',
    ],

    theme: {
        colors: {
            onyx: {
                100: '#8e8e8e',
                200: '#7c7c7c',
                300: '#696969',
                400: '#565656',
                500: '#444444',
                600: '#373737',
            },
            deep_peach: {
                100: '#ffffff',
                200: '#fef3eb',
                300: '#fee9d8',
                400: '#fee0c7',
                500: '#fed4b2',
                600: '#fecea8',
            },
            congo_pink: {
                100: '#ffffff',
                200: '#ffe5e3',
                300: '#ffcac6',
                400: '#ffb0aa',
                500: '#ff958e',
                600: '#ff847c',
            },
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            blue: colors.blue,
            cyan: colors.cyan,
            emerald: colors.emerald,
            fuchsia: colors.fuchsia,
            neutral: colors.neutral,
            slate: colors.slate,
            gray: colors.gray,
            stone: colors.stone,
            green: colors.green,
            indigo: colors.indigo,
            lime: colors.lime,
            orange: colors.orange,
            pink: colors.pink,
            purple: colors.purple,
            red: colors.red,
            rose: colors.rose,
            sky: colors.sky,
            teal: colors.teal,
            violet: colors.violet,
            yellow: colors.amber,
            white: colors.white,
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
