<template>
  <v-carousel hide-delimiters>
    <v-carousel-item v-for="(item, i) in items" :key="i" :src="item.src" cover></v-carousel-item>
  </v-carousel>
</template>

<script>
  export default {
    data () {
      return {
        items: [
          {
            src: require ('@/assets/images/banner5.jpg'),
          },
          {
            src: require ('@/assets/images/banner2.jpg')
          },
          {
            src: require ('@/assets/images/banner3.jpg')
          },
          {
            src: require ('@/assets/images/banner4.jpg')
          },
        ],
      }
    },
  }
</script>

<style scoped>
</style>