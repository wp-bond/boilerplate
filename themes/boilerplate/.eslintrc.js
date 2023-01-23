module.exports = {

  // https://github.com/antfu/eslint-config/tree/master/packages
  extends: '@antfu',

  // update with my preferences
  rules: {
    'curly': ['error', 'all'],
    'vue/component-tags-order': 'off',
    'vue/max-attributes-per-line': ['error', {
      singleline: 1,
      multiline: 1,
    }],
  },
}
