<template>
    <div>
        <div class="flex flex-col relative pb-4">

            <label class="uppercase text-blue-500 pt-2 font-bold text-xs absolute" :for="name">{{ label }}</label>

            <input class="pt-8 w-full outline-none text-gray-900 text-sm border-b border-gray-400 pb-2 focus:border-blue-600 rounded-r-lg rounded-l-sm"  value="test"
            :class="errorClassObject()"
            :placeholder="placeholder" :id="name" type="text" 
            autocomplete="name" 
             v-model="value">

            <p class="text-red-600 text-sm mt-1" v-text="errorMessage()"></p>

        </div>
    </div>
</template>

<script>
export default {
    name: "InputField",

    props: [
        'name', 'label', 'placeholder', 'errors', 'data'
    ],

    methods: {
        updateField: function(){
            this.clearErrorsOnKeyUp(this.name);
            this.$emit('update:field', this.value)
        },

        errorMessage() {
            if (this.hasError) {
                return this.errors[this.name][0];
            }
        },

        clearErrorsOnKeyUp(field) {
            if (this.hasError) {
                return this.errors[field] = null;
            }
        },

        errorClassObject() {
            return {
                'error-field': this.hasError,
            }
        }
    },

    data() {
        return {
            value: ''
        }
    },

    computed: {
        hasError() {
            return this.errors && this.errors[this.name] && this.errors[this.name].length > 0;
        }
    },

    watch: {
        data: function (val) {
            this.value = val;
        },

        value: function () {
            this.updateField();
        }
    },
}
</script>


<style scoped>
    .error-field {
        @apply .border-red-500 .border-b-2
    }
</style>