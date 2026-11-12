/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
      extend: {
        fontFamily: {
          sans: ['"Plus Jakarta Sans"', '"Inter"', 'system-ui', '-apple-system', 'sans-serif'],
          display: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
          body: ['"Inter"', 'system-ui', 'sans-serif'],
        },
        colors: {
            primary: {
              light: '#8B5CF6',
              DEFAULT: '#6D28D9', // Vibrant high-velocity brand purple (WCAG AA > 4.5:1)
              dark: '#3B0764',    // Midnight Plum executive anchor (WCAG AAA > 8.5:1)
            },
            secondary: {
              DEFAULT: '#F8FAFC', // Crisp modern slate white
              dark: '#1E293B',    // Slate 800 high-contrast text (> 10:1)
              muted: '#64748B',   // Slate 500 metadata
            },
            accent: {
              amber: '#F59E0B',   // High-velocity express amber
              orange: '#EA580C',
              blue: '#2563EB',
            },
            white: '#FFFFFF',
            body: '#334155',       // Slate 700 text color (WCAG AAA)
            gray: {
              light: '#E2E8F0',    // Slate 200 border
              subtle: '#F1F5F9',   // Slate 100 card fill
            },
            text: {
              DEFAULT: '#1E293B',
              muted: '#64748B',
            },
        },
        animation: {
            'spin-slow': 'spin 3s linear infinite',
            'spin-reverse-slow': 'spin-reverse 3s linear infinite',
        },
        keyframes: {
            'spin-reverse': {
              from: { transform: 'rotate(0deg)' },
              to: { transform: 'rotate(-360deg)' },
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

