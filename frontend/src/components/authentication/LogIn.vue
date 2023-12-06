
// copy from vutify
<template>
  <div class="image-form">
    <div class="image">
      <img
        src="../../assets/images/register.png"
        style="width: 100%; height: initial"
        alt="Image description"
      />
    </div>
    <v-form>
      <h1>Log in</h1>
        <v-text-field class="input"
            v-model="email" 
            :rules="emailRules"
            density="compact"
            placeholder="Enter your email"
            prepend-inner-icon="mdi-email"
            variant="outlined"
            color="#634B7A"
        ></v-text-field>
        <v-text-field   class="input"
          v-model="password" 
          :rules="passwordRules" 
          density="compact"
          placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="outlined"
          color="#634B7A"
          style="width: 103%;"
          :type="showPassword ? 'text' : 'password'">
          <template v-slot:append>
            <v-icon @click="showPassword = !showPassword">
              {{ showPassword ? 'mdi-eye' : 'mdi-eye-off' }}
            </v-icon>
          </template>
        </v-text-field>
        <p v-if="!valid" class="error-message">Incorrect password or email</p>
        <p class="forgot-password">
          <router-link to="/sendMail/forgetpwd">Forgot password</router-link>

        </p>
        <div class="btn">
          <v-btn @click="logIn" class="btn-log-in">submit</v-btn>
          <p class="log-in">
            Have not an account?<router-link to="/signUp">Sign up</router-link>
          </p>
        </div>
    </v-form>
  </div>
  </template>

  <script>
  import axios from 'axios'
  import Cookies from "js-cookie";
  export default {
      data() {
          return {
            email: '',
            password: '',
            valid: true,
            showPassword: false,
            emailRules: [
                value => !!value || 'Email is required',
                value => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(value) || 'E-mail must be valid',
            ],
            passwordRules: [
                value => !!value || 'Password is required',
                value => /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+{}|:"<>?~`]).{8,}$/.test(value) || 'Value required and should contain uppercase, lowercase, number, sign and more than 8 characters',
            ]
          }
      },
      methods:{
        logIn(){
          const data = {
          email: this.email,
          password: this.password,
          };
          axios.post(`${process.env.VUE_APP_API_URL}logIn`, data)
          .then((res) => {
            if (res.status === 200) {
              Cookies.set("userData", JSON.stringify(res.data), { expires: 30 });
              this.$router.push('/');
             
              
            } else {
              this.valid = false;
            }
          })
          .catch(() => {
            this.valid = false;
          });
        }
      }
  }
  </script>

  <style scoped>
  form{
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 20px;
    background: #ffffff;
    margin: auto ;
    flex: 1;
    
  }
  .image-form{
    margin: 20px; 
    display: flex;
  }
  .image{
    margin: 20px; 
    flex: 1;
  }

  h1{
    text-align: center;
    color: orange;
    margin-top: 20px;
    margin-bottom: 10px;
  }
  h3{
    margin-top: 10px;
  }
  .btn-log-in{
    background-color: #634b7a;
    
    color:#ffffff;
  }

 .error-message {
    color: rgb(172, 18, 18);
    font-size: small;
    margin-left: 2.5%;
  }
  .btn{
    display: flex;
    margin-top: 8%;
    margin-left: 1%;
  }
  .log-in {
    margin-bottom: 1%;
    margin-left: 45%;
    margin-top: 3%;
  }
  .forgot-password{
    margin-top: 1%;
    margin-bottom: -25px;
    margin-left: 1%;
  }
.input {
  position: relative;
}
.input .v-icon {
  position: absolute;
  top: 36%;
  left: calc(100% - 50px);
  transform: translateY(-50%);
  cursor: pointer;
}

</style>

