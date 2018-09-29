<template>
  <v-layout  color="grey darken-4">
    <v-flex xs12 sm12>
      <v-card>
        <v-list two-line>
          <template v-for="(result, index) in annoucement">
            <v-subheader
              v-if="result.header"
              :key="result.header"
            >
              {{ result.header }}
            </v-subheader>

            <v-divider
              v-else-if="result.divider"
              :inset="result.inset"
              :key="index"
            ></v-divider>

            <v-list-tile
              v-else
              :key="result.title"
              avatar
              @click=""
            >
              <v-list-tile-avatar>
                <img :src="require('../../../../assets/img/' + result.avatar)">
              </v-list-tile-avatar>

              <v-list-tile-content>
                <v-list-tile-title v-html="result.title"></v-list-tile-title>
                <v-list-tile-sub-title v-html="result.message"></v-list-tile-sub-title>
              </v-list-tile-content>
            </v-list-tile>
          </template>
        </v-list>
      </v-card>
    </v-flex>
  </v-layout>
</template>
<script>
  export default {
    data () {
      return {
        annoucement: []
      }
    },
    mounted() {
      this.fetchAnnoucment();
    },
    methods: {
      fetchAnnoucment() {
        axios.get('/api/v1/announcementlist')
        .then(response => {
          this.annoucement = response.data.data;
        })
        .catch(err => {
          this.$toaster.error('An Error Occured!');
        })
      }
    }
  }
</script>
