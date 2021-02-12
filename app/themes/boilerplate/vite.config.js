// View your website at your own local server
// for example http://boilerplate.test

// http://localhost:3000 is serving Vite on development
// but accessing it directly will be empty

// IMPORTANT image urls in CSS works fine
// BUT you need to create a symlink on dev server to map this folder during dev
// ln -s {path_to_project}/app/themes/boilerplate/src/assets {path_to_project}/html/assets
// on production everything will work just fine

import vue from '@vitejs/plugin-vue'
import legacy from '@vitejs/plugin-legacy'
import liveReload from 'vite-plugin-live-reload'
const { resolve } = require('path')

export const themeDir = resolve(__dirname, '../../../html/app/themes/boilerplate')
export const themeUrl = '/app/themes/boilerplate'

// https://vitejs.dev/config
export default {
  plugins: [
    vue(),
    legacy({
      targets: ['defaults', 'not IE 11']
    }),
    liveReload(themeDir+'/(app|config|support|views)/**/*.php')
  ],

  // config
  root: 'src',
  base: process.env.APP_ENV === 'development'
    ? '/'
    : themeUrl + '/dist/',

  build: {
    // output dir for production build
    outDir: themeDir + '/dist',
    emptyOutDir: true,

    // emit manifest so PHP can find the hashed files
    manifest: true,

    // esbuild target
    target: 'es2018',

    rollupOptions: {
      // our entry
      input: '/main.js'
    }
  },

  server: {
    // required to load scripts from custom host
    cors: true,

    // we need a strict port to match on PHP side
    //
    strictPort: true,
    port: 3000
    // if changed match here /templates/html/vite.php
  },


  // required for in-browser template compilation
  // https://v3.vuejs.org/guide/installation.html#with-a-bundler
  resolve: {
    alias: {
      vue: 'vue/dist/vue.esm-bundler.js'
    }
  }
}
