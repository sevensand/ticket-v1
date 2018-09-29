<template>

  <v-layout mt-5>
      <v-flex xs12 sm6 offset-sm3 mt-2>
        <v-card>
          <v-card-media
            class="white--text"
            height="200px"
            src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
          >
            <v-container fill-height fluid>
              <v-layout fill-height>
                <v-flex xs12 flexbox>
                  <span class="headline">
                  <v-avatar
                  :size="150"
                  color="grey lighten-4"
                  align-content-center
                  >
                  <img src="../../../../assets/img/avatar.png" class="userprofile_logo">
                </v-avatar>
                </span>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-media>

          <v-container fluid grid-list-xl>
            <v-layout row justify-space-between>
              <v-flex xs12>
              <Updateform></Updateform>
            </v-flex>
            </v-layout>
          </v-container>

        </v-card>
      </v-flex>
    </v-layout>


</template>

<script>
import Updateform from './updateForm.vue';
    export default {
      data() {
        return {
          result: [],
          tabs: null,
          text: 'WELCOME USER',
          valid: false,
        }

      },
      components: {
        Updateform
      }
    }
</script>
