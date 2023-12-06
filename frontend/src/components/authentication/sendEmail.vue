<template>
      <div class="form-container">
        <div class="image">
          <img
              src="../../assets/images/forgotPassword.png"
              style="width: 100%; height: initial"
              alt="Image description"
          /> 
        </div>
        <form @submit.prevent='submit'>
        <h1 v-if="title=='forgetpwd'">Did you forget password?</h1>
        <h1 v-if="title=='register'">Request to admin!</h1>
        <p class="text-reset">
        Please input your Email here
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
        <div class="btn">
            <div class="reset">
            <v-btn class="me-4 send-email" v-if="title=='forgetpwd'" @click="forgetPwdMail()"  type="submit">Send</v-btn>
            </div>
            <div class="reset">
            <v-btn class="me-4 send-email" v-if="title=='register'" @click="registerMail()"  type="submit">Send</v-btn>
            </div>
    
        </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios'

export default{
  data(){
    return{
      email: '',
      errors: null,
      title:''

    }
  },

  methods:{
    forgetPwdMail() {

      axios.post(`${ process.env.VUE_APP_API_URL}sendMail`,{email:this.email})
      .then((response)=>{
        console.log(response)
        if(!this.email==""){
          this.$router.push('/')
        }

      })
    },
    registerMail(){
      axios.post(`${ process.env.VUE_APP_API_URL}registerMail`,{email:this.email})
      .then((response)=>{
        console.log(response)
        if(!this.email==""){
          this.$router.push('/')
        }

      })
    },
    pageTitle(){
       this.title = this.$route.params.title
    }
  },
  mounted(){
    this.pageTitle()
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