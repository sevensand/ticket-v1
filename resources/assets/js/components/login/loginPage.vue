<template>
    <v-app>
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-4">
              <div class="card card-default mt-5 login-card">
                  <div class="card-header ">

                    <img :src="'/img/logo.png'" class="login-logo"></div>

                  <div class="card-body">
                      <img :src="'/img/avatar.png'" class="login-avt">
                      <LoginForm></LoginForm>
                  </div>
              </div>
          </div>
      </div>
  </div>
</v-app>
</template>

<script>
import LoginForm from './loginForm.vue'
    export default {
        mounted() {
        },
        components: {
          LoginForm
        }
    }
</script>
