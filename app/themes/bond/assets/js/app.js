import './bootstrap'
import Vue from 'vue'

// components
import NewsletterForm from './components/NewsletterForm'

// initialize
const appContainers = document.getElementsByClassName('vue-app')
for (const el of appContainers) {
  new Vue({
    el,
    components: {
      NewsletterForm
    }
  })
}
