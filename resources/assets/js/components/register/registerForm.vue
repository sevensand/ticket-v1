<template>

  <v-form ref="form" v-model="valid" lazy-validation>

    <v-text-field
      v-model="employeeid"
      :rules="employeeRules"
      label="Employee Id"
      color="cyan"
      prepend-icon="perm_contact_calendar"
      required
      :error-messages="employeeidMatchError"
    ></v-text-field>

    <v-text-field
      v-model="passportno"
      :rules="passportnoRules"
      label="Passport No"
      color="cyan"
      prepend-icon="account_box"
      required
      :error-messages="passportnoMatchError"
    ></v-text-field>

<v-layout>

    <v-flex xs6>
      <v-text-field
        prepend-icon="contacts"
        v-model="firstname"
        :rules="firstnameRules"
        label="Firstname"
        color="cyan"
        required
        readonly
      ></v-text-field>

       </v-flex>
         <v-flex xs6>
           <v-text-field
             prepend-icon="contacts"
             v-model="lastname"
             :rules="lastnameRules"
             label="Lastname"
             color="cyan"
             required
             readonly
           ></v-text-field>
         </v-flex>
</v-layout>


<v-layout>
    <v-flex xs6>
      <v-text-field
        prepend-icon="contacts"
        v-model="middlename"
        :rules="middlenameRules"
        label="Middlename"
        color="cyan"
        required
        readonly
      ></v-text-field>
       </v-flex>
         <v-flex xs6>
           <v-text-field
             prepend-icon="contact_phone"
             v-model="mobileno"
             label="Mobile No"
             color="cyan"
             required
             readonly
           ></v-text-field>
         </v-flex>
</v-layout>

<v-layout>
    <v-flex xs6>
      <v-select
        v-model="select"
        :items="department"
        :rules="[v => !!v || 'Department is required']"
        label="Department"
        color="cyan"
        prepend-icon="business"
        required
        readonly
      ></v-select>
       </v-flex>
         <v-flex xs6>
           <v-menu
             ref="menu"
             :close-on-content-click="false"
             v-model="menu"
             :nudge-right="40"
             :return-value.sync="datejoin"
             lazy
             transition="scale-transition"
             offset-y
             full-width
             min-width="290px"
           >
             <v-text-field
               slot="activator"
               v-model="datejoin"
               :rules="datejoinRules"
               label="Date Joined"
               prepend-icon="event"
               readonly
             ></v-text-field>
             <v-date-picker v-model="datejoin" no-title scrollable>
               <v-spacer></v-spacer>
               <v-btn flat color="primary" @click="menu = false">Cancel</v-btn>
               <v-btn flat color="primary" @click="$refs.menu.save(datejoin)">OK</v-btn>
             </v-date-picker>
           </v-menu>
         </v-flex>
</v-layout>

    <v-text-field
      v-model="username"
      :rules="usernameRules"
      label="Username"
      color="cyan"
      prepend-icon="account_circle"
      required
      readonly
    ></v-text-field>

    <v-text-field
      v-model="password"
      :rules="passwordRules"
      label="Password"
      type="password"
      color="cyan"
      prepend-icon="lock"
    ></v-text-field>


    <v-text-field
      v-model="password_confirmation"
      :rules="password_confirmRules"
      label="Confirm Password"
      type="password"
      prepend-icon="lock"
      color="cyan"
      required
    ></v-text-field>

    <v-btn
      :disabled="!valid"
      @click="submit"
    >
      submit
    </v-btn>
    <v-btn @click="clear">clear</v-btn>
  </v-form>
</template>

<script>
import axios from 'axios'
import router from  '../routes/routes';
 export default {
   data: () => ({
     result: [],
     valid: true,
     date: null,
     userQuery: null,
     userPassport: null,
     resultuser: {},
     menu: false,
     employeeid: '',
     employeeRules: [
       v => !!v || 'Employee Id is required'
     ],
     passportno: '',
     passportnoRules: [
       v => !!v || 'Passport No is required'
     ],

     firstname: null,
     firstnameRules: [
       v => !!v || 'Firstname is required'
     ],

     lastname: '',
     lastnameRules: [
       v => !!v || 'Lastname is required'
     ],

     middlename: '',
     middlenameRules: [
       v => !!v || 'Middlename is required'
     ],

     mobileno: '',
     datejoin: '',
     datejoinRules: [
       v => !!v || 'Date Joined is required'
     ],


     username: '',
     usernameRules: [
       v => !!v || 'Username is required'
     ],

     password: '',
     passwordRules: [
       v => !!v || 'Password is required'
     ],
     password_confirmation: '',
     password_confirmRules:[
       v => !!v || 'Password Confirmation is required'
     ],

     select: null,
     department: [
       'IT',
       'Account',
       'Purchasing',
       'Sales',
       'HR'
     ]
   }),
   methods: {
     submit () {
       if (this.$refs.form.validate()) {

         axios.post('/api/v1/register', {
           employeeid: this.employeeid,
           passportno: this.passportno,
           firstname: this.firstname,
           lastname: this.lastname,
           middlename: this.middlename,
           mobileno: this.mobileno,
           department: this.select,
           datejoin: this.datejoin,
           username: this.username,
           password: this.password,
           password_confirmation: this.password
         }).then(response => {
           this.userexist = response.data
           if(this.userexist.status == 'error') {
             this.$toaster.warning('This user already registered!!');
           } else {
             this.results = response.data
             this.$toaster.success('Registered Successfully');
             this.$router.push('/login');
           }

         })
       };
     },
     clear () {
       this.$refs.form.reset()
     }
   },
   computed: {
     fetchUser(){
       return this.employeeid
     },
     fetchPassport(){
       return this.passportno
     },
     employeeidMatchError(userQuery){
       if(this.employeeid == ''){
       }else {
         return(this.userQuery == this.employeeid) ? '' : 'Employee Id not Matched!!!'
       }
     },
     passportnoMatchError(userPassport){
       if(this.passportno == ''){
       }else{
         return(this.userPassport == this.passportno) ? '' : 'Employee Id and Passport No matched!!!'
       }
     }
   },
   watch: {
     fetchUser(val){
       axios.post('/api/v1/userinfo', {
         employeeid: val
       }).then(response => {
          this.result = response.data.data
          if(this.result.employeeid == val) {
            this.userQuery = this.result.employeeid
          } else {
            console.log('Not Found!!!')
          }
       }).catch(err => {
         console.log('Not Found!!!!')
       })
     },
     fetchPassport(val){
       axios.post('/api/v1/validate', {
         employeeid: this.employeeid,
         passportno: val
       }).then(response => {
         this.resultuser = response.data.data
         if(this.resultuser.employeeid == this.employeeid && this.resultuser.passportno == val){
           this.userPassport = this.resultuser.passportno
           this.firstname = this.resultuser.firstname
           this.lastname = this.resultuser.lastname
           this.middlename = this.resultuser.middlename
           this.select = this.resultuser.department
           this.datejoin = this.resultuser.datejoin
           this.mobileno = this.resultuser.mobileno
           this.username = this.resultuser.employeeid

         } else {
           console.log('Employee Id and Passport No not Matched!')
         }
       }).catch(err => {
         console.log('Employee Id and Passport No not Matched')
       })
     }
    }
 }
</script>
