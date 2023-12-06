<template>
  <div class="tablecontainer">
    <v-btn class="add" @click="actoin('add')" > Add major </v-btn>
    <v-table class="my-table">
      <thead>
        <tr>
          <th class="text-center" style="width: 8%; color: #ffffff">Id</th>
          <th class="text-center" style="width: 8%; color: #ffffff">Name</th>
          <th class="text-center" style="width: 8%; color: #ffffff">Subject</th>
          <th class="text-center" style="width: 10%; color: #ffffff">
            Description
          </th>
          <th class="text-center" style="width: 10%; color: #ffffff">Image</th>
          <th class="text-center" style="width: 10%; color: #ffffff">
            Actions
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(data, index) in dataMajors"
          :key="index"
          class="text-center"
        >
          <td>{{ index + 1 }}</td>
          <td>{{ data.name }}</td>
          <td>
            <ul>
              <li v-for="subject in data.subjects" :key="subject.id">
                {{ subject.name }}
              </li>
            </ul>
          </td>
          <td>{{ data.description }}</td>
          <td>
            <img :src="data.image" alt="" style="width: 28%" />
          </td>
          <td class="btn-action">
            <span
              class="mdi mdi-delete"
              @click="deleteScholarship(data.id)"
              style="color: rgb(249, 7, 7); font-size: 25px;  cursor: pointer"
            ></span>
          </td>
        </tr>
      </tbody>
    </v-table>
  </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
export default {
  props:["dataMajors"],
  data(){
      return{
       
      }
  },
  methods: {
    actoin(name) {
      if(name=='add'){
        return this.$emit("show", "addMajor");
      }else if(name=='delete'){
        return  this.$emit("show", "major");
      }
    },
    deleteScholarship(id) {
      // https://sweetalert2.github.io/#download
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        reverseButtons: true, // add this option
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`${process.env.VUE_APP_API_URL}majors/${id}`)
            .then(() => {
              this.actoin('delete')
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            });
        }
      });
    },
  },
};
</script>

<style scoped>
body {
  font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI",
    Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial,
    sans-serif;
}
.tablecontainer {
  margin-bottom: 10%;
  margin-top: 5%;
}
.my-table {
  margin-left: 15%;
  margin-right: 10px;
  max-width: 85%;
  border-collapse: collapse;
  box-shadow: 0px 10px 20px rgba(150, 147, 147, 0.1);
}

th {
  font-size: 12px;
  font-weight: 600;
  background-color: #634b7a;
  border-bottom: 2px solid #e0e0e0;
  padding: 12px;
  text-align: center;
}

td {
  font-size: 10px;
  color: #333131cc;
  border-bottom: 1px solid #e0e0e0;
  padding: 12px;
  text-align: center;
}

.btn-action {
  display: flex;
  justify-content: center;
  align-items: center;
}
.edit,
.delete {
  width: 20px;
  margin-left: 10px;
  margin-right: 10px;
}
.add {
  margin-left: 15%;
  margin-bottom: 10px;
  color: white;
  text-decoration: none;
  background: #634b7a;
}
ul li {
  list-style: none;
}
</style>
