/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.{blade.php,js,vue,ts,jsx,tsx}",
    ],
    theme: {
        extend: {
            colors: {
                'green-500': '#10b981', // Une couleur personnalisée pour le statut 'Confirmée'
                'yellow-500': '#f59e0b', // Une couleur personnalisée pour 'En attente'
                'red-500': '#ef4444', // Une couleur personnalisée pour 'Annulée'
                'blue-500': '#3b82f6', // Une couleur personnalisée pour 'En cours'
            },
        },
    },
    plugins: [],
}
