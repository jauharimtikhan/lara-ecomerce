import preset from "./vendor/filament/support/tailwind.config.preset";
/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        "./Modules/Frontend/resources/**/*.blade.php",
        "./Modules/Frontend/resources/**/*.js",
        "./node_modules/flowbite/**/*.js",
        "./vendor/filament/**/*.blade.php",
        "./vendor/awcodes/filament-curator/resources/**/*.blade.php",
        "./vendor/awcodes/filament-quick-create/resources/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: "#fffbeb",
                    100: "#fef3c7",
                    200: "#fde68a",
                    300: "#fcd34d",
                    400: "#fbbf24",
                    500: "#f59e0b",
                    600: "#d97706",
                    700: "#b45309",
                    800: "#92400e",
                    900: "#78350f",
                    950: "#451a03",
                },
            },
        },
    },
    plugins: [require("flowbite/plugin")],
    darkMode: "class",
};
