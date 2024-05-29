import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            /*Creamos colores y alturas personalizadas*/
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            height:{
                "10v":"10vh",
                "15v":"15vh",
                "65v":"65vh",
            },
            colors:{
                "principal":"#FF5E3A",
                "texto":"#232323",
                "fondo":"#EBEBEB",
                "footer":"#145A84"
            },
	    witdh:{
		"95":"95%"
		}

        },
    },
    /*Añadimos el plugin de daisyui*/
    plugins: [forms, require("daisyui")],
};
