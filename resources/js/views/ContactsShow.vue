<template>
    <div>
        <div v-if="loading">Yükleniyor...</div>
        <div v-else>
            <div class="flex justify-between py-3 items-center">
                <button @click="$router.back()" class="text-blue-600 text-sm">< Geri Git</button>
                <div class="relative">

                    <router-link :to="'/contacts/' + contact.contact_id + '/edit'"
                    class="mr-2 px-4 py-2 text-green-500 border border-green-500 text-sm font-bold rounded">Düzenle</router-link>

                    <a href="#" class="px-4 py-2 text-red-500 border border-red-500 text-sm font-bold rounded" @click="modal = ! modal">Sil</a>
                    <div v-if="modal" class="p-8 w-64 bg-blue-900 rounded-lg text-white text-sm absolute z-20 right-0 mt-2">
                        <p>Silmek istediğinize emin misiniz?</p>
                        <div class="flex justify-end pt-4 items-center">
                            <button class="bg-red-500 text-white text-xs font-bold rounded py-2 px-4 mr-4" @click="destroy">Sil</button>
                            <button @click="modal = ! modal">Vazgeç</button>
                        </div>
                    </div>
                </div>
                <div v-if="modal" @click="modal = false" class="bg-black opacity-25 absolute right-0 left-0 top-0 bottom-0 z-10"></div>
            </div>
            <div class="flex items-center">
                <user-circle :name="contact.name"></user-circle>
                <h2 class="ml-2 font-bold text-xl text-black">{{ contact.name }}</h2>
            </div>

            <div class="mt-6">
                <h1></h1>
                <p class="uppercase text-xs font-bold text-gray-600">İletişim</p>
                <p class="text-blue-400 mt-1 text-sm">{{ contact.email }}</p>
                <p class="uppercase text-xs font-bold text-gray-600 mt-4">Firma</p>
                <p class="text-blue-400 mt-1 text-sm">{{ contact.company }}</p>
                <p class="uppercase text-xs font-bold text-gray-600 mt-4">Doğum Tarihi</p>
                <p class="text-blue-400 mt-1 text-sm">{{ contact.birthday }}</p>
            </div>    
        </div>

    </div>
</template>

<script>
import List from '../components/List';
import UserCircle from '../components/UserCircle';
export default {
    components: {
        UserCircle,
    },
    name: "ContactsShow",

    mounted() {
        axios.get('/api/contacts/' + this.$route.params.id)
            .then(response => {
                this.contact = response.data.data;
                this.loading = false;
            })
            .catch(error => {
                this.error = error; 
                this.loading = false;
                if(error.response.status = '404'){
                    this.$router.push('/contacts');
                }
            });
    },

    data() {
        return {
            contact: {},
            error: {},
            loading: true,

            modal: false,


        }
    },

    methods: {
        destroy() {
            axios.delete('/api/contacts/' + this.$route.params.id)
                .then(response => {
                    this.$router.push('/contacts');
                })
                .catch(error => {
                    console.log("Bir hata ile karşılaşıldı: " + error);
                });
        }
    },
}
</script>

<style scoped>

</style>