<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';
import MultiSelect from 'primevue/multiselect';
import Tag from 'primevue/tag';
import Dropdown from 'primevue/dropdown';
import TriStateCheckbox from 'primevue/tristatecheckbox';
import { FilterMatchMode } from 'primevue/api';
import { ref, onMounted } from 'vue'
// import debounce from 'lodash.debounce'

import provincesService from '@/services/serviceProvinces';
import { useCustomerStore } from '@/stores/customers';
import { storeToRefs } from 'pinia';
const store = useCustomerStore();
const { customers } = storeToRefs(store);

const customerTable = ref([]);
const loading = ref(true);
const provinces = ref([]);
const types = ref(['Company', 'Individual']);
const typesDropdown = ref([
    { label: 'Company', value: 1 },
    { label: 'Individual', value: 0 },]);

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    email: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    'province.name': { value: null, matchMode: FilterMatchMode.IN },
    city: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    type_description: { value: null, matchMode: FilterMatchMode.EQUALS },
    is_active: { value: null, matchMode: FilterMatchMode.EQUALS }
});
const editingRows = ref([]);

const onRowEditSave = (event) => {
    let { newData } = event;
    newData.type_description = descriptionType(newData.type);
    newData.province.name = getNameProvinces(newData.province_id);

    const index = customerTable.value.findIndex(customer => customer.id === newData.id);

    if (index !== -1) {
        customerTable.value = customerTable.value.map(customer => {
            if (customer.id === newData.id) {
                return newData;
            }
            return customer;
        });
    }
};
function getNameProvinces(id) {
    let provincesName = provinces.value.find(province => province.id === id);
    return provincesName.name;
}
function descriptionType(typeCustomer) {
    return typeCustomer == 1 ? types.value[0] : types.value[1];
}
function accountState(dateUnsubscribed) {
    return dateUnsubscribed === null ? true : false;
}
const getSeverity = (type) => {
    switch (type) {
        case 'Company':
            return 'danger';

        case 'Individual':
            return 'success';

        default:
            return null;
    }
}
onMounted(async () => {
    provinces.value = await provincesService.all();
    store.all().then(async () => {
        customerTable.value = customers.value.map(customer => ({
            ...customer,
            type_description: descriptionType(customer.type),
            province: {
                name: getNameProvinces(customer.province_id)
            },
            is_active: accountState(customer.date_unsubscribe),
        }));
        loading.value = false;
        console.log(customerTable)
    });
});
</script>
<template>
    <div
        class="my-12 mx-5 p-6 md:px-11 shadow-sm hover:shadow-2xl transition-shadow ease-in-out duration-300 rounded-lg border-2 border-black">
        <DataTable v-model:filters="filters" v-model:editingRows="editingRows" editMode="row" @row-edit-save="onRowEditSave"
            :value="customerTable" paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" dataKey="id"
            filterDisplay="row" :loading="loading" tableStyle="min-width: 50rem"
            :globalFilterFields="['name', 'email', 'province.name', 'city', 'type_description', 'is_active']">
            <template #header>
                <div class="flex justify-content-end">
                    <InputText v-model="filters['global'].value" placeholder="Keyword Search" />
                </div>
            </template>
            <template #empty> No customers found. </template>
            <template #loading> Loading customers data. Please wait. </template>

            <!-- Columna de Nombre -->
            <Column field="name" header="Name" class="w-1/5">
                <!-- Template de body -->
                <template #body="{ data }">
                    {{ data.name }}
                </template>
                <!-- Template de Editar -->
                <template #editor="{ data, field }">
                    <InputText v-model="data[field]" />
                </template>
                <!-- Template de Filtro -->
                <template #filter="{ filterModel, filterCallback }">
                    <InputText v-model="filterModel.value" type="text" @input="filterCallback()" class="p-column-filter"
                        placeholder="Search by name" />
                </template>
            </Column>
            <!-- Columna de Email -->
            <Column field="email" header="Email" class="w-1/5">
                <template #body="{ data }">
                    {{ data.email }}
                </template>
                <template #editor="{ data, field }">
                    <InputText v-model="data[field]" />
                </template>
                <template #filter="{ filterModel, filterCallback }">
                    <InputText v-model="filterModel.value" type="text" @input="filterCallback()" class="p-column-filter"
                        placeholder="Search by email" />
                </template>
            </Column>

            <!-- Columna de Provincia -->
            <Column field="province.name" header="Provinces" class="w-1/12">
                <!-- Template de body -->
                <template #body="{ data }">
                    {{ data.province.name }}
                </template>
                <!-- Template de editar -->
                <template #editor="{ data }">
                    <Dropdown v-model="data.province_id" :options="provinces" optionLabel="name" optionValue="id"
                        placeholder="Select a Provinces">
                        <template #option="slotProps">
                            <div class="flex align-items-center gap-2">
                                <span>{{ slotProps.option.name }}</span>
                            </div>
                        </template>
                    </Dropdown>
                </template>
                <!--! Template de Filtro -->
                <template #filter="{ filterModel, filterCallback }">
                    <MultiSelect v-model="filterModel.value" @change="filterCallback()" :options="provinces"
                        optionLabel="name" placeholder="Any" class="p-column-filter" style="min-width: 6rem"
                        :maxSelectedLabels="1">
                        <template #option="slotProps">
                            <div class="flex align-items-center gap-2">
                                <span>{{ slotProps.option.name }}</span>
                            </div>
                        </template>
                    </MultiSelect>
                </template>
            </Column>
            <!-- Columna de Ciudad -->
            <Column field="city" header="City" class="w-1/6">
                <template #body="{ data }">
                    {{ data.city }}
                </template>
                <template #editor="{ data, field }">
                    <InputText v-model="data[field]" />
                </template>
                <template #filter="{ filterModel, filterCallback }">
                    <InputText v-model="filterModel.value" type="text" @input="filterCallback()" class="p-column-filter"
                        placeholder="Search by city" />
                </template>
            </Column>
            <!-- Columna de tipo -->
            <Column field="type_description" header="Type" style="width: 6rem">
                <template #body="{ data }">
                    <Tag :value="data.type_description" :severity="getSeverity(data.type_description)" />
                </template>
                <template #editor="{ data }">
                    <Dropdown v-model="data.type" :options="typesDropdown" optionLabel="label" optionValue="value"
                        placeholder="Select a Status">
                        <template #option="slotProps">
                            <Tag :value="slotProps.option.label" :severity="getSeverity(slotProps.option.label)" />
                        </template>
                    </Dropdown>
                </template>
                <!-- Template Filtro -->
                <template #filter="{ filterModel, filterCallback }">
                    <Dropdown v-model="filterModel.value" @change="filterCallback()" :options="types" placeholder="Any"
                        class="p-column-filter" style="width: 10rem" :showClear="true">
                        <template #option="slotProps">
                            <Tag :value="slotProps.option" :severity="getSeverity(slotProps.option)" />
                        </template>
                    </Dropdown>
                </template>
            </Column>
            <!-- Columna de Estado  -->
            <Column field="is_active" header="Status" dataType="boolean" class="w-1/12">
                <template #body="{ data }">
                    <span :class="{ ' text-green-500': data.is_active, ' text-red-400': !data.is_active }">{{
                        data.is_active }}</span>
                </template>
                <template #filter="{ filterModel, filterCallback }">
                    <TriStateCheckbox v-model="filterModel.value" @change="filterCallback()" />
                </template>
            </Column>
            <!-- Columna para editar -->
            <Column :rowEditor="true" style="width: 10%; min-width: 8rem" bodyStyle="text-align:center"></Column>
        </DataTable>
    </div>
</template>