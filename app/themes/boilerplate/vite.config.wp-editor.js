import { default as config, themeDir, themeUrl } from './vite.config.js'

config.server.port = 3001
config.build.rollupOptions.input = '/wp/editor.js'
config.build.outDir = themeDir + '/dist-wp-editor'
config.base = process.env.APP_ENV === 'development'
  ? '/'
  : themeUrl + '/dist-wp-editor/'

export default config
