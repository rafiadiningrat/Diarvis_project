/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: "jit",
  content: [
    "./src/**/*.{js,jsx,ts,tsx}",
    "node_modules/flowbite-react/**/*.{js,jsx,ts,tsx}",
  ],
  theme: {
    extend: {
      fontFamily: {
        poppins: "Poppins",
        kaushan: "Kaushan Script",
      },
      fontSize: {
        "2xs": "0.75rem",
      },
    },
  },
  plugins: [
    require("daisyui"), 
    require("flowbite/plugin")
  ],
};
