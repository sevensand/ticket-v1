<template>

<v-form ref="form" v-model="valid" lazy-validation>

        <v-layout>
          <v-flex xs6>
            <v-text-field
          prepend-icon="assignment_ind"
          v-model="result.id"
          label="Account Id"
          readonly
          ></v-text-field>
          </v-flex>

          <v-flex xs6>
            <v-text-field
          prepend-icon="date_range"
          v-model="result.datejoin"
          label="Date Joined"
          readonly
          ></v-text-field>
          </v-flex>
        </v-layout>

  <v-layout>
    <v-flex xs6>
      <v-text-field
      prepend-icon="assignment_ind"
      v-model="result.employeeid"
      :rules="employeeidRules"
      label="Employee Id"
      required
      ></v-text-field>
    </v-flex>

    <v-flex xs6>
      <v-text-field
      prepend-icon="date_range"
      v-model="result.passportno"
      :rules="passportnoRules"
      label="Passport No"
      required
      ></v-text-field>
    </v-flex>
  </v-layout>



  <v-layout>
    <v-flex xs6>
      <v-text-field
      prepend-icon="contacts"
      v-model="result.firstname"
      :rules="firstnameRules"
      label="First Name"
      required
      ></v-text-field>
    </v-flex>
    <v-flex xs6>
      <v-text-field
      prepend-icon="contacts"
      v-model="result.lastname"
      :rules="lastnameRules"
      label="Last Name"
      required
      ></v-text-field>
    </v-flex>
    <v-flex xs6>
      <v-text-field
      prepend-icon="contacts"
      v-model="result.middlename"
      :rules="middlenameRules"
      label="Middle Name"
      required
      ></v-text-field>
    </v-flex>
  </v-layout>


  <v-layout>
    <v-flex xs6>
      <v-text-field
      prepend-icon="date_range"
      v-model="result.passexp"
      label="Passport Expiration"
      required
      ></v-text-field>
    </v-flex>
    <v-flex xs6>
      <v-text-field
      prepend-icon="date_range"
      v-model="result.qidexp"
      label="Qatar ID Expiration"
      required
      ></v-text-field>
    </v-flex>
    <v-flex xs6>
      <v-text-field
      prepend-icon="date_range"
      v-model="result.midexp"
      label="Medical ID Expiration"
      required
      ></v-text-field>
    </v-flex>
  </v-layout>


      <v-layout>
               <v-flex xs6>
                 <v-text-field
                 prepend-icon="contact_phone"
                 v-model="result.mobileno"
                 :rules="mobilenoRules"
                 label="Mobile No"
                 required
                 ></v-text-field>
             </v-flex>
             <v-flex xs6>
               <v-select
                 prepend-icon="domain"
                 v-model="result.department"
                 :items="department"
                 :rules="[v => !!v || 'Department is required']"
                 label="Department"
                 color="cyan"
                 required
               ></v-select>
             </v-flex>
      </v-layout>



      <v-card-actions justify-center>
        <v-btn
          :disabled="!valid"
          @click="submit"
        >
          SUBMIT
        </v-btn>

          <v-btn>CANCEL</v-btn>
      </v-card-actions>

    </v-form>

</template>

<script>
  export default {
    data() {
      return {
        result: [],
        valid: true,
        passportnoRules: [
          v => !!v || 'Passport No is required'
        ],
        firstnameRules: [
          v => !!v || 'First Name is required'
        ],
        lastnameRules: [
          v => !!v || 'Last Name is required'
        ],
        middlenameRules: [
          v => !!v || 'Middle Name is required'
        ],
        mobilenoRules: [
          v => !!v || 'Mobile No is required'
        ],
        employeeidRules: [
          v => !!v || 'Employee Id is required'
        ],
        select: null,
        department: [
          'IT',
          'Account',
          'Purchasing',
          'Sales',
          'HR'
        ]
      }
    },
    mounted() {
      this.fetchUser();
    },
    methods: {
      fetchUser: function() {
        var token = localStorage.getItem('token');
        const authStr = 'Bearer' .concat(token);
        axios.get('api/users', { headers: { Authorization: authStr } })
        .then(response => {
          this.result = response.data;
        }).catch(err => {
            this.$toaster.error('Token Expired!');
            this.$router.push('/login');
        });
      },
      submit () {
        if (this.$refs.form.validate()) {
          var token = localStorage.getItem('token');
          axios.post('/api/v1/update', {
            remember_token: token,
            id: this.result.id,
            employeeid: this.result.employeeid,
            passportno: this.result.passportno,
            firstname: this.result.firstname,
            lastname: this.result.lastname,
            middlename: this.result.middlename,
            passexp: this.result.passexp,
            qidexp: this.result.qidexp,
            midexp: this.result.midexp,
            mobileno: this.result.mobileno,
            department: this.result.department,
          }).then(response => {
            this.res = response.data
            this.$toaster.success('Updated Successfully');
          })
        } else {
          this.$toaster.error('Something Wrong!!!');
        };
      }
    }
  }
</script>
