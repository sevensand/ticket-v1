<template>
  <v-container fluid grid-list-xl mt-5>
      <v-layout row justify-center>
        <v-flex xs2 mt-2>
          <v-card>
                  <v-card-media>
                    <v-card-text>
                      <p class="text-md-center">
                        <v-avatar
                        :size="150"
                        color="grey lighten-4"
                        >
                        <img src="../../../../assets/img/avatar.png" class="dashboard_logo">
                      </v-avatar>
                    </p>
                  </v-card-text>
                  </v-card-media>

                  <v-card-title primary-title>
                    <div>
                      <span>Employee ID: {{ result.employeeid }}</span><br />
                      <span>Fullname: {{ result.firstname }} {{ result.lastname }}</span><br />
                      <span>Department: {{ result.department }}</span><br />
                      <span v-if="result.mobileno=='NONE'">Mobile No: {{ result.mobileno }} - <v-chip color="red" text-color="white" small>Please Update!!  </v-chip></span>
                      <span v-else>Mobile No: {{ result.mobileno }}
                      </span><br />
                      <span>Passport
                        <div v-if="result.passexp > dateNow"><v-chip color="green" text-color="white" small>Valid</v-chip></div>
                        <div v-else="result.passexp < dateNow"><v-chip color="red" text-color="white" small>Invalid please update!!</v-chip></div>
                      </span><br />
                      <span>Qatar ID
                        <div v-if="result.qidexp > dateNow"><v-chip color="green" text-color="white" small>Valid</v-chip></div>
                        <div v-else="result.qidexp < dateNow"><v-chip color="red" text-color="white" small>Invalid please update!!</v-chip></div>
                      </span><br />
                      <span>Medical ID
                        <div v-if="result.midexp > dateNow"><v-chip color="green" text-color="white" small>Valid</v-chip></div>
                        <div v-else="result.midexp < dateNow"><v-chip color="red" text-color="white" small>Invalid please update!!</v-chip></div>
                      </span><br />
                    </div>
                  </v-card-title>

                  <v-card-actions>
                    <v-btn flat color="orange" @click="update">Update</v-btn>
                  </v-card-actions>

            </v-card>
        </v-flex>
        <v-flex xs4 mt-2>

          <v-tabs
             slot="extension"
             fixed-tabs
             dark
             tabs
           >
             <v-tabs-slider></v-tabs-slider>

             <v-tab to="/dashboard/annoucementboard"><v-icon>chat</v-icon></v-tab>
             <v-tab to="/dashboard/messagesinbox"><v-icon>mail_outline</v-icon></v-tab>
             <v-tab to="/dashboard/statusinfo"><v-icon>date_ranged</v-icon></v-tab>


           </v-tabs>
         </v-toolbar>

         <v-tabs-items v-model="tabs">
           <v-card>
             <v-card-text>
               <router-view></router-view>
             </v-card-text>
           </v-card>
         </v-tabs-items>

       </v-tabs>
        </v-flex>
      </v-layout>
  </v-container>
</template>

<script>
import router from '../routes/routes';
    export default {
      data() {
        return {
          dateNow: new Date().toISOString().slice(0,10),
          result: [],
          tabs: null,
          status:[

          ]
        }
      },
      mounted(){
        this.fetchUser();
      },
      methods: {
        fetchUser: function() {
          var token = localStorage.getItem('token');
          const authStr = 'Bearer' .concat(token);
          axios.get('../api/users', { headers: { Authorization: authStr } })
          .then(response => {
            this.result = response.data;
          }).catch(err => {
              this.$toaster.error('Token Expired!');
              this.$router.push('/login');
          });
        },

        update(){
          this.$router.push('/settings')
        }
      }

    }
</script>
