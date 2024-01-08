<script setup>
import { ref } from 'vue'
import Fruit from './components/Fruit.vue';

const fruits = ref([
    { id: 1, name: 'Peras', num: 1 },
    { id: 2, name: 'Manzanas', num: 5 },
    { id: 3, name: 'Cocos', num: 10 },
])

const newFruitName = ref('');

const add = () => {
    const newId = fruits.value.reduce((maxId, fruit) => Math.max(maxId, fruit.id), 0) + 1;
    if (newFruitName.value !== '') {
        fruits.value.push({ id: newId, name: newFruitName.value, num: 10 })
        newFruitName.value = '';
    }
}
const deleteFruit = (fruitId) => {
    fruits.value = fruits.value.filter(fruit => fruit.id !== fruitId);

}
</script>
<template>
    <h1>CRUD VUE</h1>
    <div>
        <input type="text" id="text" placeholder="Nueva Fruta" v-model="newFruitName">
        <button class="agregar" @click="add">Agregar</button>
    </div>
    <table>
        <thead>
            <th> Id </th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Accion</th>
        </thead>
        <tbody>
            <tr v-for="(item) in fruits ">
                <Fruit :id=item.id :name=item.name :num=item.num :key=item.id />
                <td>
                    <button class="delete" @click="deleteFruit(item.id)">Eliminar</button>
                </td>
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
