import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                steelblue: "#1360aa",
                white: "#fff",
                darksalmon: "#cc927a",
                darkgray: "#a7acaf",
                gray: "#fdfdfd",
                black: "#000",
                powderblue: "#bbdce1",
                whitesmoke: "#f2f2f4",
                cornflowerblue: "#1b84d9",
                lavender: "#f4edfd",
                customBlue: 'rgba(19, 96, 170, 1)',
                customGreen: 'rgba(187, 220, 225, 1)',
            },
            spacing: {},
            fontFamily: {
                alice: "Alice",
                "alfa-slab-one": "'Alfa Slab One'",
            },
            borderRadius: {
                xl: "20px",
                "3xs": "10px",
                mini: "15px",
            },
        },
        fontSize: {
            base: "1rem",
            inherit: "inherit",
        },
    },
    corePlugins: {
        preflight: false,
    },

    plugins: [
        require('@tailwindcss/forms'),
        forms
    ],
};
