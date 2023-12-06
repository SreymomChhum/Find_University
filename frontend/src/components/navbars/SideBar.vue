<template>
  <v-card class="card"  >
    <v-layout>
      <v-navigation-drawer style="height: 700px; width:14%" class="sidebar" >
        <v-divider style="height: 300px"></v-divider>
        <v-list density="compact" class="" nav>
          <v-list-item value="Students">
            <template v-slot:prepend>
              <v-list-item-avatar>
                <img src="../../assets/images/logo.png" alt="" style="width:23%; margin-top: -30px; ">
              </v-list-item-avatar>
            </template><br>
          </v-list-item>
          <v-list-item  prepend-icon="mdi-home" class="" title="Home" value="Home" to="/"></v-list-item>
          <div v-if="this.$route.name!='admin'">
            <v-list-item  @click="show('student')" prepend-icon="mdi-account-school"  title="Student" value="Students"></v-list-item>
            <v-list-item  @click="show('workshop')" prepend-icon="mdi-hammer-wrench"  title="Workshop" value="Workshop"></v-list-item>
            <v-list-item   @click="show('scholarship')" prepend-icon="mdi-school-outline"  title="Scholarship" value="Scholarship"></v-list-item>
            <v-list-item   @click="show('major')" prepend-icon="mdi-format-list-bulleted"  title="Major" value="Majors"></v-list-item>
          </div>
          <div v-else>
            <v-list-item  @click="changedata('users')" prepend-icon="mdi-account"  title="All Users" value="Users"></v-list-item>
            <v-list-item  @click="changedata('students')" prepend-icon="mdi-account-school"  title="Students" value="Students"></v-list-item>
            <v-list-item  @click="changedata('managers')" prepend-icon="mdi-school" title="Universities" value="University"></v-list-item>
         </div>
        </v-list>
      </v-navigation-drawer>
      <v-main></v-main>
    </v-layout>
  </v-card>
</template>
<script>
  export default {
    methods:{
      changedata(dataname){
        return this.$emit("dataname",dataname);
      },
      show(contentName){
        return this.$emit('show',contentName)
      }
    }
  }
</script>

<style  scoped>
    .sidebar{
      background: #634b7a;
      color: white;
    }
    
</style>
