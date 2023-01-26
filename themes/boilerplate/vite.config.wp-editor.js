import path from 'path'
import config, { themeDir, themePath } from './vite.config.js'

config.base = `${themeDir}/dist-wp-editor/`
config.build.outDir = `${themePath}/dist-wp-editor`
config.build.rollupOptions.input = path.resolve(__dirname, 'src/wp/editor.js')

// not needed, we just want the css
delete config.plugins

// Note: live reload doesn't work in this case
// use build watch and refresh the WP admin manually after build

export default config
