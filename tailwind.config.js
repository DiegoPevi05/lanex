/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
      extend: {
        colors: {
            primary: {
              DEFAULT: '#A55AD9', // Base primary color
              dark: '#5A2982',    // Dark primary color
            },
            secondary: {
              DEFAULT: '#F4EDF6', // Base secondary color
              dark: '#B891D6',    // Dark secondary color
            },
            white: '#FFFFFF',      // White color
            body: '#5C6C7B',       // Dark body color
            gray: {
              light: '#F1F1F1',    // Light gray color
            },
            text: {
              DEFAULT: '#5C6C7B',  // Default text color set to body
            },
        },
      },
  },
  plugins: [
    function ({ addUtilities }) {
      addUtilities({
        '.font-bold': {
          fontWeight: '700',
        },
      });
    },
  ],
}

