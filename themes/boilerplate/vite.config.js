// View your website at your own local server
// for example http://boilerplate.test

// http://localhost:3000 is serving Vite on development
// but accessing it directly will be empty

// IMPORTANT image urls in CSS works fine
// BUT you need to create a symlink on dev server to map this folder during dev
// run in terminal:
// ln -s {path_to_project}/themes/{your_theme}/src/assets {path_to_project}/public/assets
// on production everything will work just fine

import path from 'path'
import { defineConfig, splitVendorChunkPlugin } from 'vite'
import vue from '@vitejs/plugin-vue'
import liveReload from 'vite-plugin-live-reload'

export const themeId = path.basename(__dirname)
export const themePath = path.resolve(__dirname, '../../public/app/themes', themeId)
export const themeDir = `/app/themes/${themeId}`

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    liveReload('(app|config|support|views)/**/*.php', {
      root: __dirname,
    }),
    splitVendorChunkPlugin(),
  ],

  // config
  root: 'src',
  base: process.env.APP_ENV === 'production'
    ? `${themeDir}/dist/`
    : '/',

  build: {
    // output dir for production build
    outDir: `${themePath}/dist`,
    emptyOutDir: true,

    // emit manifest so PHP can find the hashed files
    manifest: true,

    rollupOptions: {
      // our entry
      input: path.resolve(__dirname, 'src/main.js'),
    },
  },

  server: {
    // required to load scripts from custom host
    cors: true,

    // we need a strict port to match on PHP side
    strictPort: true,
    port: 3303,
    // if changed match here /templates/html/vite.php
  },

  // required for in-browser template compilation
  // https://v3.vuejs.org/guide/installation.html#with-a-bundler
  resolve: {
    alias: {
      vue: 'vue/dist/vue.esm-bundler.js',
    },
  },
})
