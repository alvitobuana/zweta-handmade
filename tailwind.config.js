module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        'dark-brown': '#4B2B20',
        'caramel': '#A56A43',
        'cream': '#FFF8F2',
        'soft-beige': '#EAD9CC',
        'dusty-pink': '#D89CA4',
        'sage': '#A3B18A'
      },
      fontFamily: {
        serif: ['Playfair Display', 'serif'],
        sans: ['Poppins', 'ui-sans-serif', 'system-ui']
      }
    }
  },
  plugins: [],
}
