<template>
    <div>
        <div class="relative z-20">
            <div class="absolute">
                <svg viewBox="0 0 24 24" class="w-5 h-5 mt-2 ml-2">
                    <path fill-rule="evenodd" d="M20.2 18.1l-1.4 1.3-5.5-5.2 1.4-1.3 5.5 5.2zM7.5 12c-2.7 0-4.9-2.1-4.9-4.6s2.2-4.6 4.9-4.6 4.9 2.1 4.9 4.6S10.2 12 7.5 12zM7.5.8C3.7.8.7 3.7.7 7.3s3.1 6.5 6.8 6.5c3.8 0 6.8-2.9 6.8-6.5S11.3.8 7.5.8z" clip-rule="evenodd"/>
                </svg>
            </div>
            <input type="text" placeholder="Ara..." id="searchTerm" v-model="searchTerm" @input="search" @focus="focus = true"
                class="w-64 mr-6 pl-8 pr-3 py-1 text-sm focus:border-blue-500 focus:shadow focus:bg-gray-100 focus:outline-none border border-gray-400 rounded-full bg-gray-200 text-black">

            <div v-if="focus" class="absolute bg-blue-900 text-white rounded-lg p-4 w-96 right-0 mr-6 mt-2 shadow z-20 overflow-y-visible">
                <div v-if="results == 0">{{ searchTerm }} için bir sonuç bulunamadı!</div>
                <div v-else v-for="(result, index) in results" :key="index" @click="focus = false">
                    <router-link :to="result.links.self" class="block py-2 hover:bg-blue-800 rounded-lg p-4">
                        <div class="flex items-center">
                            <user-circle :name="result.data.name"></user-circle>
                            <div class="pl-3">
                                <p>{{ result.data.name }}</p>
                                <p>{{ result.data.company }}</p>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
        <div v-if="focus" @click="focus = false" class="bg-black right-0 left-0 top-0 bottom-0 z-10 absolute opacity-25"></div>
    </div>
</template>

<script>
import _ from 'lodash';
import UserCircle from './UserCircle';
export default {

    components: {
        UserCircle,
    },

    data() {
        return {
            searchTerm: '',
            results: [],
            focus: false,
        }
    },

    methods: {
        search: _.debounce(function(e){
            if(this.searchTerm.length < 3) return;
            axios.post('/api/search', {searchTerm: this.searchTerm})
                    .then(response => {
                        this.results = response.data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
        }, 300)
    },
}
</script>