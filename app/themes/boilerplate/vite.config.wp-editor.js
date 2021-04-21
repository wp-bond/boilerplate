import { default as config, themeDir, themeUrl } from './vite.config.js'

config.build.rollupOptions.input = '/wp/editor.js'
config.build.outDir = themeDir + '/dist-wp-editor'
config.base = themeUrl + '/dist-wp-editor/'

// not needed, we just want the css
delete config.plugins

// Note: live reload doesn't work in this case
// have to refresh the WP admin manually after build

export default config
