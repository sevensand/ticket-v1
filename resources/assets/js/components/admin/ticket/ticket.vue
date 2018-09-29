<template>
    <v-form ref="form" v-model="valid" lazy-validation>
  <v-container fluid grid-list-xl mt-5>
      <v-layout row justify-center>
          <v-flex xs6 mt-2>
            <v-card>

                   <v-container fluid grid-list-xl>
                     <v-layout row justify-space-between>
                       <v-flex xs12>
                         <v-card-title primary-title>
                           <div>
                             <h3 class="headline mb-0">CONFIRMATION TICKET</h3>
                           </div>
                         </v-card-title>
                         <v-layout>
                             <v-flex xs7 ml-5>
                               <pdf
                                :src="pdfview"
                               ></pdf>
                               <input id="fileUpload" type="file" hidden @change="onFilepicked" name="ticket">
                               <v-btn
                               flat color="orange"
                               @click="chooseFiles()">
                               <v-icon dark>attach_file</v-icon>
                               Select File
                             </v-btn>

                             </v-flex>

                             <v-flex xs5 mr-5>

                    <v-autocomplete
                           v-model="employeeid"
                           :items="items"
                           :loading="isLoading"
                           :search-input.sync="search"
                           chips
                           clearable
                           hide-details
                           hide-selected
                           item-text="employeeid"
                           item-value="symbol"
                           label="Search Employee No."
                           solo
                         >
                           <template slot="no-data">
                             <v-list-tile>
                               <v-list-tile-title>
                                 Search for Employee no
                               </v-list-tile-title>
                             </v-list-tile>
                           </template>
                           <template
                             slot="selection"
                             slot-scope="{ item, selected }"
                           >
                             <v-chip
                               :selected="selected"
                               color="blue-grey"
                               class="white--text"
                             >
                               <v-icon left>mdi-coin</v-icon>
                               <span v-text="item.employeeid + ' ' + item.lastname"></span>
                             </v-chip>
                           </template>
                           <template
                             slot="item"
                             slot-scope="{ item, tile }"
                           >
                             <v-list-tile-avatar
                               color="indigo"
                               class="headline font-weight-light white--text"
                             >
                             </v-list-tile-avatar>
                             <v-list-tile-content>
                               <v-list-tile-title v-text="item.employeeid + ' ' + item.firstname + ' ' + item.middlename + ' ' + item.lastname "></v-list-tile-title>
                             </v-list-tile-content>
                             <v-list-tile-action>
                               <v-icon>mdi-coin</v-icon>
                             </v-list-tile-action>
                           </template>
                         </v-autocomplete>


                         <v-menu
                         ref="menu1"
                         :close-on-content-click="false"
                         v-model="menu1"
                         :nudge-right="40"
                         lazy
                         transition="scale-transition"
                         offset-y
                         full-width
                         max-width="290px"
                         min-width="290px"
                         >

                         <v-text-field
                         slot="activator"
                         v-model="dissued"
                         label="Date Issued"
                         hint="MM/DD/YYYY format"
                         persistent-hint
                         prepend-icon="event"
                         readonly
                         ></v-text-field>
                         <v-date-picker v-model="dissued" no-title @input="menu1 = false"></v-date-picker>
                       </v-menu>


                             <v-text-field
                             prepend-icon="location_on"
                             v-model="dlocation"
                             label="Departure Location"
                             ></v-text-field>


                               <v-text-field
                               prepend-icon="location_on"
                               v-model="alocation"
                               label="Arrival Location"
                               ></v-text-field>


                               <v-menu
                               ref="menu1"
                               :close-on-content-click="false"
                               v-model="menu2"
                               :nudge-right="40"
                               lazy
                               transition="scale-transition"
                               offset-y
                               full-width
                               max-width="290px"
                               min-width="290px"
                               >

                               <v-text-field
                               slot="activator"
                               v-model="ddate"
                               label="Departure Date"
                               hint="MM/DD/YYYY format"
                               persistent-hint
                               prepend-icon="event"
                               readonly
                               ></v-text-field>
                               <v-date-picker v-model="ddate" no-title @input="menu2 = false"></v-date-picker>
                             </v-menu>



                             <v-menu
                             ref="menu1"
                             :close-on-content-click="false"
                             v-model="menu3"
                             :nudge-right="40"
                             lazy
                             transition="scale-transition"
                             offset-y
                             full-width
                             max-width="290px"
                             min-width="290px"
                             >

                             <v-text-field
                             slot="activator"
                             v-model="adate"
                             label="Arrival Date"
                             hint="MM/DD/YYYY format"
                             persistent-hint
                             prepend-icon="event"
                             readonly
                             ></v-text-field>
                             <v-date-picker v-model="adate" no-title @input="menu3 = false"></v-date-picker>
                           </v-menu>


                               <v-card-actions>
                                 <v-btn flat color="orange" @click="Uploadticket()">SAVE</v-btn>
                                 <v-btn flat color="orange">CANCEL</v-btn>
                               </v-card-actions>

                             </v-flex>
                         </v-layout>


                     </v-flex>
                     </v-layout>
                   </v-container>
                 </v-card>
          </v-flex>


      </v-layout>
  </v-container>
  </v-form>
</template>

<script>
import pdf from 'vue-pdf';
    export default {
      components: {
        pdf
      },
      data() {
        return {
          isLoading: false,
            valid: true,
            items: [],
            dlocation: '',
            alocation: '',
            employeeid: '',
            search: null,
            dissued: null,
            ddate: null,
            adate: null,
            menu1: false,
            menu2: false,
            menu3: false,
            fileloc: null,
            pdfview: null
        }
      },
      watch: {
        search (val) {
           if (this.items.length > 0) return

           this.isLoading = true
           axios.get('../api/v1/Userlist')
             .then(res => {
               this.items = res.data.data
             })
             .catch(err => {
               console.log(err)
             })
             .finally(() => (this.isLoading = false))
         },
         date (val) {
           this.dissued = this.formatDate(this.dissued)
         },
         date1(val) {
           this.ddate = this.formatDate(this.ddate)
         },
         date2(val){
           this.adate = this.formatDate(this.adate)
         }
      },
      methods: {
        formatDate (date) {
          if (!date) return null
          const [year, month, day] = date.split('-')
          return `${month}/${day}/${year}`
        },
        chooseFiles() {
          document.getElementById("fileUpload").click();
        },
        onFilepicked(){
          this.fileloc = event.target.files[0]
          const reader = new FileReader();
          reader.onload = (event) => {
              this.pdfview = event.target.result
            }
            reader.readAsDataURL(this.fileloc)
        },
        Uploadticket(){
          let formData = new FormData();
          formData.append('file', this.fileloc[0]);
          axios.post('/api/v1/Uploadticket', {
            employeeid: this.employeeid,
            dissued: this.dissued,
            dlocation: this.dlocation,
            alocation: this.alocation,
            ddate: this.ddate,
            adate: this.adate,
            fileloc: this.fileloc.name,
            pdfview: this.pdfview,
            headers: {
               'Content-Type': 'multipart/form-data'
            }
          })
          .then(response => {
            this.result = this.response.data.data

          })
          .catch(err => {
            console.log('Error Uploading...')
          })
        }

      }

    }
</script>
