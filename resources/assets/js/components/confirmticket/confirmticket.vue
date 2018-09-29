<template>

  <v-layout row mt-5>
      <v-flex xs12 sm6 offset-sm3 mt-2>
        <v-card>
          <v-toolbar color="cyan" dark>
            <v-toolbar-title>CONFIRMATION TICKET</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>

          <v-list two-line>
            <template v-for="item in result">
              <v-subheader
                v-if="item.header"
                :key="item.header"
              >
                {{ item.header }}
              </v-subheader>

              <v-divider
                v-else-if="item.divider"
                :inset="item.inset"
                :key="index"
              ></v-divider>

              <v-list-tile
                v-else
                :key="item.id"
                avatar
                @click="itemClick(item.fileloc)"
              >
                <v-list-tile-avatar>
                  <v-icon>assignment</v-icon>
                </v-list-tile-avatar>

                <v-list-tile-content>
                  <v-list-tile-title>{{ item.dlocation}} - {{ item.alocation }}</v-list-tile-title>
                  <v-list-tile-sub-title>{{ item.ddate }} - {{ item.adate }}</v-list-tile-sub-title>
                </v-list-tile-content>


              </v-list-tile>
            </template>
          </v-list>
        </v-card>

      </v-flex>


      <v-dialog v-model="showModal" max-width="820px">
        <v-card>
          <v-card-text>TICKET IMAGE</v-card-text>
          <pdf :src="filepdf"
          ></pdf>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="primary" @click="showModal = false">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

    </v-layout>

</template>

<script>
import { bus } from '../../app';
import pdf from 'vue-pdf';
    export default {
      components: {
        pdf
      },
      data () {
        return {
          scale: 2,
          filepdf: undefined,
          showModal: false,
          result: [],
        }
      },
 mounted() {
      this.fetchTicket();
 },
 methods: {
   fetchTicket(){
     bus.$on('emittedEvent', data => {
         this.value = data;
         axios.get('/api/v1/confirmationticket/' + this.value.employeeid)
         .then(response => {
           this.result = response.data.data
         })
         .catch(err => {
           console.log('Error Fetching Confirmation Ticket!!!')
         })
     });

   },
   itemClick(item) {
     this.showModal = true;
     this.filepdf = item;
   }
 }
}
</script>
