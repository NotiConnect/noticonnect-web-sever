
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('notifications', require('./components/Notifications.vue'));

Vue.component('example', require('./components/Example.vue'));
Vue.component('authorizedclients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('clients', require('./components/passport/Clients.vue'));
Vue.component('personalaccesstokens', require('./components/passport/PersonalAccessTokens.vue'));

const app = new Vue({
    el: '#app'
});
