
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
module.exports = {
  content: [
    "./views/**/*.{html,js,php}"],
  theme: {
    extend: {
        fontFamily: {
            sans: ['Figtree', ...defaultTheme.fontFamily.sans],
        },
    },
  },
  plugins: [forms],
}

