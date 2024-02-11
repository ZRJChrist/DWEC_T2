import Service from '@/services/Service';

const provincesServices = new Service('/provinces');

async function all() {
    const response = await provincesServices.getAll();
    return response.data;
}

async function find(id) {
    const response = await provincesServices.get(id);
    return response.data;
}
const provincesService = {
    all,
    find,
};
export default provincesService;

