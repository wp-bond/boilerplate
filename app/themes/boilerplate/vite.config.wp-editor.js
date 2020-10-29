import { default as config, themeDir, themeUrl } from './vite.config.js'

export default {
  ...config,
  entry: 'vite/wp/editor.js',
  outDir: themeDir + 'dist-wp-editor',
  base: themeUrl + 'dist-wp-editor'
}
