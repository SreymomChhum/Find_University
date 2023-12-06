<template>
  <div class="tablecontainer">
    <v-btn class="add" @click="createWorkshop"> Add workshop </v-btn>
    <v-table class="my-table">
      <thead>
        <tr>
          <th class="text-center" style="width: 8%; color: #ffffff">Id</th>
          <th class="text-center" style="width: 8%; color: #ffffff">Name</th>
          <th class="text-center" style="width: 15%; color: #ffffff">
            Post Date
          </th>
          <th class="text-center" style="width: 15%; color: #ffffff">
            Expired Date
          </th>
          <th class="text-center" style="width: 10%; color: #ffffff">Time</th>
          <th class="text-center" style="width: 10%; color: #ffffff">
            User Number
          </th>
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
          v-for="(data, index) in dataWorkshop" :key="index" class="text-center">
          <td>{{ index + 1 }}</td>
          <td>{{ data.name }}</td>
          <td>{{ data.start_date }}</td>
          <td>{{ data.expired_date }}</td>
          <td>{{ data.time }}</td>
          <td>{{ data.user_number }}</td>
          <td>{{ data.description }}</td>
          <td>
            <img :src="data.image" alt="" style="width: 60%" />
          </td>
          <td class="btn-action">
            <span
              class="mdi mdi-pencil"
              style="color: rgb(11, 7, 249); font-size: 20px; cursor: pointer"
              @click="showEdit(data.id)"
            >
            </span>
            <span
              class="mdi mdi-delete"
              @click="deleteScholarship(data.id)"
              style="color: rgb(249, 7, 7); font-size: 20px;margin-left:10px;  cursor: pointer"
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
  props:["school_id"],
  data() {
    return {
      dataWorkshop: [],
    };
  },
  methods: {
    fetchScholarship() {
     
      axios.get(`${process.env.VUE_APP_API_URL}workshops/school/${this.school_id}`).then((res) => {
        this.dataWorkshop = res.data.data;
      });
    },
    showEdit(id) {
      return this.$emit("updateWorkshop", id);
    },
    createWorkshop() {
      return this.$emit("createWorkshop");
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
            .delete(`${process.env.VUE_APP_API_URL}workshops/${id}`)
            .then(() => {
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              this.fetchScholarship();
            });
        }
      });
    },
  },
  mounted() {
    this.fetchScholarship();
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
</style>
