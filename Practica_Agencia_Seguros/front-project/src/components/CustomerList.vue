<script setup>
defineProps({
    customers: Array,
});
</script>
<template>
    {{ customers }}
    <div class="w-full border-spacing-2 p-5">
        <div class="">
            <div class="flex w-full uppercase font-bold text-center">
                <div class="px-6 py-3 w-4/12 ">
                    <span class="bg-stone-400 px-5 py-0.5 rounded-xl">Inf Contact</span>
                </div>
                <div class="px-6 py-3 w-4/12">
                    <span class="bg-stone-400 px-5 py-0.5 rounded-xl">Inf Localization</span>
                </div>
                <div class="px-6 py-3 w-3/12">
                    <span class="bg-stone-400 px-5 py-0.5 rounded-xl">Type</span>
                </div>
                <div class="px-6 py-3 w-3/12">
                    <span class="bg-stone-400 px-5 py-0.5 rounded-xl">Actions</span>
                </div>
            </div>
            <slot name="body"></slot>

        </div>
    </div>
</template>