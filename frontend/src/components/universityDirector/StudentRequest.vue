<template>
    <div class="container">
        <h1>Student Request </h1>
        <h3 v-if="users==null || users==''">Does't have student request for study yet !</h3>
        <div class="student-card" >
            <div class="card" v-for="(user,index) in users" :key="index"  :user="user">
                <div class="card-left">
                    <span class="material-icons"> person </span>
                    <h3>{{user.user_id.name}}</h3>
                </div>
                <div class="card-right">
                    <!--code from https://vuetifyjs.com/en/components/dialogs/ -->
                    <v-row justify="center">
                        <v-dialog
                        class="dialog"
                        v-model="dialog"
                        persistent
                        width="400">
                        <template v-slot:activator="{ props }">
                            <v-btn
                            color="#ffffff"
                            v-bind="props"
                            style="margin-top:11px; margin-right:10px"
                            >
                            Student Info
                            </v-btn>
                        </template>
                        <v-card style="border-radius: 20px; border:2px solid orange" >
                            <v-card-text class="contenter-card">
                                <v-container style="padding: 25px; display: flex; flex-direction: column; gap:10px; ">
                                  
                                    <div class="profile" style="display:flex; gap:20px; align-items:center">
                                        <span class="material-icons" style="font-size: 100px; margin-bottom:20px; ">person</span>
                                        <div  >
                                            
                                            <h2>{{user.user_id.name}}</h2>
                                            <span>{{user.user_id.gender}}</span> 
                                        </div>   
                                    </div>
                                    <h4>Email: {{user.user_id.email}}</h4>
                                    <h4>{{user.user_id.h4hone}}</h4>
                                    <h4>Level: {{user.study_level}}</h4>
                                    <h4>Year: {{user.year}}</h4>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    color="#EFAA1D"
                                    variant="text"
                                    @click="dialog = false"
                                >
                                    Close
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                        </v-dialog>
                    </v-row>
                    
                    <v-btn 
                        color="#634B7A" 
                        v-bind="props" 
                        style="color:white" 
                        @click="isAccept(user.id)"
                    >Accept</v-btn>
                    <v-btn 
                        color="#EFAA1D" 
                        v-bind="props" 
                        style="color:white" 
                        @click="isReject(user.id)"
                    >Reject</v-btn>
                </div>
            </div>
        </div>
    </div>
  
</template>

<script>
import axios from 'axios'
import Swal from "sweetalert2";

export default{
    props:["school_id"],
    data(){
        return{
            email: '',
            errors: null,
            users:[],
            dialog: false,
            // universityDirectorName: null,
            universityDirectorId: '',

        }
    },
    methods:{


        getUser() {
            axios.get(`${ process.env.VUE_APP_API_URL}getSchoolUser/${this.school_id}`)
            .then((response)=>{
                this.users = response.data.data
                console.log(response.data.data)
            })
        },
        
        isAccept(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#634b7a",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Accept!",
                reverseButtons: true, // add this option
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put(`${process.env.VUE_APP_API_URL}acceptStudent/`+id)
                    .then(()=>{
                        this.$router.push("/university");
                        location.reload();
                    })
                }
            });
        },

        isReject(id) {
             Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#634b7a",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Reject!",
                reverseButtons: true, // add this option
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`${process.env.VUE_APP_API_URL}studentReject/`+id)
                    .then((response)=>{
                        console.log(response.data.data);
                        this.$router.push("/university");
                        location.reload();
                    })
                }
            });
        }
    },

    mounted(){
        this.getUser();
    }
}
</script>
<style scoped>
.container{
    display: flex;
    flex-direction: column;
    width: 100%;
    padding: 3% 0%;
}
.dialog{
    box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px;
    display:flex; 
    border:1px solid grey;

}
.material-icons{
    border-radius: 50px;
    border: 1px solid grey;
}
.student-card{
    display: flex;
    flex-direction: column;
    gap: 20px;
}
h1{
    margin-left: 15%;
    margin-bottom: 3%;
}
h3{
    margin: auto;
}
.card{
    width: 84%;
    background:#dbdbdb;
    box-shadow: rgb(38, 57, 77)0px 20px 20px -20px;
    margin-left: 15%;
    display: flex;
    justify-content: space-between;
    padding: 5px 20px;
    border-radius: 5px;
}
.card-left{
    display: flex;
    align-items: center;
    gap: 10px;

}
.card-right{
    padding: 5px;
    display: flex;
    gap: 20px;
}
</style>
