var elixir = require('laravel-elixir');
require('laravel-elixir-apidoc');

elixir(function(mix) {
    mix
        .sass([ // Process front-end stylesheets
                'frontend/main.scss',
                'frontend/jasny_bootstrap/jasny-bootstrap.scss'
            ], 'resources/assets/css/frontend')
        .styles([  // Combine pre-processed CSS files
                'frontend/styles.css',
                'frontend/main.css',
                'frontend/jasny-bootstrap.css'
            ], 'public/css/frontend.css', 'resources/assets/css')
        .scripts([ // Combine front-end scripts
                'plugins.js',
                'frontend/main.js'
            ], 'public/js/frontend.js', 'resources/assets/js')

        .sass([ // Process back-end stylesheets
            'backend/main.scss',
            'backend/skin.scss'
        ], 'resources/assets/css/backend')
        .styles([ // Combine pre-processed CSS files
                'bootstrap.css',
                'font-awesome.css',
                'backend/main.css',
                'backend/skin.css'
            ], 'public/css/backend.css', 'resources/assets/css')
        .scripts([ // Combine back-end scripts
                'plugins.js',
                'backend/main.js'
            ], 'public/js/backend.js', 'resources/assets/js')

        // Copy webfont files from /vendor directories to /public directory.
        .copy('vendor/fortawesome/font-awesome/fonts', 'public/fonts')
        .copy('vendor/twbs/bootstrap-sass/assets/fonts/bootstrap', 'public/fonts')

        // Apply version control
        .version(["css/frontend.css", "js/frontend.js", "css/backend.css", "js/backend.js"])

        .apidoc({
            src: "app/Http/Routes/API/",
            dest: "docs/api",
            debug: true
        });
});