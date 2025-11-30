/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
 
try {
    const VeeValidate = require('vee-validate');
    Vue.use(VeeValidate);
} catch (e) {
    console.warn('VeeValidate not available, continuing without it');
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('stockdetails', require('./components/Stockdetails.vue'));
Vue.component('serialadd', require('./components/Serialadd.vue'));
const app = new Vue({
    el: '#app',
    data: {
        host: window.laravelObj ? window.laravelObj.appHost + '/' : '/',
        division_id: '',
        district_id: '',
        districts: [],
        thanas: [],
        thana_id: '',
        region_id: '',
        areas: [],
        area_id: '',
        isDistributor: false,
        cvb1: '',
        cvb2: '',
        cvb3: '',
        cvb4: ''
    },
    methods: {        
        getDistricts: function(e) {
            this.districts = [];
            this.thanas = [];
            this.thana_id = '';
            
            var divisionId = e && e.target ? e.target.value : e;
            if (!divisionId) return;
            
            axios.post(this.host + 'get-district', { 
                division_id: divisionId 
            }, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                this.districts = response.data;
            })
            .catch(error => {
                console.error('Error fetching districts:', error);
                alert('Error fetching districts');
            });
        },
        
        getThanas: function(e) {
            this.thanas = [];
            this.thana_id = '';
            
            var districtId = e && e.target ? e.target.value : e;
            if (!districtId) return;
            
            axios.post(this.host + 'get-thanas', { 
                district_id: districtId 
            }, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                this.thanas = response.data;
            })
            .catch(error => {
                console.error('Error fetching thanas:', error);
                alert('Error fetching Thanas');
            });
        },
        
        getAreas: function(e) {
            this.areas = [];
            var regionId = e && e.target ? e.target.value : e;
            if (!regionId) return;
            
            axios.post(this.host + 'get-areas', { 
                region_id: regionId 
            }, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                this.areas = response.data;
            })
            .catch(error => {
                console.error('Error fetching areas:', error);
                alert('Error fetching Areas');
            });
        }
    },
    
    mounted: function () {
        console.log('Vue app mounted');
        
        // Initialize with old values
        if (window.laravelObj) {
            console.log('laravelObj found:', window.laravelObj);
            
            this.division_id = window.laravelObj.division_id || '';
            this.district_id = window.laravelObj.district_id || '';
            this.thana_id = window.laravelObj.thana_id || '';
            this.region_id = window.laravelObj.region_id || '';
            this.area_id = window.laravelObj.area_id || '';
            
            this.districts = window.laravelObj.districts || [];
            this.thanas = window.laravelObj.thanas || [];
            this.areas = window.laravelObj.areas || [];
            
            // Set other properties if they exist
            if (window.laravelObj.isDistributor !== undefined) {
                this.isDistributor = Boolean(Number(window.laravelObj.isDistributor));
            }
            
            this.cvb1 = window.laravelObj.cvb1 || '';
            this.cvb2 = window.laravelObj.cvb2 || '';
            this.cvb3 = window.laravelObj.cvb3 || '';
            this.cvb4 = window.laravelObj.cvb4 || '';
        } else {
            console.warn("laravelObj not found in window");
        }
    }
});

window.vueApp = app;