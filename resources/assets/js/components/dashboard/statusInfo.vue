<template>
  <v-stepper v-model="e6" vertical>
    <v-stepper-step :complete="e6 > 1" step="1">
      <small>You Submitted your Request</small>
    </v-stepper-step>

    <v-stepper-content step="1">
      <v-card-text>Reviewing your Request</v-card-text>
    </v-stepper-content>

    <v-stepper-step :complete="e6 > 2" step="2">Admin Approval</v-stepper-step>

    <v-stepper-content step="2">
      <v-card-text>Admin Approved your Vacation Leave</v-card-text>
    </v-stepper-content>

    <v-stepper-step :complete="e6 > 3" step="3">Ticket Inssuance</v-stepper-step>

    <v-stepper-content step="3">
      <v-card-text>You Can now claim your ticket</v-card-text>
    </v-stepper-content>

    <v-stepper-step step="4">Finish</v-stepper-step>
    <v-stepper-content step="4">
       <v-card-text>Have safe flight..</v-card-text>
    </v-stepper-content>
  </v-stepper>
</template>
<script>
  export default {
    data () {
      return {
        e6: 1
      }
    }
  }
</script>
