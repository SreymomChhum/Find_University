<template>
  <div class="major-container">
    <!--  copy right by vuetify https://vuetifyjs.com/en/components/forms/ -->
    <v-sheet width="500" class="form-add">
      <v-form fast-fail @submit.prevent>
        <h2>Add Major</h2>
        <h4>Name of Major</h4>
        <v-text-field
          v-model="name"
          label="name"
          :rules="nameRules"
          variant="outlined"
        ></v-text-field>

        <h4>Description</h4>
        <v-text-field
          v-model="description"
          label="Description"
          :rules="descriptionRules"
          variant="outlined"
        ></v-text-field>
        <!-- copy right vuitfy https://vuetifyjs.com/en/components/checkboxes/ -->
        <h4>Choose subjects</h4>
        <div class="subject">
          <div v-for="subject in listSubject" :key="subject">
            <v-checkbox
              class="text-black"
              v-model="subjectsId"
              :label="subject.name"
              :value="subject.id"
              :rules="subjectsId"
            ></v-checkbox>
          </div>
        </div>
        <p class="text" v-if="isAdd">checkbox required</p>
        <div class="input-image">
          <strong class="form-label">Image</strong>
          <input type="file" @change="onFileChange" />
          <p v-if="isAdd">image required</p>
        </div>
        <div class="btn">
          <v-btn type="button" class=" text-white cancel-btn" @click="cancelAdd">Cancel</v-btn>
          <v-btn type="submit"  @click="addMajor" class="bg-orange text-white">Create</v-btn>
        </div>
      </v-form>
    </v-sheet>
  </div>
</template>
<script>
import Swal from 'sweetalert2'
import axios from "axios";
export default {
  props:["school_id"],
  data() {
    return {
      image: null,
      isAdd: false,
      listSubject: [],
      subjectsId: [],
      name: "",
      nameRules: [
        (value) => {
          if (value?.length > 0) return true;
          return "name reuqired.";
        },
      ],

      description: "",
      descriptionRules: [
        (value) => {
          if (value?.length > 0) return true;
          return "description required.";
        },
      ],
    };
  },
  methods: {
    addMajor() {
      if (this.image == null) {
        this.isAdd = true;
      }
      if (this.name != "" && this.description != "" && this.image != "") {
        this.isAdd = false;
        const newMajor = {
          name: this.name,
          description: this.description,
          image: this.image, // Pass the image file to the API
          subjects: this.getSubjectId(),
        };

        axios
          .post(`${process.env.VUE_APP_API_URL}majors`, newMajor)
          .then((res) => {
            this.addSchoolSkill(res.data.data.id)
            this.alertMessage();
           
          })
          .catch((error) => {
            console.error(error);
          });
      }

    },

    addSchoolSkill($skill_id){
       axios
          .post(`${process.env.VUE_APP_API_URL}schoolMajor`, {
            "school_id":this.school_id,
            "skill_id":$skill_id,
          })
          .then((res) => {
            console.log(res)
             return this.$emit("show", "major");
          
          })
          .catch((error) => {
            console.error(error);
          });
    },

    fechSubject() {
      axios
        .get(`${process.env.VUE_APP_API_URL}subjects`)
        .then((response) => {
          this.listSubject = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // copy from https://github.com/yonyen99/project-vue-laravel-example
    onFileChange(event) {
      // Retrieve the selected image file
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        // console.log(reader);
        reader.onload = () => {
          // Convert the image to base64 encoding
          const base64Image = reader.result;
          this.image = base64Image; // Store the base64 encoded image
        };
        reader.readAsDataURL(file);
      }
    },
    getSubjectId() {
      let total = [];
      for (let i = 0; i < this.subjectsId.length; i++) {
        total.push(this.subjectsId[i]);
      }
      return total;
    },
    cancelAdd(){
      this.$router.push("/university");
      return this.$emit("show", "major");
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
  },
  mounted() {
    this.fechSubject();
  },
};
</script>

<style scoped>
.form-add {
  margin-top:20px;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  padding: 20px;
  border-radius: 5px;
}
.major-container {
  display: flex;
  justify-content: center;
  align-items: center;
}
h2 {
  text-align: center;
  color: orange;
}
p {
  color: rgb(184, 20, 14);
  font-size: 12px;
  margin-left: 20px;
  margin-bottom: 10px;
}
.btn {
  display: flex;  
  justify-content: end;
  margin-top: 20px;
}

.subject {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
}
.cancel-btn{
  margin-right:10px;
  background: #634b7a;
}
</style>
