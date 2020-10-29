import { default as config, themeDir, themeUrl } from './vite.config.js'

export default {
  ...config,
  port: 3001,
  entry: 'vite/wp/admin.js',
  outDir: themeDir + 'dist-wp-admin',
  base: themeUrl + 'dist-wp-admin'
}
