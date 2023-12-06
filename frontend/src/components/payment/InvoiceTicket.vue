<template>
    <div class="container" >
        <div>
            <div class="invoice-container" id="form-data">
                <div class="title">
                    <img src="../../assets/images/logo.png" alt="">
                    <h2>Your Invoice</h2>
                </div>
                <div class="card-container">
                    <div>
                        <h4>Unversity_name </h4>
                        <h4>Student_name </h4>
                        <h4>Phone_number </h4>
                        <h4>Student_ID </h4>
                        <h4>Year_of_study </h4>
                        <h4>Course </h4>
                    </div>
                    <div>
                        <p>: {{universityName}}</p>
                        <p>: {{name}}</p>
                        <p>: {{phone}}</p>
                        <p>: {{studentId}}</p>
                        <p>: {{yearOfStudy}}</p>
                        <p>: {{courseProgramName}}</p>
                    </div>
                </div>
            </div>
            <div class="btn">
                 <v-btn class="bg-purple" @click="this.$router.push('/')">Cancel</v-btn>
                 <v-btn color="warning" @click="makePDF">Download!</v-btn>
            </div>
        </div>
    </div>
</template>

<script>
import html2canvas from 'html2canvas';
import jsPDF from 'jspdf';
import Cookies from "js-cookie";
export default {
    data() {
    return {
            name: null,
            phone: null,
            studentId: null,
            yearOfStudy: null,
            courseProgramName: null,
            universityName: null
    }
  },
  methods:{
    getInfo() {
      // Get the value of the "userData" cookie
      const userData = Cookies.get('paymentInfo');
      console.log(userData)
      // If the "userData" cookie exists, parse it and set the user ID in the component data
      if (userData) {
        const userDataObj = JSON.parse(userData);
        this.name= userDataObj.name;
        this.phone= userDataObj.phone;
        this.studentId= userDataObj.studentId
        this.yearOfStudy= userDataObj.yearOfStudy
        this.courseProgramName= userDataObj.courseProgramName
        this.universityName= userDataObj.universityName

      }
    },

    makePDF(){
        window.html2canvas = html2canvas;
          var doc = new jsPDF("p",'pt','a4');
          doc.html(document.querySelector("#form-data"),{
          callback: function(pdf){
              pdf.save('apply.pdf');
          }
          });
    }
  },
  mounted(){
    this.getInfo()
  }
}
</script>
<style scoped>
    .title,.card-container{
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid black;
        margin-bottom: 20px;
    }
    img{
        width:100px;
        height:100px;
    }
    .invoice-container{
        box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        width:500px;
        padding:40px;
        border-radius:10px;
        height: 80vh;
        
    }
    .container{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
    h2{
        color:orange;
    }
    h4,p{
        margin-bottom: 10px;

    }
    .btn{
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>