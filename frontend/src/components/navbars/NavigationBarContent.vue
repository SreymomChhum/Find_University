<template>
 <v-tabs class="category">
    <v-tab @click="contentData('schools')">Universities</v-tab>
    <v-tab @click="contentData('majors')">Skills</v-tab>
    <v-tab @click="contentData('workshops')">Workshops</v-tab>
    <v-tab @click="contentData('scholarships')">Scholarships</v-tab>
  </v-tabs>
  <search-bar @searchKey="searchKey" v-if='dataname=="schools"'></search-bar>
  <content-list v-if='dataname!="scholarships" && dataname!="workshops" ' :datas="datas" :dataname='dataname' ></content-list>
  <scholarship-workshop-card  v-else class="mt-10" :datas="datas" :dataname='dataname'></scholarship-workshop-card>

</template>
<script>
export default {
  props:['datas'],
  data(){
    return{
       university:false,
       skill:false,
       scholarship:false, 
       workshop:false,
       dataname:'schools'

    }
  },
  methods:{
    contentData(dataName){
      this.dataname=dataName
      this.$emit('contentData',dataName)
    },
    searchKey(key){
     this.$emit("searchkey",key)
    }
    

  },
 
}
</script>
<style scoped>
    button.v-btn.v-slide-group-item--active.v-tab--selected.v-theme--light.v-btn--density-default.v-btn--size-default.v-btn--variant-text.v-tab {
        color: white;
        background: orange;
    }
    a{
    color: rgb(32, 10, 10);
    }
    .category{
      margin-left:50px;
      margin-top: 10px;
    }
</style>