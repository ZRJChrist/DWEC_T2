import { defineStore } from 'pinia';
import Service from '@/services/Service';

const serviceCustomer = new Service('/customers');

export const useCustomerStore = defineStore({
    id: 'customers',

    state: () => ({
        customers: [],
        selectedCustomer: null,
    }),

    actions: {
        async all() {
            try {
                const response = await serviceCustomer.getAll();
                this.customers = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        async find(cliente) {
            try {
                const response = await serviceCustomer.get(cliente.id);
                this.customers = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        async create(cliente) {
            try {
                const response = await serviceCustomer.create(cliente);
                this.customers.push(response.data);
            } catch (error) {
                console.error(error);
            }
        },

        async update({ id, data }) {
            try {
                const response = await serviceCustomer.update(id, data);
                const index = this.customers.findIndex(cliente => cliente.id === id);
                if (index !== -1) {
                    this.customers.splice(index, 1, response.data);
                }
            } catch (error) {
                console.error(error);
            }
        },

        async delete(id) {
            try {
                await serviceCustomer.delete(id);
                this.customers = this.customers.filter(customer => customer.id !== id);
            } catch (error) {
                console.error(error);
            }
        },

        setSelectedCustomer(customer) {
            this.selectedCustomer = customer;
        }
    }
});
