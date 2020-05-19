module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
      extend: {
          colors: {
              primary:'#37b1df',
              secondary: '#ffc537',
              tertiary: '#ff5937'
          }
      }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms')
  ]
}
