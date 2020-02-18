<template>
    <div>
        <div v-if="is_loading">Yükleniyor...</div>
        <div v-else>
            <div v-if="response.length === 0">
                <p>Burada kimsecikler yok... Hadi birilerini <router-link to="/contacts/create" class="font-bold text-blue-600">ekle</router-link> :)</p>
            </div>
            <router-link v-else :to="'/contacts/'+ item.data.contact_id" v-for="(item, index) in response" :key="index" class="flex items-center border-b border-gray-400 pb-3 pt-3 hover:bg-gray-100"> 
                <button class="hover:opacity-75 z-10" title="Düzenle">
                    <user-circle :name="item.data.name"></user-circle>
                </button>
                <div class="ml-4 flex flex-col">
                    <a href="" class="text-blue-400 font-bold hover:opacity-75">{{ item.data.name }}</a>
                    <p class="text-gray-600 hover:opacity-75">{{ item.data.email }}</p>
                </div>
            </router-link>
        </div>
        
    </div>
</template>


<script>
import UserCircle from '../components/UserCircle';
export default {
    components: {
        UserCircle,
    },

    data() {
        return {
            response: {},
            is_loading: true,
        }
    },

    mounted() {
        axios.get('/api/contacts')
            .then(response => {
                this.response = response.data.data;
                this.is_loading = false;
            })
            .catch(error => {
                alert('Bir hata oluştu!');
                this.is_loading = false;
            });
    },

    
}
</script>