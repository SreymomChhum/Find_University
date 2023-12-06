<template>
  <hidede-limiter class="mt-5"></hidede-limiter>
  <navigationbar-content
    @contentData="contentData"
    :datas="datas"
    @searchkey="searchKey"
  ></navigationbar-content>
  <university-apply-form></university-apply-form>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      datas: [],
      dataname: "schools",
      key: "",
    };
  },
  methods: {
    contentData(dataName) {
      this.dataname = dataName;
      axios.get(`${ process.env.VUE_APP_API_URL}${dataName}`).then((response) => {
        this.datas = response.data.data;
        console.log(this.datas)
      });
    },
    defaultData() {
      axios.get(`${ process.env.VUE_APP_API_URL}schools`).then((response) => {
        this.datas = response.data.data;
      });
    },
    searchdata() {
      axios
        .get(`${ process.env.VUE_APP_API_URL}schools/address/${this.key}`)
        .then((res) => {
          this.datas = res.data.data;
        });
    },
    searchKey(key) {
      this.key = key;
      if(key==null || key==''){
       this.defaultData()
      }else{
        this.searchdata();
      }
      
    },
  },
  mounted() {
    this.defaultData();
  },
};
</script>
