import axios from 'axios';
import user from './user';

const API_ENV = {
    development: 'http://127.0.0.1:8000'
};

const httpClient = axios.create({
    baseURL: API_ENV.production ?? API_ENV.development
});


export default {
    user: user(httpClient)
};
