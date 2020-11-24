import { createApp } from 'vue'

// Styles
import './style'

// in-DOM HTML Components
import HelloWorld from './components/HelloWorld.vue'

for (const el of document.getElementsByClassName('vue-app')) {
  createApp({
    template: el.innerHTML,
    components: {
      HelloWorld
      // add more if needed
    }
  }).mount(el)
}
