module.exports = {
  extends: [
    'stylelint-config-standard',
    // 'stylelint-config-recommended-vue',
  ],

  rules: {
    'rule-empty-line-before': null,
  },

  overrides: [
    {
      files: [
        '**/*.vue',
      ],
      customSyntax: 'postcss-html',
    },
  ],
}
