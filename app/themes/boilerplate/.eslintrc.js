module.exports = {
  env: {
    browser: true,
    es2021: true,
  },
  parserOptions: {
    ecmaVersion: 12,
    sourceType: 'module',
  },
  extends: [
    // add more generic rulesets here, such as:
    'eslint:recommended',
    'plugin:vue/vue3-recommended',
  ],
  plugins: ['vue'],
  rules: {
    indent: ['error', 2, { SwitchCase: 1 }],
    'linebreak-style': ['error', 'unix'],
    quotes: ['error', 'single'],
    semi: ['error', 'never'],
    'comma-dangle': ['error', 'always-multiline'],
    'vue/no-v-html': 0,

    // TEMP
    // these exist to match somewhat the buggy vue formatter
    'vue/html-self-closing': 0,
    'vue/singleline-html-element-content-newline': 0,
    'vue/multiline-html-element-content-newline': 0,
    'vue/max-attributes-per-line': [
      'error',
      {
        singleline: {
          max: 9999,
          allowFirstLine: true,
        },
        multiline: {
          max: 1,
          allowFirstLine: false,
        },
      },
    ],
  },
}
