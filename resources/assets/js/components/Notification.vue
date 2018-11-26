<!--
// <template>
//     <li class="nav-item dropdown">
//         <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"aria-haspopup="true"
//         aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge badge-primary">{{ notifications.length }}</span> <span class="clearfix d-none d-sm-inline-block">Notifications</span></a>
//         <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
//             <li v-for="notification in notifications">
//                 <a class="dropdown-item" href="#" v-on:click="MarkAsRead(notification)">
//                 {{ notification.data.data.itemName }} 
//                 has gone beyond <br>it's limit.  
//                 </a>
//             </li>
//             <li v-if="notifications.length == 0">
//                 There is no new Notifications
//             </li>
              
//         </div>              
//     </li> 
// </template>

// <script>
//     export default {
//         props: ['notifications'],
//         methods: {
//             MarkAsRead: function(notification){
//                 var data = {
//                     id: notification.id
//                 };
//                 axios.post('http://localhost/restapp/public/notification/read', data).then(response =>{
//                     //can redirect the page into something you like 
//                     //window.location.href = 'link'
//                 })
//             }
//         }
//     }
// </script>
-->