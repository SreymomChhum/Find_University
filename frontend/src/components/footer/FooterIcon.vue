<template>
  <v-btn
    v-for="icon in icons"
    :key="icon"
    class="mx-2 icon"
    :icon="icon"
    variant="text"
  ></v-btn>
</template>

<script>
export default {
  data: () => ({
    icons: ["mdi-facebook", "mdi-linkedin", "mdi-instagram", "mdi-twitter"],
  }),
};
</script>
<style scoped>
.icon{
  color:white;
}
</style>
