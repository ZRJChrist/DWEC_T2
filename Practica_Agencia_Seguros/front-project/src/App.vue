<script setup>
import { RouterView } from 'vue-router'
import RouterLinkNav from '@/components/RouterLinkNav.vue';
import NavBar from '@/components/NavBar.vue';
</script>

<template>
  <div class="min-h-screen ">
    <NavBar title="Seguros">
      <template #links>
        <ul class="flex font-medium p-0 space-x-8 flex-row mt-0 bg-transparent">
          <RouterLinkNav name="Customers" NameUrl="customers" />
          <RouterLinkNav name="Policies" NameUrl="policies" />
        </ul>
      </template>
    </NavBar>
    <RouterView />
  </div>
</template>
<style scoped></style>
