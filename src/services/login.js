import p from './utils'
import api from './api.js'

export default {
    login(params){
        return api().post('/login',params);
    },
}
