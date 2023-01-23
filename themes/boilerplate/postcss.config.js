const postcssPresetEnv = require('postcss-preset-env')

module.exports = {

  plugins: [
    postcssPresetEnv({
      features: {
        'custom-properties': {
          disableDeprecationNotice: true,
        },
      },
      stage: 1,
      importFrom: 'src/styles/vars.css',
    }),
  ],

}
