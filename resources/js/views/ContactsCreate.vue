<template>
    <div>
        <form @submit.prevent="submitForm()">
            
            <div v-for="(input, index) in inputs" :key="index">
                <input-field :name="input.name" :label="input.label" :placeholder="input.placeholder" :errors="errors" 
                @update:field="form[input.name] = $event"></input-field>
            </div>

            <div class="flex justify-end">
                <button class="focus:outline-none bg-white px-4 py-2 text-red-700 border rounded border-gray-300 text-sm mr-5 hover:border-red-700">Vazgeç</button>
                <button class="bg-blue-500 px-4 py-2 text-white text-sm rounded focus:outline-none hover:bg-blue-400">Kişiyi Kaydet</button>
            </div>
        </form>
    </div>
</template>

<script>
import InputField from '../components/InputField';
export default {
    name:"ContactsCreate",
    components: {
        InputField,
    },
    data() {
        return {
            inputs: [
                {"name":"name", "label":"Ad", "placeholder":"Bağlantı Adı"},
                {"name":"email", "label":"E-Posta", "placeholder":"E-Posta Adresi"},
                {"name":"company", "label":"Firma", "placeholder":"Firma Adı"},
                {"name":"birthday", "label":"Doğum Tarihi", "placeholder":"gg/aa/yyyy"},
            ],

            form: {},
            response: {},
            errors: null,
        }
    },


    created() {
        this.setNameAttributeAsFormKey();
    },

    methods: {
        setNameAttributeAsFormKey() {
            for(let i = 0; i < this.inputs.length; i++){
                this.form[this.inputs[i].name] = '';
            }
        },

        submitForm() {
            axios.post('/api/contacts', this.form)
                .then(response => {
                    this.response = response.data.links;
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors;
                });
        }
    },
}
</script>

<style scoped>
    
</style>