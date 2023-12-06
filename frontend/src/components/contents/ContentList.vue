<template>
  
  <title-text v-if='datas!=null && datas!=""' >Choose {{dataname}}</title-text>
  <card-container >
        <v-col cols="12" sm="3" v-for="(data) in datas" :key="data.id">
          <v-sheet class=" ma-8">
            <!-- https://vuetifyjs.com/en/components/cards/ -->
              <v-card
                    class="mx-auto mt-10"
                    max-width="300"
                  >
                    <v-img
                      class="align-end text-white"
                      height="200"
                      :src="data.image"
                      cover
                    >
                      <v-card-title>{{data.name}}</v-card-title>
                    </v-img>

                    <v-card-subtitle class="pt-4">
                     {{data.type}}
                    </v-card-subtitle>

                    <v-card-actions>
                      <v-btn  v-if='dataname=="schools"' color="orange" :to="{name: 'apply', params: { school_id: data.id}}">
                        Apply
                      </v-btn>

                      <v-btn color="orange" @click="showDetail(data.id)" >
                        Detail
                      </v-btn>
                      <v-btn color="orange"  v-if='dataname=="schools"' to="/payment"  >
                        Payment
                      </v-btn>
                    </v-card-actions>
                </v-card>
          </v-sheet>
       </v-col>
  </card-container>
  
</template>

<script>
export default {
  props: { datas: Array, dataname: String },
  methods:{
    showDetail($id){
      this.$router.push('/detail/'+this.dataname+'/'+$id)
      // location.reload()
    }
  }
};
</script>
<style>

</style>
