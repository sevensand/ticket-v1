<template>
  <v-app>
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-6 reg-form">
                <div class="card card-default mt-5 login-card">
                    <div class="card-header ">
                    <div class="card-body">
                      <h3 class="text-white">Register</h3>
                      <p class="text-white">
                        Do you have an account? Login here <a href="../login">Login</a>
                      </p>
                        <RegForm></RegForm>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>
  </v-app>

</template>

<script>
import RegForm from './registerForm.vue'
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components: {
          RegForm
        }
    }
</script>
