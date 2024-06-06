const mix = require("laravel-mix");
// require("dotenv").config();

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [

    ]);


mix.options({
    hmrOptions: {
        host: 'localhost',
        port: 9090
    }
})