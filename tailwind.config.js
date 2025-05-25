import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
// tailwind.config.js
module.exports = {
  content: [
    './resources/js/**/*.vue',
    './resources/views/**/*.blade.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        // nama kelas => [nama font, fallback]
        'sunshiney': ['Sunshiney', 'cursive'],
        'spicy-rice': ['Spicy Rice', 'cursive'],
      },
    },
  },
  plugins: [],
}

