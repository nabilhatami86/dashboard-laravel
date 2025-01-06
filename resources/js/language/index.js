import Vue from 'vue';
import VueI18n from 'vue-i18n';
import enMessages from './locales/en.json'; // Sesuaikan dengan path file Anda
import idMessages from '../language/id.json'; // Sesuaikan dengan path file Anda

Vue.use(VueI18n);

const messages = {
    en: enMessages,
    id: idMessages
};

let i18n = new VueI18n({
    locale: window.app.app_date_locale || 'id', // Set locale default
    messages,
    silentTranslationWarn: true
});

new Vue({
    i18n,
    render: h => h(App),
}).$mount('#app');

console.log('Current locale:', i18n.locale);
