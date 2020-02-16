<template>
    <div>
        <div class="mb-4" v-for="(value, key, index) in lists" :key="index">
            <h1></h1>
            <p class="uppercase text-xs font-bold text-gray-600">{{key}}</p>
            <p class="text-blue-400 mt-1 text-sm">{{ value }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'lists',
    ],
}
</script>