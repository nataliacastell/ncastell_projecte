import forms from '@tailwindcss/forms';

export default {
  content: [
    './resources/views/**/*.blade.php',
    './src/**/*.{html,js}',
  ],
  theme: {
    extend: {
      spacing: {
        '1': '1em',
      },
    },
  },
  plugins: [
    forms,
  ],
};

