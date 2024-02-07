import { defineStore } from 'pinia';
import Service from '@/services/Service';

const clienteService = new Service('/clientes');
export const useClienteStore = defineStore({
    id: 'clientes',

    state: () => ({
        clientes: [],
        clienteSeleccionado: null,
    }),

    actions: {
        async fetchClientes() {
            try {
                const response = await clienteService.getAll();
                this.clientes = response.data;
            } catch (error) {
                console.error('Error al obtener datos', error);
            }
        },
        async fetchCliente(cliente) {
            try {
                const response = await clienteService.get(cliente.id);
                this.clientes = response.data;
            } catch (error) {
                console.error('Error al obtener clientes', error);
            }
        },
        async createCliente(cliente) {
            try {
                const response = await clienteService.create(cliente);
                this.clientes.push(response.data);
            } catch (error) {
                console.error('Error al crear cliente', error);
            }
        },

        async updateCliente({ id, data }) {
            try {
                const response = await clienteService.update(id, data);
                const index = this.clientes.findIndex(cliente => cliente.id === id);
                if (index !== -1) {
                    this.clientes.splice(index, 1, response.data);
                }
            } catch (error) {
                console.error('Error al actualizar cliente', error);
            }
        },

        async deleteCliente(id) {
            try {
                await clienteService.delete(id);
                this.clientes = this.clientes.filter(cliente => cliente.id !== id);
            } catch (error) {
                console.error('Error al eliminar cliente', error);
            }
        },

        setClienteSeleccionado(cliente) {
            this.clienteSeleccionado = cliente;
        }
    }
});
