<script setup>
import { ref, onMounted } from 'vue';
import { posts, users } from './services/request';

const AllPosts = ref([]);
const title = ref('');
const body = ref('');

const filter = ref(0);
const filteredPosts = ref([]);

const Users = ref([]);

const fetchData = async () => {
    const post = await posts();
    const user = await users();

    Users.value = user;
    AllPosts.value = post;
    filtrar();
};

onMounted(() => {
    fetchData();
});

const add = () => {
    const newPosts = {
        title: body,
        body: body
    }
    AllPosts.value.push(newPosts);
}

const filtrar = () => {
    filteredPosts.value = filter.value != 0
        ? AllPosts.value.filter(post => filter.value == post.userId)
        : AllPosts.value;
};
</script>

<template>
    <div class="container">
        <h1>Agregar Post</h1>
        <div class="mb-3">
            <label for="title" class="form-label">Titulo</label>
            <input type="text" class="form-control" id="title" v-model="title">
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Contenido</label>
            <input type="text" class="form-control" id="body" v-model="body">
        </div>
        <button @click="add" class="btn btn-primary">Agregar</button>
    </div>
    <div class="container">
        <h5>Filtro:</h5>

        <select v-model="filter">
            <option v-for="user in Users" :key="user.id" :value='user.id'>{{ user.name }}</option>
        </select>
        <button @click="filtrar" class="btn btn-primary ms-5">Filtrar</button>

    </div>
    <div class="container">
        <h1>Lista de Publicaciones</h1>
        <div class="row">
            <div class="col-6 g-2" v-for="post in filteredPosts" :key="post.id">
                <div class="card w-100 h-100" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ post.title }}</h5>
                        <p class="card-text">{{ post.body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
