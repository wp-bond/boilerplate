import path from 'path'
import config, { themeDir, themePath } from './vite.config.js'

config.base = process.env.APP_ENV === 'production'
  ? `${themeDir}/dist-wp-admin/`
  : '/'
config.build.outDir = `${themePath}/dist-wp-admin`
config.build.rollupOptions.input = path.resolve(__dirname, 'src/wp/admin.js')
config.server.port = 3001

export default config
