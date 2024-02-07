<script setup>
import { RouterLink } from 'vue-router'

defineProps({
    name: String,
    NameUrl: String,
});
</script>

<template>
    <li>
        <RouterLink class="py-2 px-3 font-medium text-black hover:text-green-700 " :to="{ name: NameUrl }">{{
            name }}</RouterLink>
    </li>
</template>