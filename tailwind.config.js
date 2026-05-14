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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                surface: '#F8FAFC',
                sidebar: '#1E293B',
                foreground: '#0F172A',
                primary: '#4F46E5',
                danger: '#E11D48',
                divider: '#E2E8F0',
            },
        },
    },

    plugins: [forms],
};
