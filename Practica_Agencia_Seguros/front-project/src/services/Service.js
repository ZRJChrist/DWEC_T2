
import axiosApi from './api';

export default class Service {
    #objectUrl;
    #api;
    constructor(url) {
        this.#objectUrl = url;
        this.#api = axiosApi;
    }
    getAll() {
        return this.#api.get(this.#objectUrl);
    }

    get(id) {
        return this.#api.get(`${this.#objectUrl}/${id}`);
    }

    create(data) {
        return this.#api.post(this.#objectUrl, data);
    }

    update(id, data) {
        return this.#api.put(`${this.#objectUrl}/${id}`, data);
    }

    delete(id) {
        return this.#api.delete(`${this.#objectUrl}/${id}`);
    }
}