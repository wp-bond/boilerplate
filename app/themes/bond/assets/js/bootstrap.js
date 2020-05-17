// important, will ensure Google can index
// ensure babelrc has browsers > 1%
import 'core-js/stable'

/**
 * GSAP
 */
// import { gsap } from 'gsap'

// // get to the parts that aren't included inside TweenMax
// import ScrollToPlugin from 'gsap/ScrollToPlugin'
// gsap.registerPlugin(ScrollToPlugin)

/**
 * Utils
 */
import { init } from './support/utils'
init()

/**
 * Vue
 */
import Vue from 'vue'
window.Vue = Vue
Vue.config.productionTip = false

/**
 * Axios
 */
import axios from 'axios'
window.axios = axios

// window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Server.csrfToken;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
