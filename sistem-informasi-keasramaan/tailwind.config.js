module.exports = {
  mode: "jit",
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        login: "#0078C4",
        welcome: "#C4DDFF",
        headWelcome: "#48166C",
        captionWelcome: "#757575",
        petugas: "#7FB5FF",
        iconStudents: "#112B3C",
        cardWelcome: "#EDF6FB",
        templateNav: "#222D32",
        asramaLaki: "#48166C",
        asramaPerempuan: "#0078C4"
      },
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'] 
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}