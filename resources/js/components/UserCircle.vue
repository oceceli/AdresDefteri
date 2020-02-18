<template>
    <div>
        <div class="rounded-full bg-blue-400 w-10 h-10 flex justify-center items-center border border-gray-400 text-white font-bold focus:outline-none">
            {{ userCircle }}
        </div>
    </div>
</template>

<script>
export default {
    props: [
        "name",
    ],

    computed: {
        userCircle: function() {
            return this.name.match(/[A-ZĞİÜŞÖÇ]/g).splice(0,2).join('')
        }
    },
}
</script>