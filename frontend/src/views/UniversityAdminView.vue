<template>
    <side-bar class="side-bar" @show="show"></side-bar>
    <student-request v-if="content=='student'" :school_id="school_id" @show="show"></student-request>
    <list-scholarship v-if="content=='scholarship'" @edit="edit" :school_id="school_id" @add="add"></list-scholarship>
    <add-scholarship v-if="addScholarship" @show="show" :school_id="school_id"> </add-scholarship>
    <edit-scholarship v-if="editScholarship" :editID="editID" :school_id="school_id" @show="show"></edit-scholarship>

    <list-workshop v-if="content=='workshop'" :school_id="school_id" @updateWorkshop="updateWorkshop" @createWorkshop="createWorkshop"></list-workshop>
    <add-workshop v-if="addWorkshop" @show="show" :school_id="school_id"></add-workshop>
    <edit-workshop v-if="editWorkshop" :workshopId="workshopId" :school_id="school_id"  @show="show"></edit-workshop>

    <list-major v-if="content=='major'" :dataMajors="dataMajors"  @show="show"></list-major>
    <add-major v-if="content=='addMajor'" @show="show" :school_id="school_id" ></add-major>

</template>

<script>
import Cookies from 'js-cookie';
import axios from "axios";
export default {
    data(){
        return{
            editScholarship:false,
            addScholarship:false,
            addWorkshop:false,
            editWorkshop: false,
            studentRequest: false,
            content:'',
            editID:'',
            workshopId: '',
            school_id:'',
            dataMajors:''
        }
    },
    methods:{
        show(contentName){
            this.editScholarship=false
            this.addScholarship = false
            this.addWorkshop = false
            this.editWorkshop = false
            this.content = contentName
            this.universityData(contentName)
        },
        edit(id){
            this.editScholarship=true
            this.editWorkshop = false;
            this.content=''
            this.editID = id 
        },
        add(){
           this.addScholarship = true;
           this.addWorkshop = false;
           this.content='';
        },
        createWorkshop(){
           this.addScholarship = false;
           this.addWorkshop = true;
           this.content='';
        },
        updateWorkshop(id){
            this.editScholarship=false;
            this.editWorkshop = true;
            this.content='';
            this.workshopId = id 
        },
        schoolID(){
           
            const userData = Cookies.get('userData');
            if (userData) {
                const userDataObj = JSON.parse(userData);
                this.school_id= userDataObj.data.school_id;
              
             }
        },
        universityData(contentName){
            if(contentName=="major"){
                 axios.get(`${process.env.VUE_APP_API_URL}majors/school/${this.school_id}`)
                 .then((res) => {
                    this.dataMajors = res.data.data;
                });
            }
        }
       
    },
    mounted(){
        this.schoolID()
        this.content='student'
    }

}
</script>

<style>

</style>