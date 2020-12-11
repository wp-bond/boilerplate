
// View your website at your own local server
// for example http://boilerplate.test

// http://localhost:3000 is serving Vite on development
// but accessing it directly will be empty

export const themeDir = '../../../html/app/themes/boilerplate/'
export const themeUrl = '/app/themes/boilerplate/'

export default {

  // our entry file
  entry: 'vite/index.js',

  // output dir for production build
  outDir: themeDir + 'dist',
  base: themeUrl + 'dist',

  // emit manifest so PHP can find the hashed files
  emitManifest: true,

  // required to load scripts from custom host
  cors: true,

  // esbuild is faster but creates slight larger files
  // test and choose with you prefer
  minify: 'esbuild', // terser (default) | esbuild

  // es target
  esbuildTarget: 'es2018',

  // required for in-browser template compilation
  // https://v3.vuejs.org/guide/installation.html#with-a-bundler
  alias: {
    vue: "vue/dist/vue.esm-bundler.js"
  }

  // Dev server host name
  // ON HOLD
  // Vite still is not creating more than one server in the same port with different hostnames
  // if Vite provides that in the future, we may change here
  // That way, each project would have its own Vite client with a fixed port, safe that it will not change

  // For now, you can have 2 Vite projects running in parallel

  // hostname: 'boilerplate.test',
  // port: 3000,
}
