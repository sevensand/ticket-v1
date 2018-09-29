<template>
  <v-form ref="form" v-model="valid" lazy-validation>
    <v-text-field
      prepend-icon="person"
      v-model="username"
      label="Username"
      :rules = "usernameRules"
      required
    ></v-text-field>
    <v-text-field
      prepend-icon="lock"
      v-model="password"
      label="Password"
      :rules = "passwordRules"
      type="password"
      required
    ></v-text-field>

    <v-layout align-center justify-center row fill-height/>
    <v-btn
      :disabled="!valid"
      @click="submit"
    >
      Login
    </v-btn>
    </v-layout>

  </v-form>


</template>

<script>
import axios from 'axios';
import router from  '../routes/routes';


    export default {
      data: () => ({
            valid: false,
            username: '',
            usernameRules: [
              v => !!v || 'Username is required'
            ],
            password: '',
            passwordRules: [
              v => !!v || 'Password is required'
            ]
          }),
          methods: {
            submit () {
              if (this.$refs.form.validate()) {
                axios.post('api/v1/login', {
                  username: this.username,
                  password: this.password,
                }).then(response => {
                  let token = response.data.data.remember_token;
                  let userAuth = response.data.data;
                  if(response.data.status_code == "200"){
                    if(token) {
                      localStorage.setItem('token', token);
                      if(userAuth.username == 'admin'){
                        this.$router.push('/adashboard/adashboard');
                      } else {
                        this.$router.push('/dashboard/annoucementboard');
                      }

                    }else {
                      this.$toaster.error('Token Expired!');
                    }
                  }else {
                    this.$toaster.error('Error Username and Password!');
                  }
                }).catch(err => {
                    this.$toaster.error('Error Username and Password!');
                });

              };
            },
            clear () {
              this.$refs.form.reset()
            }
          }
    }
</script>
