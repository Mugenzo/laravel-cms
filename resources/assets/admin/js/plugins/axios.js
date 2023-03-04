import axios from 'axios'

const $axios = axios.create({
    baseURL: '/api/',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        ContentType: 'application/json',
        Accept: 'application/json'
    },
    withCredentials: true
});

export default $axios;
