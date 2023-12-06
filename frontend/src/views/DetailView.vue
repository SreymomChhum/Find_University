<template>
    <!-- <div class="btn" to="/"> -->
        <v-btn class="btn" to="/" >Back</v-btn>
    <!-- </div> -->
    <div class="cardImage">
        <card-item class="ms-12 me-12 mt-10 mb-5">
        <template #img>    <v-img
            class="align-end text-white"
            height="400"
            width="100%"
            :src="data.image"
            cover
            >
            </v-img>
        </template>
        <template #info>    
            <v-card-text>
                <h1  v-if='dataname=="schools"'> <strong >Name: </strong>{{data.name}} ({{data.type}})</h1><br>
                <h3>  {{data.description}}</h3>
                <div  v-if='dataname=="majors"'><strong>Subject that match with this skill: </strong>
                    <ul>
                        <li v-for='subject in data.subjects' :key="subject">{{subject.name}}</li>
                    </ul>
                </div>
                
            </v-card-text>
        </template>
    </card-item>
    </div>
    <content-list  :datas="listSkill"  :dataname="'majors'"></content-list>
    <content-list   :datas="listSchool" :dataname='"schools"'></content-list>
    <scholarship-workshop-card  :datas="listScholarship" :dataname='"scholarships"'></scholarship-workshop-card>
    <scholarship-workshop-card  :datas="listWorkshop" :dataname='"workshops"'></scholarship-workshop-card>
</template>

<script>
import axios from 'axios';

    export default {
        data(){
            return {
                data: [],
                is_update: false,
                id:'',
                dataname:'',
                listSchool:'',
                listSkill:'',
                listWorkshop:'',
                listScholarship:''
            }
        },
        methods:{
                detailData(){
                    this.id = this.$route.params.id;
                    this.dataname = this.$route.params.dataname;
                    axios.get(`${process.env.VUE_APP_API_URL}`+this.dataname+"/"+this.id).then((response) =>{
                        this.data = response.data.data
                        this.listScholarship = this.data.scholarship
                        this.listSkill = this.data.skills
                        this.listWorkshop= this.data.workshops
                        this.listSchool = this.data.schools
                    })
                    
                },
            
            },
        mounted() {
            this.detailData();
        },
    }
</script>
<style scoped>
    .cardImage {
        width: 100%;
        margin-top:30px ;
    }
    /* .btn{
        display: flex;
        flex-direction: column;
        justify-content:end;
    } */
    h1,h3{
        text-align: center;
    }

    .btn{
        color:white;
        background:orange;
        width: 10%;
        margin-left:3.5%;
        margin-top: 3%;
    }
    
</style>