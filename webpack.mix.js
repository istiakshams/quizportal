const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

//  Common CSS/JS
mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")])
    .sourceMaps();

// Default Theme
mix.js("resources/js/default-theme/app.js", "public/js/default-theme")
    .postCss(
        "resources/css/default-theme/app.css",
        "public/css/default-theme",
        [require("tailwindcss")]
    )
    .sourceMaps();

// Modern Theme
mix.js("resources/js/modern-theme/app.js", "public/js/modern-theme")
    .postCss("resources/css/modern-theme/app.css", "public/css/modern-theme", [
        require("tailwindcss"),
    ])
    .sourceMaps();

// Setup
mix.postCss("resources/css/setup/style.css", "public/css/setup", [
    require("tailwindcss"),
]).sourceMaps();

// Backend Custom CSS/JS
mix.js("resources/js/backend/app.js", "public/js/backend");
