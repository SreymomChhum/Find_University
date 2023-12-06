
<template>
  <div class="d-flex justify-space-around">
    <v-menu>
      <template v-slot:activator="{ props }">
        <v-img
          v-bind="props"
          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRW1hrg-gaH6FpxGG2kEJ1_YSqoCe_wccQHQA&usqp=CAU"
          class="ml-5 accout-img"
          width="35"
          height="35"
          contain
        ></v-img>
      </template>
      <v-list class="menu-list" style="width: 100%;  background-color: #634b7a">
          <div class="icon-item">
            <v-icon class="logout-icon text-white me-2" size="20">mdi-account</v-icon>
            <div class="username">{{ userName }}</div>
          </div>
          <div class="icon-item">
            <v-icon class="logout-icon text-white me-2" size="20" @click="submitLogOut" >mdi-logout</v-icon>
            <div class="icon-log-out" @click="submitLogOut">log out</div>
          </div>
          <div class="icon-item" v-if="role_id===2">
            <v-icon class="logout-icon text-white me-2" size="20"  @click="university">mdi-domain</v-icon>
            <div class="icon-log-out" @click="university">University Page</div>
          </div>
          <div class="icon-item" v-if="role_id===3">
            <v-icon class="logout-icon text-white me-2" size="20"  @click="admin">mdi-domain</v-icon>
            <div class="icon-log-out" @click="admin">Admin Page</div>
          </div>
      </v-list>
    </v-menu>
  </div>
</template>
<script>
import axios from 'axios';
import Cookies from 'js-cookie';

export default {
  name: "UserMenu",
  emits: ["submitLogOut"],
  props: ["showMenu", "userName",'role_id'],
  data() {
    return {
     
    };
  },
  methods: {
    submitLogOut() {

      if (confirm("Are you sure you want to log out?")) {
        this.$router.push("/")
        axios
          .get(`${ process.env.VUE_APP_API_URL}logOut`)
          .then(() => {
            Cookies.remove("userData");
            delete axios.defaults.headers.common["Authorization"];
            location.reload();
            this.$router.push("/");
          })
          .catch(() => {
            Cookies.remove("userData");
            delete axios.defaults.headers.common["Authorization"];
            location.reload();
          
          });
      }
    },
    university(){
       this.$router.push("/university");
    },
    admin(){
       this.$router.push("/admin");
    }
    
  },

};
</script>

<style scoped>
.icon-item{
  margin: 10px;
}
.accout-img{
  border-radius: 50%;
}
.icon-item {
  display: flex;
}

.username,
.icon-log-out {
  color: #ffff;
  font-size: 14px;
  font-weight: bold;
  text-align: center;
}
</style>
