<template>
  <div class="form-container">
    <v-form @submit.prevent="" ref="form" class="form-item">
      <h2>Update Workshop</h2>
      <div class="side-input">
        <div class="right-input">
          <v-text-field
            v-model="name"
            label="Name Workshop"
            :rules="nameRules"
            color="#634B7A"
            placeholder="Enter your name workshop"
            variant="outlined"
          ></v-text-field>
          <v-text-field
            v-model="startDate"
            label="Start Date"
            type="date"
            :rules="startDateRules"
            color="#634B7A"
            placeholder="Enter your start date"
            variant="outlined"
          ></v-text-field>
          <v-file-input
            @change="onFileChange"
            label="Image"
            :rules="imageRules"
            color="#634B7A"
            variant="outlined"
          ></v-file-input>

        
        </div>
        <div class="left-input">
          <v-text-field
            v-model="number"
            label="Number Workshop"
            type="number"
            :rules="numberRules"
            variant="outlined"
            color="#634B7A"
            placeholder="Enter your number workshop"
          ></v-text-field>
          <v-text-field
            v-model="endDate"
            label="End Date"
            type="date"
            :rules="endDateRules"
            variant="outlined"
            color="#634B7A"
            placeholder="Enter your end date"
          ></v-text-field>
          <v-text-field
            v-model="time"
            label="Time"
            :rules="timeRules"
            variant="outlined"
            color="#634B7A"
            placeholder="Enter your time"
          ></v-text-field>
        </div>
      </div>
        <v-textarea
            v-model="description"
            label="Description"
            variant="outlined"
            color="#634B7A"
            placeholder="Enter your description"
          ></v-textarea>
      <div class="btn">
        <v-btn type="button" @click="cancelEdit" class="text-white cancel-btn"
          >Cancel</v-btn
        >
        <v-btn
          type="submit"
          @click.prevent="editeForm"
          class="bg-orange text-white"
          >Update</v-btn
        >
      </div>
    </v-form>
  </div>
</template>
<script>
import axios from "axios";
import Swal from "sweetalert2";
export default {
  props: ["workshopId","school_id"],
  data() {
    return {
      name: "",
      description: "",
      image: "",
      todayDate: new Date().toLocaleDateString(),
      number: null,
      startDate: null,
      endDate: null,
      time: null,
      getSchools: null,
      schools: [],
      timeRules: [(v) => !!v || "Time is required"],
      nameRules: [
        (v) => !!v || "Name is required",
        (v) => v.length <= 50 || "Name must be less than 50 characters",
      ],
      numberRules: [
        (v) => !!v || "Number is required",
        (v) => /^\d+$/.test(v) || "Number must be a whole number",
        (v) => (v >= 0 && v <= 500) || "Number must be between 0 and 100",
      ],
      descriptionRules: [
        (v) => !!v || "Description is required",
        (v) =>
          v.length <= 500 || "Description must be less than 500 characters",
      ],
      startDateRules: [(v) => !!v || "Start date is required"],
      endDateRules: [
        (v) => !!v || "End date is required",
        (v) =>
          v >= this.startDate || "End date must be greater than start date",
      ],
      schoolRules: [(v) => !!v || "School is required"],
    };
  },
  methods: {

    onFileChange(event) {
      // Retrieve the selected image file
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = () => {
          // Convert the image to base64 encoding
          const base64Image = reader.result;
          this.image = base64Image;
        };
        reader.readAsDataURL(file);
      }
    },

    fetchWorkshopData(workshopId) {
      axios
        .get(`${process.env.VUE_APP_API_URL}workshops/${workshopId}`)
        .then((response) => {
          const workshop = response.data.data;
          this.name = workshop.name;
          this.time = workshop.time;
          this.startDate = workshop.start_date;
          this.endDate = workshop.expired_date;
          this.description = workshop.description;
          this.number = workshop.user_number;
          this.image = workshop.image;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    // Add a new method to handle cancel button
    cancelEdit() {
      this.$router.push("/university");
      return this.$emit("show", "workshop");
    },

    editeForm() {
      let editedWorkshop = {
        name: this.name,
        image: this.image,
        school_id: this.school_id,
        description: this.description,
        user_number: this.number,
        start_date: this.startDate,
        expired_date: this.endDate,
        time: this.time,
      };
      if (this.$refs.form.validate()) {
        // Submit form data
        axios
          .put(
            `${process.env.VUE_APP_API_URL}workshops/${this.workshopId}`,
            editedWorkshop
          )
          .then(() => {
            this.alertMessage();
            this.$router.push("/university");
            return this.$emit("show", "workshop");
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },

    alertMessage() {
      Swal.fire({
        position: "top-center",
        icon: "success",
        title: "Your work has been updated",
        showConfirmButton: false,
        timer: 2000,
      });
    },
  },

  mounted() {
    this.fetchWorkshopData(this.workshopId);
  },
};
</script>

<style scoped>
h2 {
  color: orange;
  text-align: center;
  margin-bottom: 25px;
}

.form-item {
  width: 100%;
  margin-left: auto;
  margin-top: -30px;
  box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px,
    rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px,
    rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;
  padding: 20px;
}

.form-container {
  padding: 35px;
  margin: 40px 0px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  margin-left: 15%;
}

.btn {
  display: flex;
  justify-content: end;
}
.side-input {
  width: 100%;
  display: flex;
  align-items: center;
  gap: 20px;
}

.right-input {
  width: 50%;

}

.left-input {
  width: 50%;
  /* margin-top:-18%; */
}
.cancel-btn {
  margin-right: 10px;
  background: #634b7a;
}

.v-text-field,
.v-textarea,
.v-select,
.v-file-input {
  margin-bottom: 15px;
}
</style>
