import postcssGlobalData from '@csstools/postcss-global-data'
import postcssPresetEnv from 'postcss-preset-env'

export default {

  plugins: [
    postcssGlobalData({
      files: [
        './src/styles/vars.css',
      ],
    }),
    postcssPresetEnv({
      stage: 1,
    }),
  ],

}
