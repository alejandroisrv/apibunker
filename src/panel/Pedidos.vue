<template>

  <div>
    <CRow>

      <CCol lg="12">
        <Table :items="pedidos" :fields="fieldsTable">
          <template #header>
            <CIcon name="cil-grid"/> Pedidos
          </template>
        </Table>
      </CCol>
    </CRow>
  </div>
</template>
<script>
import Table from '../views/base/Table'
import PedidoService from '../services/pedidos'

export default{

  data(){
    return {
      fieldsTable : ['Nombre','Dirección','Telefono','Fecha','status'],
      pedidosWeb:{},
      pedidos:[]
    }
  },
   components:{ Table   },
   created(){
     this.getPedidos();
   },
   methods:{
    getPedidos(){
        PedidoService.getAll().then(rs => {
          console.log(rs.data);
          rs.data.forEach(x => {
              this.pedidos.push({
                Nombre: x.cliente.nombre,
                Dirección: x.direccion,
                Telefono:x.telefono,
                Fecha: x.fecha_creacion,
                status: x.estado == 1 ? 'Active' : 'Pending'
              })
          });
        });
     }
   }

}

</script>
