// copy from register form
<template>
    <v-container> 
        <div class="container"  >
          <div class="image">
            <img 
              src="../../assets/images/apply.jpg"
              style="width: 500px; height: 500px"
              alt="Image description"
            />
        </div>
      <div class="form-container" id='myform'>
        <form style="height: 300px;">
          <h1>Join Our University</h1>

          <label for="major">Select your major*</label>
          <select class="select" name='major' v-model="skill_id">
            <option  v-for="major in majors" :key="major.id" :value="major.id">{{major.name}}</option>
          </select>
       

          <!-- Education level -->
          <v-select
            label="Enter you education level"
            :items="['High school diploma','Associate degree']"
            class="err"
            color="#634B7A"
            :type="visible ? 'text' : 'Education levelEducation level'"
            density="compact"
            placeholder="Enter your education level"
            prepend-inner-icon="mdi-school-outline"
            variant="outlined"
            @click:append-inner="visible = !visible"
            v-model="study_level"
            required
            @input="v$.education_level.$touch"
            @blur="v$.education_level.$touch"
          ></v-select>
          <!-- select year -->
          <v-select
            label="Choose year"
            :items="['1st Year','2nd year','3rd Year', '4th Year']"
            class="err"
            color="#634B7A"
            :type="visible ? 'text' : 'Choose the year you want to study'"
            density="compact"
            placeholder="Choose the year you want to study"
            prepend-inner-icon="mdi mdi-finance"
            variant="outlined"
            @click:append-inner="visible = !visible"
            v-model="year"
            required
            @input="v$.year.$touch"
            @blur="v$.year.$touch"
          ></v-select>
          
          <!-- check box -->
          <v-checkbox
            class="err"
            v-model="state.checkbox"
            :error-messages="v$.checkbox.$errors.map((e) => e.$message)"
            label="Do you agree?"
            required
            @change="v$.checkbox.$touch"
            @blur="v$.checkbox.$touch"
          ></v-checkbox>

          <div class="btn d-flex justify-space-between">
            <div class="btn">
                <v-btn class="btnone"
                  color="purple-darken-1"
                  variant="text"
                  @click=" cancel" >
                  Cancel
                  </v-btn>
            </div>
            <div class="btn">
              <div class="btn" v-if="skill_id!='' && year!='' && study_level!=''">
                <v-btn class="me-4" @click="apply">Apply</v-btn>
              </div>
              <div class="btn" v-else>
                <v-btn class="me-4" >Apply</v-btn>
              </div>
        
            </div>
          </div>
        </form>
      </div>
  </div>
  </v-container>
</template>
<script> 
  export default {
    data() {
      return {
        selected: '',
        majors:'',
        skill_id:'',
        school_id: '',
        user_id:'',
        year:'',
        study_level:'',
      }
    },
    methods:{
      getMajor(){
        axios.get(`${process.env.VUE_APP_API_URL}majors`).then((res)=>{
        this.majors = res.data.data
        })
      },
      cancel(){
        this.skill_id='',
        this.study_level="",
        this.year=''
        this.$router.push("/")
      },
      apply(){
        const userData = Cookies.get('userData');
        if (userData) {
          const userDataObj = JSON.parse(userData);
          this.user_id = userDataObj.data.id;
          const newApply = {
            user_id: this.user_id,
            skill_id: this.skill_id,
            school_id:this.$route.params.school_id,
            year: this.year,
            study_level:this.study_level,
          }
          console.log(newApply)
         axios.post(`${process.env.VUE_APP_API_URL}apply`, newApply)
         .then(()=>{
          this.$router.push("/")
         })
        }
      }
    },
    mounted(){
      this.getMajor()
    }  
}


</script>
<script setup>
import { reactive } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { required} from "@vuelidate/validators";
import Cookies from 'js-cookie';
import axios from "axios";

const initialState = {
  major: "",
  selected:'',
  education_level: "",
  year: "",
  checkbox: null,
  emailTakenError: false,
  visible: false,
};
const state = reactive(Object.assign({}, initialState));


// Rule for name email password
const rules = {
  selected: {required},
  major: {required},
  education_level: {required},
  year: {required},
  checkbox: { required },
};

// Clear validation when input correct
const v$ = useVuelidate(rules, state);


</script>

<style scoped>
.date{
  border: 1px solid rgba(128, 128, 128, 0.518);
  padding: 7px;
  border-radius: 4px;
  margin-bottom: 6%;

}
.select{
  width: 100%;
  border: 1px solid rgb(135, 132, 132);
  /* outline-style: solid; */
  padding: 13px;
  margin-bottom: 10px;
  border-radius: 5px;
}
.date{
  width: 500px;
}

img{
  margin-top: 22%;
}
form{
  margin-top: -25%;
}
.container {
  display: flex;
  margin-top: 3%;
}
.image {
  flex: 1;
  margin-left: -50px;
}
.btn {
  display: flex;
  margin-top: 3%;
  margin-top: -1%;
}
h1 {
  margin-bottom: 75px;
  margin-top: 10px;
  color: #634b7a;
  text-align: center;
}
.err {
  text-align: start;
}
.text-error {
  text-align: start;
  font-family: sans-serif;
  font-size: 12px;
  margin-bottom: 15px;
  margin-top: -20px;
  margin-left: 15px;
}
label {
  color: #634b7a;
}
.form-container {
  box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
  background-color: #fff;
  margin-right: 60px;
  margin-top: 40px;
  margin-bottom: 10px;
  margin: 60px;
  flex: 1;
  padding: 35px;
  border-radius: 10px;
}
.btn > div > div > button {
  background-color: #634b7a;
  color: #f6eeee;
  margin-left: 10px;
}
.link-sign-up {
  color: #fff;
  background-color: #634b7a;
  text-decoration: none;
}
.selectbox{
  margin-top: -9%;
  margin-left: -6%;
  margin-bottom: -10%;
}
.male{
   margin-left: -45%;
}
</style>