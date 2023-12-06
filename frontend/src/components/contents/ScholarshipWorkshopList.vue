<template>
<section>

 <title-text v-if='datas!=null && datas!="" && datas!=[]'>Choose {{dataname}}</title-text>
      <div class="container " v-for="(data) in datas" :key="data.id">
        <div v-if="isNotExpired(data)" class="card" >
          <div class="image">
            <img :src="data.image" alt="">
          </div>
          <div class="text">
              <div class="detail">
                <div class="text-item">
                    <div class="title">
                        <h2>{{data.name}}</h2>
                        <h5>Expired date: {{data.expired_date}}</h5>
                        <h5>Available numbers: {{data.user_number}}</h5>
                    </div>
                    <p>{{data.description}}</p>
                </div>
                <div class="btn">
                
                  <button v-if="dataname=='workshops'" @click="checkLoginStatus; "><register-account-popup  :workshop_id="data.id"></register-account-popup></button>
                  <button v-if="dataname=='scholarships'">Apply</button>

                </div>
              </div>
          </div>
        </div>
      </div>
</section>
 
</template>

<script>
import Cookies from 'js-cookie';
    export default{
      props:{datas:Array,dataname:String},
      data() {
    return {
      isLoggedIn: false,
      userId: '',
    };
  },
    mounted() {
    this.setUser();
  },
  methods: {
    setUser() {
      const userData = Cookies.get('userData');
      if (userData) {
        const userDataObj = JSON.parse(userData);
        this.userId = userDataObj.data.id;
      }
    },
    checkLoginStatus() {
      if (this.userId) {
        this.isLoggedIn = true;
      } 
    },
    joinWorkshop(id){
      console.log(id);
    },
    isNotExpired(data) {
      const endDate = new Date(data.expired_date);
      const today = new Date();
      return endDate >= today;
    },
  },
}
</script>

<style scoped>
  .container{
    display: flex;
    justify-content: center;
  }

  .card{
    margin-top: 20px;
    margin-bottom: 20px;
    width:92%;
    height:50vh;
    display: flex;
    justify-content: center;
    background:white;
    padding: 20px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    border-radius:10px;
  }

  .text{
    display: flex;
    justify-content: center;
    width:60%;
    margin-left:20px;

  }

  img{
    width:100%;
    height: 100%;
  }

  .image{
    width:40%;
  }

  .detail{
    display: flex;
    width:100%;
    justify-content: space-between;
    box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
    padding: 40px;
  }

  .btn{
    display: flex;
    flex-direction: column;
    justify-content:end;
  }

  .btn-apply{
    padding:5px 10px;
    border-radius:5px;
    border:none;
    color:white;
    background:purple;
    margin-bottom: 5px;
  }

  h2,i{
  color: orange;
  margin-bottom: 10px;
  }

  i{
    font-size: 15px;
  }

  /* .icon-item{
    display: flex;
    align-items: center;
    gap: 10px;
    background: #000;
  } */

  .text-item{
    width: 100%;
  }

  p{
    font-size: 13px;
  }
</style>