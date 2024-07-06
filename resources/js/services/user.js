export default httpClient => ({
    getAll: async () => {
        const response = await httpClient.get('/user');

        return {
            data: response.data
        }
    },
    getCurtidas: async () => {
        const response = await httpClient.get('/user/curtidas');

        return {
            data: response.data
        }
    },
    createCurtida: async (id) => {
        const response = await httpClient.put(`/user/curtidas/${id}`);

        return {
            data: response.data
        }
    }
});
