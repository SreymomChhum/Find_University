<template>
  <div class="form-container">
    <div class="image">
      <img
          src="../../assets/images/forgotPassword.png"
          style="width: 100%; height: initial"
          alt="Image description"
      /> 
    </div>
    <form >
      <h1>Change password</h1>
      <p class="text-reset">
        Please input email and new password
      </p>
      <v-text-field
        class="err"
        v-model="email"
        required
        density="compact"
        placeholder="Enter your email"
        prepend-inner-icon="mdi-email"
        variant="outlined"
        color="#634B7A"
      ></v-text-field>
      <div class="password">
      <v-text-field
        :type="showPassword ? 'text' : 'password'"
        id="password"
        v-model="password"
        @input="validatePassword"
        :append-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
        @click:append="showPassword = !showPassword"
        label="Password"
        required
        :rules="[passwordRule]"
      ></v-text-field>
      <span v-if="showValidationMessage">{{ validationMessage }}</span>

      </div>

      <div class="btn">
        <div class="reset">
          <v-btn to="/changePassword" class="me-4 send-email" @click="resetPassword()" type="submit">Send</v-btn>
        </div>
 
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios'
// import api_base from '../../router/api.js'

export default{

  data(){
    return{
      email: '',
      password: '',
      errors: null,
      // show1: false,
      showValidationMessage: false,
      validationMessage: '',
      showPassword: false
    }
  },
  methods:{
    resetPassword() {
      axios.patch(`${process.env.VUE_APP_API_URL}resetPassword`, {email:this.email,password:this.password})
      .then((response)=>{
        console.log(response.data.data);
        this.$router.push('/')
      }).catch((error)=>{
        console.log(error);
        this.$router.push('/resetPassword')
        alert("please input right email this email not found")
      })
    },

    /* //"https://fontawesomeicons.com/tryit/code/vue-js-password-validation-regex/0" */

    validatePassword() {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!this.password) {
            this.showValidationMessage = false;
            return;
        }
        if (passwordRegex.test(this.password)) {
            this.showValidationMessage = false;
        } else {
            this.showValidationMessage = true;
           this.validationMessage = 'Password must contain lowercase letter, uppercase letter,  digit, special character, and be at least 8 characters long.';
        }
    },



  }
}

</script>

<style scoped>
h1 {
  margin-bottom: 25px;
  margin-top: -5px;
  text-align: center;
}
label {
  color: #634b7a;
}
.image {
  flex: 1;
}
span{
  color: red;
}
.image img {
  max-width: 90%;
  height: auto;
}

.form-container {
  width: 70%;
  box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
  background-color: #e7e9e3;
  flex: 1;
  padding: 35px;
  margin: 40px 0px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  margin-left: 15%;
}

.send-email{
    background-color: #634b7a;
    color: #f6eeee;
    margin-left: 4px;
    margin-top: 15px;
    width: 40px;
}
.error {
  color: red;
  margin-top: 10px;
}

form{
  padding: 20px;
  width: 50%;
  background-color: #e1e4dba9;

}
</style>