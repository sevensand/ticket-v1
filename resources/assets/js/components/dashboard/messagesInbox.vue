<template>
  <v-layout row>
    <v-flex xs12 sm12>
      <v-card color="grey darken-4">
        <v-list>
          <v-list-tile
            v-for="item in message"
            :key="item.subject"
            avatar
            @click=""
          >
            <v-list-tile-content>
              <v-list-tile-title v-text="item.subject"></v-list-tile-title>
              <v-list-tile-sub-title v-html="item.created_at"></v-list-tile-sub-title>
            </v-list-tile-content>

            <v-list-tile-avatar>
              <img :src="require('../../../../assets/img/' + item.avatar)">
            </v-list-tile-avatar>
          </v-list-tile>
        </v-list>
      </v-card>
    </v-flex>
  </v-layout>
</template>
<script>
  export default {
    data () {
        return {
          message: []
        }
      },
      mounted() {
        this.fetchMessage();
      },
      methods: {
        fetchMessage(){
          axios.get('../api/v1/messagelist')
          .then( response => {
            this.message = response.data.data
          })
          .catch(err => {
            console.log(err);
          })
        }
      }
  }
</script>
