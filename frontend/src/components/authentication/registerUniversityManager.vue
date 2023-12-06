<template>
    <div class="groupForm">
        <v-form v-model="valid">
            <h2 style="margin-top:-12px">User data</h2> 
            <div class="item">
                <v-text-field 
                    v-model="name" 
                    :rules="nameRules" 
                    label="user_name"
                    required
                    density="compact"
                    placeholder="Enter your name"
                    variant="outlined"
                    color="#634B7A"
                    class="input-field"
                ></v-text-field>
                <v-select
                    v-model="gender"
                    :rules="genderRules" 
                    :items="['Male', 'Female', 'other']"
                    label="Gender"
                    required
                    density="compact"
                    placeholder="choose the user gender"
                    variant="outlined"
                    color="#634B7A"
                    class="input-field"
                ></v-select>
                
                
            </div>
            <div class="item">
                <v-text-field 
                    v-model="email" 
                    label="Email" 
                    :rules="emailRules"
                    density="compact"
                    placeholder="Enter your email"
                    variant="outlined"
                    color="#634B7A"
                    class="input-field"
                ></v-text-field>
                <v-text-field 
                    v-model="phone" 
                    label="Phone" 
                    :rules="phoneRules"
                    density="compact"
                    placeholder="Enter your phone number"
                    variant="outlined"
                    color="#634B7A"
                    class="input-field"
                ></v-text-field>
            </div>
            <div class="item">
                <v-text-field 
                    v-model="password" 
                    label="Password" 
                    :rules="PasswordRules"
                    density="compact"
                    placeholder="Enter your password"
                    variant="outlined"
                    color="#634B7A"
                    class="input-field"
                ></v-text-field>
                <v-text-field 
                    v-model="userAddressName" 
                    label="Address_name" 
                    :rules="userAddressesNameRule"
                    density="compact"
                    placeholder="Enter your address name"
                    variant="outlined"
                    color="#634B7A"
                    class="input-field"
                ></v-text-field>
            </div>
            <div class="item">
                <v-text-field 
                    v-model="userAddressesStreet" 
                    label="Enter_the_street" 
                    :rules="userStreetRules"
                    density="compact"
                    placeholder="Enter the street of user"
                    variant="outlined"
                    color="#634B7A"
                    class="input-field"
                ></v-text-field>
                <v-text-field 
                    v-model="userAddressesLink" 
                    label="link_addresses"  
                    :rules="userLinkRules"
                    density="compact"
                    placeholder="Enter your link address"
                    variant="outlined"
                    color="#634B7A"
                    class="input-field"
                ></v-text-field>
            </div>
            <h2 style="margin-top:-12px">Universty data</h2> 
            <v-text-field
                v-model="universityName"
                required
                density="compact"
                placeholder="Enter your school name"
                label="university_name"
                variant="outlined"
                color="#634B7A"
                :rules="universityNameRules"
            ></v-text-field>

            <div class="item"> 
                <v-text-field 
                    v-model="universityAddressesName" 
                    label="university_address_name" 
                    :rules="universityAddressesNameRule"
                    density="compact"
                    placeholder="Enter your university address  name"
                    variant="outlined"
                    color="#634B7A"
                    class="input-field"
                ></v-text-field> 
                 <v-select
                    v-model="schoolType"
                    :rules="schoolTypesRule" 
                    :items="schoolTypes"
                    label="Type_of_school"
                    required
                    density="compact"
                    placeholder="choose type of school"
                    variant="outlined"
                    color="#634B7A"
                    class="input-field"
                ></v-select>
            </div>
            
            <div class="item">
                <v-text-field 
                    v-model="universityAddressesStreet" 
                    label="street" 
                    :rules="universityStreetRules"
                    density="compact"
                    placeholder="Enter university street"
                    variant="outlined"
                    color="#634B7A"
                    class="input-field"
                ></v-text-field>
                <v-text-field 
                    v-model="universityAddressesLink" 
                    label="link_address"  
                    :rules="universityLinkRules"
                    density="compact"
                    placeholder="Enter your link address"
                    variant="outlined"
                    color="#634B7A"
                    class="input-field"
                ></v-text-field>
            </div>
            <p>Choose Major</p>
            <v-container fluid class="pt-0"  id="checkbox">
                <v-checkbox
                    v-for="skill in skills" :key="skill"
                    v-model="skillSelect"
                    :label=skill.name
                    :value="skill.id"
                    :rules="checkboxRules"
                    
                    style="height:30px"
                ></v-checkbox>
                <p v-if="errors.length">
                    <span v-for="error in errors" :key="error" style="color:#ae2012; font-size:13px">
                        {{error.skillSelect}}
                    </span>
                </p>
            </v-container>

            <input type="file" @change="onFileChange"  />
            <p v-if="errors.length">
                <span v-for="error in errors" :key="error" style="color:#ae2012; font-size:13px">
                    {{error.image}}
                </span>
            </p>

            <v-textarea
                v-model="descriptions"
                bg-color="grey-lighten-2"
                color="cyan"
                variant="outlined"
                label="University Description"
                :rules="descriptionRules"
                rows="2"
            ></v-textarea>
            <v-btn type="button" @click="createSchool()">Submit</v-btn>
        </v-form>
    </div>
</template>

<script>
import axios from 'axios'
 import Cookies from "js-cookie";
export default {
    data() {
        return {
            errors: [],
            name: '',
            phone: '',
            email: '',
            userAddresses: '', 
            userAddressName: '', 
            userAddressesStreet: '', 
            userAddressesLink: '', 

            universityAddressesName: '', 
            universityAddressesStreet: '', 
            universityAddressesLink: '', 

            userAddressId:null,
            universityAddressId:null,


            universityAddresses: '',
            checkbox: '',
            password: '',
            universityName: '',
            schoolTypes:[],
            typesGet:[],
            schoolType:'',
            skills :null,
            skillSelect: [],
            image:null,
            descriptions:'',
            valid: true,
            newUserID:'',
            role_id:2,
            gender:null,
            
            nameRules: [
                value => !!value || 'Name is required',
                value => (value && value.length >= 2) || 'Name needs to be at least 2 characters',
            ],
            phoneRules: [
                value => !!value || 'phone is required',
                value => !value || (value && value.length > 8 && /[0-9-]+/.test(value)) || 'Phone number needs to be at least 9 digits',
            ],
            emailRules: [
                value => !!value || 'Email is required',
                value => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(value) || 'E-mail must be valid',
            ],
            checkboxRules: [
                value => !!value || 'Must be checked',
            ],
            PasswordRules: [
                value => !!value || 'password is required',
                value => /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+{}|:"<>?~`]).{8,}$/.test(value) || 'Value required and should contain uppercase, lowercase, number, sign and more than 8 characters',
            ],
            imageRules: [
                value => !!value || 'image is required',
            ],
            genderRules: [
                value => !!value || 'gender is required',
            ],
            userStreetRules: [
                value => !!value || 'street of user is required',
            ],
            universityNameRules: [
                value => !!value || 'name of university is required',
            ],
            userAddressesNameRule: [
                value => !!value || 'name address user is required',
            ],
            userLinkRules: [
                value => !!value || 'link address of user is required',
            ],
            universityStreetRules: [
                value => !!value || 'street of university is required',
            ],
            universityAddressesNameRule: [
                value => !!value || 'name address university is required',
            ],
            universityLinkRules: [
                value => !!value || 'link address of university is required',
            ],
            schoolTypesRule: [
                value => !!value || 'type of university is required',
            ],
            descriptionRules: [
                value => !!value || 'Descripiton is required',
                value => (value && value.length >= 10) || 'Name needs to be at least 10 characters',
            ],
        }
    },
    methods: {

        getUniversityAddressId() {
            const universityAddressData = {
                name: this.universityAddressesName,
                street: this.universityAddressesStreet,
                link: this.universityAddressesLink,
            };
            console.log("universityAddressData", universityAddressData);
            return axios
            .post(`${process.env.VUE_APP_API_URL}address`, universityAddressData)
            .then((res) => {
                this.universityAddressId = res.data.data.id;
            })
            .catch((error) => {
                console.log(error);
            });
        },
        createSchool() {
            // Create university address
            this.getUniversityAddressId()
            .then(() => {
                // Create school
                const schoolDatas = {
                name: this.universityName,
                image: this.image,
                description: this.descriptions,
                address_id: this.universityAddressId,
                type_education_id: this.getTypeID(),
                skills: this.getMajorId(),
                };
                console.log("schoolDatas", schoolDatas);

                axios.post(`${ process.env.VUE_APP_API_URL}schools`,schoolDatas)
                .then((res) => {
                    console.log(res.data.data.id)
                    this.createUser(res.data.data.id)
                   
                })
                .catch((error) => {
                        console.log(error);
                })
            })
            .catch((error) => {
                console.log(error);
            });
        },
     
        

        getUserAddressId() {
            console.log('adress')
             const userAddressData = {
                name: this.userAddressName,
                street: this.userAddressesStreet,
                link: this.userAddressesLink,
            }
            console.log("userAddressData", userAddressData);
            return axios
            .post(`${process.env.VUE_APP_API_URL}address`, userAddressData)
            .then((res) => {
                this.userAddressId = res.data.data.id;
               
            })
            .catch((error) => {
                console.log(error);
            });
        },
        // create user
        createUser($id){
            console.log($id)

             this.getUserAddressId()
            .then(() => {
                const userData  ={
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    phone: this.phone,
                    gender:this.gender,
                    role_id: this.role_id,
                    address_id: this.userAddressId,
                    school_id: $id
                }
                console.log("userData",userData)

                axios.post(`${ process.env.VUE_APP_API_URL}users`,userData )
                .then((res) => {
                    console.log(res);
                    Cookies.set("userData", JSON.stringify(res.data), { expires: 30 });
                    this.$router.push('/university')
                })
                .catch((error) => {
                        console.log(error);
                })
            })
            .catch((error) => {
                console.log(error);
            });
        },

        getSchoolTypes(){
            axios.get(`${ process.env.VUE_APP_API_URL}schoolType`).then((res)=>{
            this.typesGet = res.data.data
            res.data.data.forEach(schoolType => {
                    this.schoolTypes.push(schoolType.name);
                    
                });
            })   
        },

        getTypeID(){
            let id = null;
            this.typesGet.forEach(item => {
                if(item.name == this.schoolType){
                    id = item.id;
                }
            });
            return id;
        },

        getskills(){
            axios.get(`${ process.env.VUE_APP_API_URL}majors`).then((res)=>{
            this.skills = res.data.data
            })
        },

        getMajorId(){
            let total = []
            for(let i=0;i<this.skillSelect.length;i++){
                total.push(this.skillSelect[i]);
            }
            return total
        },

        onFileChange(event) {
        // Retrieve the selected image file
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = () => {
                // Convert the image to base64 encoding
                    const base64Image = reader.result;
                    this.image = base64Image; // Store the base64 encoded image
                };
                reader.readAsDataURL(file);
                console.log(file);
            }
        },

    },  
    mounted(){
        this.getSchoolTypes()
        this.getskills()
    }
}
</script>

<style scoped>
form{
  width: 80%;
  box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
  border: 1px solid rgb(124, 121, 121);
  padding: 20px;
  background: #d8d6d6;
  margin: 20px;
}
.input-field {
  width: 50%;
}
.select{
    width: 50%;
    height: 44px;
    color: rgb(141, 137, 137);
    border: 1px solid rgb(124, 123, 123);
    outline-style:solid 1px ;
    border-radius: 5px;
}
input[type="file"]{
    padding: 8px;
    width: 100%;
    background: white;
    border: 1px solid rgb(124, 123, 123);
    margin-bottom: 15px;

}
.groupForm{
  margin-left: 13%;
}
.item{
  display: flex;
  gap: 20px;
  margin-bottom: 10px;
}

#checkbox {
    display: grid;
    grid-template-columns: repeat(5, 1fr); 
    grid-gap: 10px; 
    margin-bottom: 10px;
}
h2{
  text-align: center;
  color: orange;
  margin-top: 20px;
}
h3{
  margin-top: 10px;
}


</style>