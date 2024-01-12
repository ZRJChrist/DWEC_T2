<script setup>
import { ref } from 'vue'
// Datos iniciales
const purchases = ref([]);
const catalog = ref([
    { codigo: 1, descripcion: 'Producto 1', precio: 10 },
    { codigo: 2, descripcion: 'Producto 2', precio: 20 },
]);

// Campos de entrada
const newId = ref('');
const newDescription = ref('');
const newAmount = ref(0);
const newPrice = ref(0);
const newTotal = ref(0);

// Función para agregar una compra
const addPurchase = (id) => {
    if (isNaN(newAmount)) {
        newAmount.value = 1
    }
    let product = catalog.value.filter((product) => {
        return product.codigo == id;
    })
    product = product[0]
    const purchase = {
        id: purchases.value.length + 1,
        descripcion: product.descripcion,
        cantidad: newAmount.value,
        precio: product.precio,
        subtotal: newAmount.value * newPrice.value,
    };
    purchases.value.push(purchase);

    newId.value = ''
    newDescription.value = '';
    newAmount.value = 0;
    newPrice.value = 0;
    newTotal.value = 0;
};

const selectProduct = (id) => {
    newId.value = id
    let product = catalog.value.filter((product) => {
        return product.codigo == id;
    })
    product = product[0]
    if (product) {
        newDescription.value = product.descripcion
        newAmount.value = 1;
        newPrice.value = product.precio
        calculateTotal();
    } else {
        newDescription.value = '';
        newAmount.value = '';
        newPrice.value = '';
        newTotal.value = '';
    }

}
// Función para eliminar una compra
const deletePurchase = (id) => {
    purchases.value = purchases.value.filter((purchase) => purchase.id !== id);
};

// Función para editar una compra
const editPurchase = (id) => {

};

// Función para calcular el total automáticamente
const calculateTotal = () => {
    newTotal.value = newAmount.value * newPrice.value;
};

</script>
<template>
    <h1>CRUD VUE</h1>
    <div>
        <!-- Campos de entrada -->
        <label>Codigo:</label>
        <input type="text" @input="selectProduct(newId)" v-model="newId">
        <label>Descripcion:</label>
        <input type="text" v-model="newDescription" readonly>
        <label>Cantidad:</label>
        <input type="number" min="1" v-model="newAmount" @input="calculateTotal">
        <label>Precio:</label>
        <input type="number" v-model="newPrice" @input="calculateTotal" readonly>
        <label>Subtotal:</label>
        <input type="number" v-model="newTotal" readonly>
        <!-- Botones de acción -->
        <button @click="addPurchase(newId)">Insertar</button>
    </div>
    <table id="compra">
        <thead>
            <th>Col</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>SubTotal</th>
            <th>Accion</th>
        </thead>
        <tbody>
            <tr v-for="purchase in purchases" :key="purchase.id">
                <td>{{ purchase.id }}</td>
                <td>{{ purchase.descripcion }}</td>
                <td>{{ purchase.cantidad }}</td>
                <td>{{ purchase.precio }}</td>
                <td>{{ purchase.subtotal }}</td>
                <td>
                    <!-- <button @click="editPurchase(purchase.id)">Modificar</button> -->
                    <button @click="deletePurchase(purchase.id)">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Tabla de catálogo -->
    <table id="catalogo">
        <thead>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Precio</th>
        </thead>
        <tbody>
            <tr v-for="product in catalog" :key="product.codigo" @click="selectProduct(product.codigo)">
                <td>{{ product.codigo }}</td>
                <td>{{ product.descripcion }}</td>
                <td>{{ product.precio }}</td>
            </tr>
        </tbody>
    </table>
</template>

<style scoped>
#catalogo tbody tr {
    cursor: pointer;
}
</style>
