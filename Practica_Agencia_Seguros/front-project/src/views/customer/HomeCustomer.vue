<script setup>
import { watchDebounce } from 'vue'
import CustomerList from '@/components/CustomerList.vue';
import { useClienteStore } from '@/stores/customers';
import { storeToRefs } from 'pinia';
const store = useClienteStore();
const { clientes, clienteSeleccionado } = storeToRefs(store);
const { setClienteSeleccionado, fetchClientes } = store;

fetchClientes();

watchDebounce(clienteSeleccionado, async (newSelect) => {
    console.log({ new: newSelect });
}, { debounce: 1000 });

</script>
<template>
    <div class="m-7 p-4 text-sm shadow-md hover:shadow-xl rounded-md ">
        <CustomerList>
            <template #body>
                <div class="flex text-center" v-for="customer in  clientes " :key="customer.id">
                    <div class="w-4/12 p-2">
                        <div class="text-pretty font-semibold">
                            <span>Nombre: {{ customer.nombre }}</span>
                        </div>
                        <div class="font-normal">
                            <span>Email: {{ customer.email }}</span>
                        </div>
                        <div class="font-normal"> <span>Telefono: {{ customer.telefono }}</span> </div>
                    </div>
                    <div class="w-4/12 p-2">
                        <div class="text-pretty font-semibold">Localidad: {{ customer.localidad }}</div>
                        <div class="font-normal">CP: {{ customer.codigoPostal }}</div>
                    </div>
                    <div class="w-3/12 p-2">
                        <div class="text-pretty font-semibold">{{ customer.tipo == 0 ? 'Particular' : 'Empresa' }}</div>
                    </div>
                    <div class="w-3/12 p-2 ">
                        <div class="flex justify-center space-x-2 text-white">
                            <button class="p-1 bg-yellow-500" @click="setClienteSeleccionado(customer)">Editar</button>
                            <button class="p-1 bg-red-600">Dar Baja</button>
                        </div>
                    </div>
                </div>
            </template>
        </CustomerList>
    </div>
</template>