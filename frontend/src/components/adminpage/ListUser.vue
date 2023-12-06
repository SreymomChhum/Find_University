<template>
  <div class="tablecontainer">
    <v-table class="my-table">
      <thead>
        <tr>
          <th class="text-center"  style="color: #ffffff">Id</th>
          <th class="text-center" style="color: #ffffff">Name</th>
          <th class="text-center" style="color: #ffffff">Email</th>
          <th class="text-center" style="color: #ffffff">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(data, index) in datas" :key="index" class="text-center">
          <td>{{ index + 1 }}</td>
          <td >{{ data.name }}</td>
          <td>{{ data.email }}</td>
          <td >
              <span
                class="mdi mdi-pencil"
                @click="openDialogEdit(data.id)"
                style="font-size: 24px; color: rgb(11, 7, 249); cursor: pointer" 
              ></span>
            <span
              class="mdi mdi-delete"
              @click="openDialogDelete(data.id)"
              style="color: red; font-size: 24px; margin-left:10%; cursor: pointer"
            ></span>
          </td>
        </tr>
      </tbody>
    </v-table>
  </div>
  <v-dialog v-model="dialogDelete" max-width="400px">
    <v-card>
      <v-card-title>Delete Confirmation</v-card-title>
      <v-card-text>
        <p>Are you sure you want to delete this item?</p>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="cancelEdit">No</v-btn>
        <v-btn color="red" dark @click="deleteUser">Yes</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>

  <v-dialog v-model="dialogEdit" width="auto">
    <v-card class="custom-dialog">
      <v-card-title class="custom-dialog-title">
        <v-icon left>mdi-pencil</v-icon>
        Edit Form
      </v-card-title>
      <v-card-text>
        <div class="container">
          <form @submit.prevent="updateUser" class="p-3">
            <div class="mb-5">
              <label class="form-label">Name</label>
              <input type="text" v-model="name" class="form-control" />
            </div>

            <div class="mb-5">
              <label class="form-label">Email</label>
              <input type="text" v-model="email" class="form-control" />
            </div>
          </form>
        </div>
      </v-card-text>
      <v-card-actions class="custom-dialog-actions">
        <v-btn color="primary" @click="cancelEdit" type="submit">Cancel</v-btn>
        <v-btn color="primary" @click="saveEdit(data.id)" type="submit">Update</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import axios from "axios";

export default {
  props: ["datas"],
  data() {
    return {
      dialogEdit: false,
      dialogDelete: false,
      url: "http://127.0.0.1:8000/api/user",
      data: [],
      name: "",
      email: "",
      deleteId: "",
    };
  },
  methods: {
    del() {
      return this.$emit("del");
    },
    fectchUser($id) {
      axios
        .get(this.url + `/${$id}`)
        .then((response) => {
          this.data = response.data.data;
          this.name = this.data.name;
          this.email = this.data.email;
        })
        .catch((error) => {
          console.error(error);
        });
    },

    openDialogEdit($id) {
      this.fectchUser($id);
      this.dialogEdit = true;
    },

    openDialogDelete($id) {
      this.deleteId = $id;
      this.dialogDelete = true;
      console.log(this.dialogDelete);
    },

    cancelEdit() {
      this.dialogEdit = false;
      this.dialogDelete = false;
    },

    saveEdit($id) {
      const newData = {
        name: this.name,
        email: this.email,
      };

      axios
        .put(`${process.env.VUE_APP_API_URL}user/` + $id, newData)
        .then(() => {
          this.dialog = false;
        });
      axios
        .put(this.url + `/${$id}`, newData)
        .then(() => {
          this.dialog = false;
          location.reload();
        })
        .catch((error) => {
          console.error("Error updating data:", error);
        });
    },

    updateUser() {
      const userId = this.$route.params.id;
      const newData = {
        name: this.data.name,
        email: this.data.email,
      };
      axios
        .get(this.url + `/${userId}`, newData)
        .then(() => {
          this.$route.push("/");
        })
        .catch((error) => {
          console.error(error);
        });
    },
    deleteUser() {
      axios
        .delete(`${process.env.VUE_APP_API_URL}user/` + this.deleteId)
        .then(() => {
          this.dialogDelete = false;
          location.reload();
        });
    },
  },
};
</script>

<style scoped>
.tablecontainer {
  margin-top: -5%;
  margin-bottom: 100px;
}

.my-table {
  margin-top: 6%;
  padding: 8px;
  width: 83%;
  margin-left: 16%;
  box-shadow: 0px 10px 20px rgba(150, 147, 147, 0.1);

  /* border: 1px solid rgb(181, 177, 177); */
}
th {
  font-size: 18px;
  color: white;
  background-color: #6a4c93;
}

td {
  font-size: 15px;
  color: #333131cc;
  /* border-bottom: 1px solid #e0e0e0; */
  padding: 12px;
  text-align: center;
}

.custom-dialog {
  background-color: #f3f3f3;
  width: 500px;
  border-radius: 8px;
}

.custom-dialog-title {
  background-color: #1a237e;
  color: white;
  border-radius: 8px 8px 0 0;
  padding: 16px;
}

.custom-dialog-actions {
  background-color: #e8e8e8;
  border-radius: 0 0 8px 8px;
  padding: 8px;
}

.form-label {
  color: #1a237e;
  font-weight: bold;
}

.form-control {
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 8px;
  width: 100%;
}
.role {
  outline-style: solid;
  outline-width: 1px;
}
</style>
