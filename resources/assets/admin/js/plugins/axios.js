import axios from 'axios'

const instance = axios.create({
    baseURL: '/api/',
    headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
});

export default instance;
