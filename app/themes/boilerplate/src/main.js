import 'vite/dynamic-import-polyfill'
import { createApp } from 'vue'

// Styles
import './style'

// in-DOM HTML Components
import HelloWorld from './components/HelloWorld.vue'

for (const el of document.getElementsByClassName('vue-app')) {
  createApp({
    components: {
      HelloWorld
      // add more if needed
    },
    template: el.innerHTML
  }).mount(el)
}
