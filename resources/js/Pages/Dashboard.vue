<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { onBeforeMount, onMounted, ref } from 'vue';
import services from '@/services';
import { useToast } from 'vue-toastification';

const toast = useToast();

const curtidas = ref(0);

const users = ref([]);

const button = ref(false);

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

const handleSubmit = async (id) => {
    try {

        button.value = true;

        const { data } = await services.user.createCurtida(id);

        console.log(data);

        if (!!data) {
            toast('Curtiu!');
        }

        button.value = false;

    } catch (e) {
        button.value = false;
        console.error(e);
        toast.error('Ocorreu um erro, tente novamente mais tarde!');
    }
}
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
                            <li>{{ user.name }} ... <span v-if="!button">
                                    <button @click="handleSubmit(user.id)"
                                        class="text-blue-600 font-semibold">Curtir</button>
                                </span>
                                <span v-else>
                                    Carregando
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
