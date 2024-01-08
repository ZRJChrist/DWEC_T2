<script setup>
import { ref } from 'vue'


</script>
<template>
    <h1>CRUD VUE</h1>
    <div>
        <!-- inputs -->
    </div>
    <table>
        <thead>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <tr v-for="(item) in items ">

            </tr>
        </tbody>
    </table>
</template>

<style scoped>
#text {
    height: 2em;

}

.agregar {
    margin-left: 1em;
    background-color: green;
}

.delete {
    background-color: red;
}
</style>
