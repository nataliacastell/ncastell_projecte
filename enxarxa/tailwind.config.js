/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    "./src/**/*.{html,js}",
  ],
  theme: {
    extend: {
      spacing: {
        '1': '1em', // Agrega la definición de 1em
      },
    },
  },
  plugins: [],
}

