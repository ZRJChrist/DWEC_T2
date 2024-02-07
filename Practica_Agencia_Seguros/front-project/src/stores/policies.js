import { defineStore } from "pinia";
import Service from "@/services/Service";

const policiesService = new Service('/polizas');

export const usePoliciesStore = defineStore({
    id: 'policies',
    state: () => ({
        policies: [],
        selectPolicy: null,
    }),
    actions: {
        async fetchPolicies() {
            try {
                const response = await policiesService.getAll();
                this.policies = response.data;
            }
            catch (error) {
                console.console.log('Error al obtener datos', error);
            }
        },
        async fetchPolicy(policy) {
            try {
                const response = await policiesService.get(policy.id);
                this.policies = response.data;
            } catch (error) {
                console.console.log('Error al obtener datos', error);
            }
        },
        async createPolicy(policy) {
            try {
                const response = await policiesService.create(policy)
                this.policies.push(response.data);
            } catch (error) {
                console.console.log('Error', error);
            }
        },
        async updatePolicy(id, data) {
            try {
                const response = await policiesService.update(id, data);
                const index = this.policies.findIndex(policies => policies.id === id);
                if (index !== -1) {
                    this.policies.splice(index, 1, response.data);
                }
            } catch (error) {
                console.error('Error al actualizar', error);
            }
        },
        async deletePolicy(id) {
            try {
                await policiesService.delete(id);
                this.policies = this.policies.filter(policies => policies.id !== id);
            } catch (error) {
                console.error('Error al eliminar', error);
            }
        },
        setClienteSeleccionado(policy) {
            this.selectPolicy = policy;
        }
    }
})