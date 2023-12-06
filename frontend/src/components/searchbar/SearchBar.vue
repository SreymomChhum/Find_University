<template>
  <div class="search-input mt-10">
    <v-toolbar color="#6a4c93" rounded="" height="74" flat>
      <v-text-field class="input"
        v-model="searchKey"
        clearable
        hide-details
        label="Search university in your province"
        prepend-inner-icon="mdi-magnify"
        single-line
        white
        :white-input="true"
        style="color: white"
      ></v-text-field>
    </v-toolbar>
  </div>
</template>
<script>
  export default {
    data: () => ({
      items: [],
      searchKey: '',
    }),
    watch: {
      searchKey () {
        this.$emit('searchKey',this.searchKey)
      },
    },

  }
</script>
<style scoped>
  .search-input{
    margin: 4%;
    width: 50%;
    margin-top: 10px;
    margin-bottom: 10px;
  }

</style>
