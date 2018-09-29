import Home from '../home/home.vue';
import Login from '../login/loginPage.vue';
import Register from '../register/registerPage.vue';
import Dashboard from '../dashboard/dashBoard.vue';
import Settings from '../settings/settings.vue';
import Requestleave from '../reqleave/reqleave.vue'
import Status from '../dashboard/statusInfo.vue';
import Message from '../dashboard/messagesInbox.vue';
import Annoucement from '../dashboard/annoucementBoard.vue';
import Confirm from '../confirmticket/confirmticket.vue';

import Admin from '../admin/adminPage.vue';
import ADashboard from '../admin/adashboard/adashboard.vue';
import Ticket from '../admin/ticket/ticket.vue';
export const routes = [
  {
    path: '/home',
    component: Home,
    name: 'Home',
    props: true,
    children: [
      {
        path: '/dashboard',
        component: Dashboard,
          children: [
            {
              path: '/dashboard/annoucementboard',
              component: Annoucement,
              name: 'Annoucement'
            },
            {
              path: '/dashboard/messagesinbox',
              component: Message,
              name: 'Message'
            },
            {
              path: '/dashboard/statusinfo',
              component: Status,
              name: 'Status'
            }
          ]

      },
      {
        path: '/confirmticket',
        component: Confirm
      },
      {
        path: '/reqleave',
        component: Requestleave
      },
      {
        path: '/settings',
        component: Settings
      }
    ]
  },
  {
    path: '/admin',
    component: Admin,
    children: [
      {
        path: '/adashboard/adashboard',
        component: ADashboard,
        name: 'ADashboard'
      },
      {
      path: '/ticket/ticket',
      component: Ticket,
      name: 'Ticket'
    }
    ]
  },
  {
    path: '/login',
    component: Login
  },
  {
    path: '/register',
    component: Register
  }
];



export default routes
