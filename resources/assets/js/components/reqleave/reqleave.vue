<template>
  <v-form ref="form" v-model="valid" lazy-validation>
  <v-container fluid grid-list-xl mt-5>
      <v-layout row justify-center>
        <v-flex xs2 mt-2>
          <v-card>
            <v-date-picker
              :landscape="landscape"
              v-model="date1"
                label="FROM"

              :event-color="date => date[9] % 2 ? 'red' : 'green'"
              :events="functionEvents"
            ></v-date-picker>
          </v-card>
        </v-flex>
        <v-flex xs2 mt-2>
          <v-date-picker
            v-model="date2"
            :event-color="date => date[9] % 2 ? 'red' : 'green'"
            :events="functionEvents"
          ></v-date-picker>
        </v-flex>
        <v-flex xs3 mt-2>
          <v-card>

            <v-flex xs11 ml-3>
              <v-text-field
              v-model="date1"
              prepend-icon="date_range"
              :rules="date1Rules"
              label="Date From"
              required
              ></v-text-field>

              <v-text-field
              v-model="date2"
              prepend-icon="date_range"
              :rules="date2Rules"
              label="Date To"
              required
              ></v-text-field>

              <v-text-field
              prepend-icon="person"
              v-model="result.fullname"
              label="Full Name"
              readonly
              ></v-text-field>

              <v-text-field
              prepend-icon="contact_phone"
              label="Mobile No"
              readonly
              ></v-text-field>

              <v-text-field
              prepend-icon="domain"
              label="Department"
              readonly
              ></v-text-field>

              <v-card-actions justify-center>
                <v-btn
                  :disabled="!valid"
                  @click="submit"
                >
                  PROCEED
                </v-btn>

                  <v-btn>CANCEL</v-btn>
              </v-card-actions>
            </v-flex>

          </v-card>
        </v-flex>

      </v-layout>
  </v-container>
  </v-form>
</template>
<script>
  export default {
    data () {
        return {
          result:[],
          arrayEvents: null,
          landscape: false,
          valid: true,
          date1: '',
          date1Rules:[
              v => !!v || 'Date From  is required'
          ],
          date2: '',
          date2Rules:[
            v => !!v || 'Date to  is required'
          ]
        }
      },
  methods: {
    functionEvents (date) {
      const [,, day] = date.split('-')
      return parseInt(day, 10) % 3 === 0
    },
    submit(){
      if (this.$refs.form.validate()) {
      }
    }
  }
  }
</script>
