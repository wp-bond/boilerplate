import { default as config, themePath, themeDir } from './vite.config.js'

config.build.rollupOptions.input = '/wp/editor.js'
config.build.outDir = themePath + '/dist-wp-editor'
config.base = themeDir + '/dist-wp-editor/'

// not needed, we just want the css
delete config.plugins

// Note: live reload doesn't work in this case
// use build watch and refresh the WP admin manually after build

export default config
