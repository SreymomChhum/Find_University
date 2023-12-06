<template>

  <div v-if="this.$route.name!='admin' && this.$route.name!='university'">
    <v-tabs>
      <img to="/" class="img" src="../../assets/images/logo.png" alt="" >
      <div class="">
      <router-link  to="/"><v-tab>Home</v-tab></router-link>
      <router-link to="/about"><v-tab>About</v-tab></router-link>
      <router-link to="/contact"><v-tab>Contact</v-tab></router-link>

      </div>
    </v-tabs>
  </div>

</template>
<script>
export default {
  data: () => ({}),
};
</script>

<style scoped>
button.v-btn.v-slide-group-item--active.v-tab--selected.v-theme--light.v-btn--density-default.v-btn--size-default.v-btn--variant-text.v-tab {
  color: white;
  background: orange;
}
a{
  color: white; 
}
.img{
  width: 70px;
  height: 50px;
}

</style>
