import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from "./components/ExampleComponent";
import ContactsCreate from "./views/ContactsCreate";
import ContactsShow from "./views/ContactsShow";
import ContactsEdit from "./views/ContactsEdit";
import ContactsIndex from "./views/ContactsIndex";
import BirthdaysIndex from './views/BirthdaysIndex';
import Logout from './Actions/Logout';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { 
            path: '/', component: ContactsIndex, 
            meta: { title: "Bağlantılarım" },
        },
        { 
            path: '/contacts', component: ContactsIndex,
            meta: { title: "Bağlantılarım" },
        },
        { 
            path: '/contacts/create', component: ContactsCreate, 
            meta: { title: "Yeni Bağlantı Oluştur" },
        },
        { 
            path: '/contacts/:id', component: ContactsShow,
            meta: { title: "Ayrıntılar" },
        },
        { 
            path: '/contacts/:id/edit', component: ContactsEdit,
            meta: { title: "Bağlantıyı Düzenle" },
        },
        { 
            path: '/birthdays', component: BirthdaysIndex,
            meta: { title: "Doğum Günleri: Bu ay" },
        },
        { 
            path: '/logout', component: Logout,
        },
    ],
    mode: 'history'
});