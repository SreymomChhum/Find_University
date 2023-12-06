<template>
    <v-card class="card"
    >
      <slot name="img"></slot>
      <br>
      <hr>
      <slot name="title"></slot>
    </v-card>
</template>
<script>
  export default {
    data: () => ({
      show: false,
    }),
  }
</script>
<style scoped>
  .card{
    box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
  }
</style>
