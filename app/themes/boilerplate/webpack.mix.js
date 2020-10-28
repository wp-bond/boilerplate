let mix = require('laravel-mix')

// set base path
let themePath = path.normalize('../../../html/app/themes/bond')
mix.setPublicPath(themePath)

// options
mix.options({
  processCssUrls: false
})
// disable mac notitifications
mix.disableNotifications()

// scripts
mix.js('assets/js/app.js', 'js')

// vendor scripts
mix.extract([
  'vue',
  'axios'
])

// styles
mix.sass('assets/sass/app.scss', 'css/')
mix.sass('assets/sass/admin.scss', 'css/')
mix.sass('assets/sass/editor.scss', 'css/')

// cache busting
mix.version()

// browser sync
// https://browsersync.io/docs/options
if (!mix.inProduction()) {
  mix.browserSync({
    proxy: 'boilerplate.test',
    notify: false,
    files: [
      'app/**/*.php',
      'config/*.php',
      'views/**/*.php',
      '../../../html/app/themes/**/*.js',
      '../../../html/app/themes/**/*.css'
    ]
  })
}
