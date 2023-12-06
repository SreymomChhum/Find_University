<template>
  <navigation-bar></navigation-bar>
  <router-view></router-view>
  <footer-bar v-if="this.$route.name!='admin'  && this.$route.name!='university'"></footer-bar>

</template>
<script>
  
   
</script>
<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
</style>
