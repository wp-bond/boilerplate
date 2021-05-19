import { default as config, themePath, themeDir } from './vite.config.js'

config.server.port = 3001
config.build.rollupOptions.input = '/wp/admin.js'
config.build.outDir = themePath + '/dist-wp-admin'
config.base = process.env.APP_ENV === 'development'
  ? '/'
  : themeDir + '/dist-wp-admin/'

export default config
