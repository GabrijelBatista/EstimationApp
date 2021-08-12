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
            animation: {
                //'bounce-custom': 'bounce 1.5s linear',
            }
        },
    },
    variants: {
        extend: {

        },
    },
    plugins: [],
}
