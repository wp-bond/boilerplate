module.exports = {

  // https://github.com/antfu/eslint-config/tree/master/packages
  extends: '@antfu',

  // update with my preferences
  rules: {
    'curly': ['error', 'all'],
    'brace-style': ['error', '1tbs'],
    'no-restricted-syntax': [
      'error',
      'DebuggerStatement',
      'WithStatement',
    ],
  },
}
