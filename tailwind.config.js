import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', 'sans-serif'],
                sunshiney: ['Sunshiney', 'cursive'],
                spicy: ['Spicy Rice', 'cursive'],
                stalemate: ['Stalemate', 'cursive'],
            },
            fontSize: {
                sm: '14px',
                base: '16px',
                lg: '24px',
                xl: '30px',
                '2xl': '32px',
                '3xl': '40px',
            },
            fontWeight: {
                light: '300',
                normal: '400',
                medium: '500',
                semibold: '600',
                bold: '700',
            },
            colors: {
                'soft-blue': '#DBDDF5',          // 50% bisa kamu gunakan di opacity atau bg-opacity
                'purple-700': '#301B54',
                'yellow-500': '#F5C92A',
                'white': '#FFFFFF',
                'purple-300': '#816EA3',
                'purple-400': '#695191',
                'purple-800': '#373155',
                'dark-blue': '#252C83',          // kode 04: 252C83
                'light-purple-600': '#5B518D',   // light purple 600
                'purple-600': '#3D236B',
                'black': '#000000',
                'purple-06': '#4D55CC',          // nama unik karena tidak cocok dengan skala tailwind default
                'blue-11': '#EFF0FA',            // kode 11: EFF0FA
            },
        },
    },

    plugins: [forms],
};
