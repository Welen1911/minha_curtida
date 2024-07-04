<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { onBeforeMount, onMounted, ref } from 'vue';
import services from '@/services';

const curtidas = ref(0);

const users = ref([]);

onMounted(async () => {
    try {
        const { data } = await services.user.getCurtidas();

        console.log(data);

        curtidas.value = data.curtidas;

    } catch (e) {
        console.error(e);
    }
});

onBeforeMount(async () => {
    try {
        const { data } = await services.user.getAll();

        console.log(data);

        users.value = data;

    } catch (e) {
        console.error(e);
    }
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Curtidas: {{ curtidas }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-6 py-6">
                        <ul class="mb-4" v-for="user in users" :key="user.id">
                            <li>{{ user.name }} ... <span class="text-blue-600 font-semibold">Curtir</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
