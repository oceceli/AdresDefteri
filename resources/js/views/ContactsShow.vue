<template>
    <div>
        <div class="flex justify-between py-3 items-center">
            <router-link to="#" class="text-blue-600 text-sm">< Geri Git</router-link>
            <div>

                <router-link :to="'/contacts/' + contact.contact_id + '/edit'"
                class="mr-2 px-4 py-2 text-green-500 border border-green-500 text-sm font-bold rounded">Düzenle</router-link>

                <a href="#" 
                class="px-4 py-2 text-red-500 border border-red-500 text-sm font-bold rounded">Sil</a>
                
            </div>
        </div>
        <div class="flex items-center">
            <user-circle :name="contact.name"></user-circle>
            <h2 class="ml-2 font-bold text-xl text-black">{{ contact.name }}</h2>
        </div>
        <div class="mt-5">
            <list :lists="contact"></list> 
        </div>
    </div>
</template>

<script>
import List from '../components/List';
import UserCircle from '../components/UserCircle';
export default {
    components: {
        List, UserCircle,
    },
    name: "ContactsShow",

    mounted() {
        axios.get('/api/contacts/' + this.$route.params.id)
            .then(response => {
                this.contact = response.data.data;
            })
            .catch(error => {
                this.error = error; 
            });
    },

    data() {
        return {
            contact: {},
            error: {},
        }
    },
}
</script>

<style scoped>

</style>