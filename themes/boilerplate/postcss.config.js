
const postcssPresetEnv = require('postcss-preset-env')

module.exports = {

  plugins: [
    postcssPresetEnv({
      stage: 1,
      importFrom: 'src/styles/vars.css',
    }),
  ],

}
