
require('./bootstrap');

window.Vue = require('vue');


import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyCXADB2GdqwtUw-emf1l5R77bh1sVNMo8k',
      libraries: 'places', //// If you need to use place input 
    }
  })


Vue.component('location', require('./components/Location.vue'));

const app = new Vue({
    el: '#app'
});
