<template>
  <v-container fluid grid-list-xl mt-5>
      <v-layout row justify-center>
          <v-flex xs2 mt-2>
            <v-card>
              <h3>ADMIN DASHBOARD</h3>
            </v-card>
          </v-flex>
           <router-view></router-view>

      </v-layout>
  </v-container>
</template>

<script>
import router from '../../routes/routes';
    export default {
      data() {
        return {

        }
      }

    }
</script>
