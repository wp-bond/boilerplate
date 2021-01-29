import { default as config, themeDir, themeUrl } from './vite.config.js'

config.server.port = 3001
config.build.rollupOptions.input = '/wp/admin.js'
config.build.outDir = themeDir + '/dist-wp-admin'
config.base = process.env.APP_ENV === 'development'
  ? '/'
  : themeUrl + '/dist-wp-admin/'

export default config
