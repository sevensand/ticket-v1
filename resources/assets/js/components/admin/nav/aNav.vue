<template>
  <div id="app">
  <v-app dark>
    <v-navigation-drawer
      v-model="drawer"
      clipped
      fixed
      app
    >

    <v-list>
       <v-list-tile
         v-for="item in items"
         :to="item.path == '#' ? '' : item.path"
         :key="item.title"
         :exact="item.exact"
       >
         <v-list-tile-action>
           <v-icon>{{ item.icon }}</v-icon>
         </v-list-tile-action>

         <v-list-tile-content>
           <v-list-tile-title>{{ item.title }}</v-list-tile-title>
         </v-list-tile-content>
       </v-list-tile>
     </v-list>

    </v-navigation-drawer>


    <v-toolbar
          :clipped-left="$vuetify.breakpoint.lgAndUp"
           color="cyan darken-4"
          app
          fixed
        >
          <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <span class="hidden-sm-and-down"><img src="../../../../../assets/img/logo.png" class="dashboard_logo"></span>
          </v-toolbar-title>
          <v-spacer></v-spacer>
        <v-btn icon large>
          <img src="../../../../../assets/img/avatar.png" class="dashboard_logo">
        </v-btn>
          <v-btn icon>
            <v-badge color="red" overlap>
              <span slot="badge">2</span>
            <v-icon>mail_outline</v-icon>
            </v-badge>
          </v-btn>


      <v-btn icon>
        <v-badge color="red" overlap>
          <span slot="badge">3</span>
        <v-icon
        >notifications</v-icon>

          </v-badge>
      </v-btn>

          <v-btn icon>
            <v-icon
            @click="logout"
            >power_settings_new</v-icon>
          </v-btn>
        </v-toolbar>


    <main>
      <v-container fluid>
          <v-fade-transition mode="out-in">
            <router-view></router-view>
          </v-fade-transition>
      </v-container>
    </main>



    <v-footer app fixed>
      <span>&copy; Nabco Apps 2018</span>
    </v-footer>
  </v-app>
</div>

</template>

<script>
import { bus } from '../../../app';
import router from '../../routes/routes';
  export default {
    count: 0,
    router,
    data() {
      return {
        drawer: true,
        clipped: false,
        result: [],
        items: [
          {
            icon: 'dashboard',
            title: 'Dashboard',
            path: '/adashboard/adashboard'
          },
          {
            icon: 'backup',
            title: 'Upload Ticket',
            path: '/ticket/ticket'
          }
        ]
      }
    },
    props: {
      source: String
    },
    methods: {
      logout() {
        var token = localStorage.getItem('token');
        axios.get('../api/v1/logout/' + token, {
        }).then(response=> {
           this.$router.push('/login');
        }).catch(err => {
            this.$toaster.error('Token Expired!');
            this.$router.push('/login');
        });
      }
    }
  }
</script>
