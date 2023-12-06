<template>
  <div class="px-5">
    <v-row
      class="mb-4"
      no-gutters
    >
    <slot></slot>
    </v-row>
  </div>
</template>
<script>
export default {
  methods:{
      showDetail(Id){
        this.$router.push('/university/'+Id);
        }
  }
}
</script>
<style scoped>
</style>