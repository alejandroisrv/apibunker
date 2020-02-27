import axios from 'axios'

let auth = JSON.parse(localStorage.getItem('auth'));

const api = axios.create({
    baseURL: `http://localhost:8001/admin/`,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + auth.token
    }
});

api.interceptors.response.use(response => {
    return response;
}, error => {
    if (error.response.status === 401) {

        setTimeout(() => {
            window.location.href = "/login";
        }, 3000);

        localStorage.removeItem('auth');
    }
    return error;
});

export default () => {
    return api
}
