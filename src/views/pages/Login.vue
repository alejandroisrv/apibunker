<template>
  <CContainer class="d-flex align-items-center min-vh-100">
    <CRow class="justify-content-center">
      <CCol md="12">
          <CCard class="p-4">
            <CCardBody>
              <CForm>
                <h1 class="my-1">Inicia sesión</h1>
                <p class="text-danger" style="text-align:center;font-weight:600;">{{ error }}</p>
                <CInput placeholder="Username" autocomplete="username email" v-model="credenciales.usuario">
                  <template #prepend-content><CIcon name="cil-user"/></template>
                </CInput>
                <CInput placeholder="Password" type="password" autocomplete="curent-password" v-model="credenciales.password">
                  <template #prepend-content><CIcon name="cil-lock-locked"/></template>
                </CInput>
                <CRow>
                  <CCol col="12">
                    <CButton color="primary" class="px-4" @click="login">Login</CButton>
                  </CCol>
                </CRow>
              </CForm>
            </CCardBody>
          </CCard>
      </CCol>
    </CRow>
  </CContainer>
</template>

<script>
import axios from 'axios'
export default {
  name: 'Login',
  data(){
    return {
        credenciales:{
            usuario:'',
            password:''
        },
        validations:{
            password:false,
            usuario:false,
        },
        error:''
      }
  },
  methods:{
      login(){
          if(this.validationEmail() && this.validationPassword()){
              axios.post('http://localhost:8001/admin/login',this.credenciales).then(rs=>{
                  if(rs.data.success){
                      console.log(rs.data);
                      localStorage.setItem('auth', JSON.stringify(rs.data));
                      window.location.href="/pedidos";
                  }else {
                      this.error = rs.data.error;
                  }
              })
          }
      },
      validationEmail(){
          if(this.credenciales.usuario == ''){
              this.validations.usuario = true;
              return false;
          }
          return true;
      },
      validationPassword(){
          if(this.credenciales.password == ''){
              this.validations.password = true;
              return false;
          }
          return true;
      }
    }
}
</script>
