import p from './utils'
import api from './api.js'

export default {
    getAll(params=null) {
        console.log(p.converParamters(params))
        return api().get('/pedidos/all'+ p.converParamters(params));
    },
    changeState(params){
        return api().post('/pedidos/add',params);
    },
}
