<template>

      <v-form @submit.prevent="" ref="form" class="form-item">
        <h2>Add Workshop</h2>
        <div class="side-input">
          <div class="right-input">
              <v-text-field
              v-model="name"
              label="Name of workshop"
              :rules="nameRules"
              color="#634B7A"
              variant="outlined"
              placeholder="Enter your name of workshop"
            ></v-text-field>
              <v-text-field
              v-model="startDate"
              label="Start Date"
              type="date"
              :rules="startDateRules"
              variant="outlined"
              color="#634B7A"
              placeholder="Enter your start date"
          ></v-text-field>
            <v-textarea
              v-model="description"
              label="Description"
              :rules="descriptionRules"
              variant="outlined"
              color="#634B7A"
              placeholder="Enter your description"
            ></v-textarea>
          </div>
          <div class="left-input">
            <v-text-field
              v-model="number"
              label="Number user"
              type="number"
              :rules="numberRules"
              variant="outlined"
              color="#634B7A"
              placeholder="Enter your number user"
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

        <v-file-input
            @change="onFileChange"
            label="Image"
            :rules="imageRules"
            variant="outlined"
        ></v-file-input>
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
        
        <div class="btn">
          <v-btn type="button" class=" text-white cancel-btn" @click="cancelAdd">Cancel</v-btn>
          <v-btn type="submit" @click.prevent="submitForm" class="bg-orange text-white">Create</v-btn>
        </div>
      </v-form>
</template>

<script>
import Swal from 'sweetalert2'
import axios from 'axios';
// import Cookies from 'js-cookie';
export default {
  props:['school_id'],
  data() {
    return {
      name: "",
      description: "",
      image: "",
      todayDate: new Date().toLocaleDateString(),
      number: null,
      startDate: null,
      endDate: null,
      school: null,
      time: null,
      getSchools: null,
      schools: [
      ],
      addresses: [
      ],
      timeRules: [
        (v) => !!v || "Time is required",
        (v) => /^([01]\d|2[0-3]):([0-5]\d)$/.test(v) || "Time must be in the format 'HH:mm'",
      ],
      nameRules: [
        (v) => !!v || "Name is required",
        (v) => v.length <= 50 || "Name must be less than 50 characters",
      ],
      numberRules: [
        (v) => !!v || "Number is required",
        (v) => /^\d+$/.test(v) || "Number must be a whole number",
        (v) => v >= 0 && v <= 500 || "Number must be between 0 and 100",
      ],
      descriptionRules: [
        (v) => !!v || "Description is required",
        (v) => v.length <= 500 || "Description must be less than 500 characters",
      ],
      imageRules: [
        (v) => !!v || "Image is required",
      ],
      startDateRules: [
        (v) => !!v || "Start date is required",
      ],
      endDateRules: [
        (v) => !!v || "End date is required",
        (v) => v >= this.startDate || "End date must be greater than start date",
      ],
      schoolRules: [
        (v) => !!v || "School is required",
      ],
    };
  },
  methods: {
    // get data of school to show in select
    fetchSchools() {
      axios.get(`${process.env.VUE_APP_API_URL}schools`)
        .then(response => {
          this.getSchools = response.data.data
          this.getSchools.forEach(item => {
            this.schools.push(item.name);
          });
        })
        .catch(error => {
          console.log(error)
        })
    },

    onFileChange(event) {
      // Retrieve the selected image file
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = () => {
          // Convert the image to base64 encoding
          const base64Image = reader.result;
          this.image = base64Image; // Store the base64 encoded image
        };
        reader.readAsDataURL(file);
      }
    },

    submitForm() {
      let newWorkshop = {
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
        axios.post(`${process.env.VUE_APP_API_URL}workshops`, newWorkshop)
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
    alertMessage(){
      Swal.fire({
        position: 'top-center',
        icon: 'success',
        title: 'Your work has been created',
        showConfirmButton: false,
        timer: 2000
      })
    },
    cancelAdd(){
      this.$router.push("/university");
      return this.$emit("show", "workshop");
    }
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
  width: 83%;
  margin-left: auto;
  margin-right: 10px;
  margin-bottom: 10px;
  margin-top: 3%;
  box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;
  padding: 25px;
}

.form-container {
  padding: 35px;
  margin: 40px 0px;
  border-radius: 10px;
  display: flex;
  align-items: center;
}

.btn {
  display: flex;  
  justify-content: end;
}

.side-input {
  width: 100%;
  display: flex;
  align-items: center;
  gap: 20px
}

.right-input {
  width: 50%;
}

.left-input {
  width: 50%;
}
.cancel-btn{
  margin-right:10px;
  background:#634b7a;
}

.v-text-field,
.v-textarea,
.v-select,
.v-file-input {
  margin-bottom: 15px;
}
</style>