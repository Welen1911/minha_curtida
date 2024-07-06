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
        const { data } = await services.user.getMe();

        curtidas.value = data.curtidas;

        window.Echo.private(`curtida.${data.id}`).listen(
            'CurtidaEvent', (e) => {
                console.log(e);

                curtidas.value = e.curtidas;
            }
        );

    } catch (e) {
        console.error(e);
    }
});

onBeforeMount(async () => {
    try {
        const { data } = await services.user.getAll();

        users.value = data;

    } catch (e) {
        console.error(e);
    }
});

const handleSubmit = async (id) => {
    try {

        button.value = true;

        const { data } = await services.user.createCurtida(id);

        if (!!data) {
            toast('Curtiu!');
        }

    } catch (e) {
        console.error(e);
        toast.error('Ocorreu um erro, tente novamente mais tarde!');
    } finally {
        button.value = false;

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
