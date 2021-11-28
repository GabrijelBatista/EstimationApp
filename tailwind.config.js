module.exports = {
    purge: [     './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',],
    darkMode: false,
    theme: {
        extend: {
            backgroundImage: theme => ({
                //'hero-lg': "url('https://gmcgregor.ca/static/06d3383234b0e417b49e7ce29ec7d073/2b872/image-918.jpg')",
            }),
            colors: {
                'white': '#ffffff',
                'gray-lightest': '#f9f8f8',
                'gray-lighter': '#e5e4e5',
                'gray-light': '#d1d0d1',
                'gray': '#bebdbe',
                'gray-dark': '#979697',
                'gray-darker': '#6f6e6f',
                'gray-darkest': '#484848',
                'black': '#212021',

                'brand': '#343a40',
                'brand-light': '#f8f9fa',
                'brand-dark': '#212529',

                'cta': '#e9ecef',
                'cta-light': '#e9f5db',
                'cta-dark': '#dee2e6',

                'info-light': '#dbedf7',
                'info': '#5bb7df',
                'info-dark': '#335869',

                'warning-light': '#fdeccf',
                'warning': '#FFA500',
                'warning-dark': '#FF8C00',

                'success-light': '#daf1d4',
                'success': '#5ec554',
                'success-dark': '#335e2d',

                'danger-light': '#ffd0cf',
                'danger': '#e12e4d',
                'danger-dark': '#6c2128',
            }
        },
    },
    variants: {
        extend: {

        },
    },
    plugins: [],
}
