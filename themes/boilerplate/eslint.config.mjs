// eslint.config.js
import antfu from '@antfu/eslint-config'

// https://github.com/antfu/eslint-config
export default antfu({
  typescript: true,
  vue: true,
  jsonc: false,

  formatters: {
    /**
     * Format CSS, LESS, SCSS files, also the `<style>` blocks in Vue
     * By default uses Prettier
     */
    css: true,
    /**
     * Format HTML files
     * By default uses Prettier
     */
    html: true,
    /**
     * Format Markdown files
     * Supports Prettier and dprint
     * By default uses Prettier
     */
    markdown: 'prettier',
  },
}, {
  rules: {

    // enforce curly braces on all statement
    'curly': ['error', 'all'],

    // prefer 1 attribute per line
    'vue/max-attributes-per-line': ['error', {
      singleline: 2,
      multiline: 1,
    }],
  },
})
