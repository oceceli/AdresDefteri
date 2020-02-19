<template>
    <div>
        <contacts-list :endpoint="endpoint"></contacts-list>
    </div>
</template>

<script>
import ContactsList from '../components/ContactsList';
export default {
    components: {
        ContactsList,
    },

    data() {
        return {
            endpoint: '/api/birthdays',
        }
    },
}
</script>