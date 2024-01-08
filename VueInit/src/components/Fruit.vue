<script setup >

defineProps({
    id: Number,
    name: String,
    num: Number,
})

</script>

<template>
    <td>{{ id }}</td>
    <td>{{ name }}</td>
    <td>{{ num }}</td>
</template>

<style scoped></style>
