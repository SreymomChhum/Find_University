// https://vuetifyjs.com/en/components/dialogs/
<template>
  <v-row justify="center">
    <!-- first diolog -->
    <template v-if="!isLoggedIn">
    <v-dialog
      v-model="dialog"
      persistent
      width="500px"
    >
      <template v-slot:activator="{ props }">
        <p v-bind="props"  @click="getId">Join</p>
      </template>
      <v-card>
        <v-card-title class="text-h5">
          Do you have an account?
        </v-card-title>
        <div style="text-align:center;">
          <img src="../../assets/images/profile.jpg" alt="" width="300" height="300"/>
        </div>
        <v-card-text class="text" style="text-align:center;">Register now to join our workshop.</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="purple"
            variant="text"
            @click="dialog = false" 
          >
            CENCEL
          </v-btn>
          <v-btn
            variant="text"
            @click="dialog = false"
          >
            <router-link to="/signUp" style="color: purple; text-decoration: none;"
              >REGISTER</router-link>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </template>

    <!-- 2nd diolog -->
     <template v-else>
        <v-dialog
      v-model="dialog"
      persistent
      width="500px"
    >
    
      <template v-slot:activator="{ props }">
        <p v-bind="props">Join</p>
      </template>
      <v-card>
        <v-card-title class="text-h5">
          Do you want to join the workshop?
        </v-card-title>
        <div style="text-align:center;">
          <img src="../../assets/images/workshop.jpg" alt="" width="300" height="250"/>
        </div>
        <v-card-text class="text" style="text-align:center;">Join our workshop. </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="purple"
            variant="text"
            @click="dialog = false"
          >
            NO
          </v-btn>
          <v-btn
            variant="text"
            @click="closeDialogAndJoinWorkshop" 
            
          >
            <router-link to="/" style="color: purple; text-decoration: none;"
              >YES</router-link>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </template>
  </v-row>
</template>

<script>
import Cookies from 'js-cookie';
import axios from 'axios';
export default {
  props:["workshop_id"],
    data() {
    return {
      isLoggedIn: false,
      dialog: false,
      userId: ''
    };
  },
    mounted() {
    this.setUser();
  },
  methods: {
    closeDialogAndJoinWorkshop() {
    this.dialog = false;
    this.joinWorkshop();
  },
  joinWorkshop() {
      // Get user_id and workshop_id from cookie
        const userData = Cookies.get('userData');
        if (userData) {
          const userDataObj = JSON.parse(userData);
        this.userId = userDataObj.data.id;
        axios.post('http://127.0.0.1:8000/api/registerWorkShop', {
          workshop_id: this.workshop_id,
          user_id: this.userId,
        }).then(response => {
          console.log(response.data);
        }).catch(error => {
          console.log(error(error));
        })
      }
  },
  getId(){
    this.$emit('get_id')
  },
  setUser() {
      const userData = Cookies.get('userData');
      if (userData) {
        const userDataObj = JSON.parse(userData);
        this.userId = userDataObj.data.id;
        this.isLoggedIn = true;
      }
    },
  }
}
</script>

<style scoped>
.text-h5{
  color: orange;
}
.text{
  color: #634b7a;
}
p{
  color: white;
  background-color: purple;
  padding: 5px;
  width: 70px;
  text-align: center;
  border-radius: 5px;
  margin-bottom: 25%;
  margin-right: 15%;
}
</style>