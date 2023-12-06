<template>
  <div class="groupForm" @submit.prevent="submit">
    <div class="image">
      <img
        src="../../assets/payment/payment.png"
        style="width: 90%; height: initial"
        alt="Image description"
      />
    </div>
    <v-form @submit.prevent="submit">
      <h1>Payment</h1>
      <div class="item">
        <v-text-field
          v-model="name"
          label="Name"
          :rules="nameRules"
          density="compact"
          placeholder="Enter your Name"
          variant="outlined"
          color="#634B7A"
          class="input-field"
        ></v-text-field>
        <v-text-field
          v-model="email"
          label="Email"
          :rules="emailRules"
          density="compact"
          placeholder="Enter your email"
          variant="outlined"
          color="#634B7A"
          class="input-field"
        ></v-text-field>
      </div>
      <div class="item">
        <v-text-field
          v-model="phone"
          label="Phone"
          :rules="phoneRules"
          density="compact"
          placeholder="Enter your phone number"
          variant="outlined"
          color="#634B7A"
          class="input-field"
        ></v-text-field>
        <v-text-field
          v-model="courseProgramName"
          label="Course/Program name"
          :rules="courselRules"
          density="compact"
          placeholder="Enter your Course/Program name"
          variant="outlined"
          color="#634B7A"
          class="input-field"
        ></v-text-field>
      </div>
      <div class="item">
        <v-text-field
          v-model="studentId"
          label="Student id"
          :rules="studentIdRules"
          density="compact"
          placeholder="Enter your student id"
          variant="outlined"
          color="#634B7A"
          class="input-field"
        ></v-text-field>
        <v-text-field
          v-model="yearOfStudy"
          label="Year of study"
          :rules="yearOfStudyRules"
          density="compact"
          placeholder="Enter your year of study"
          variant="outlined"
          color="#634B7A"
          class="input-field"
        ></v-text-field>
      </div>
      <div class="item">
        <v-text-field
          v-model="universityName"
          label="University name"
          :rules="universityNameRules"
          density="compact"
          placeholder="Enter your university name"
          variant="outlined"
          color="#634B7A"
        ></v-text-field>
      </div>
      <div class="btn">
      <v-btn type="submit" class="back"  to="/">back</v-btn>
      <v-btn type="submit" class="next">Next</v-btn>
      </div>
    </v-form>
  </div>
</template>

<script>
import Cookies from "js-cookie";
export default {
  data() {
    return {
      name: "",
      phone: "",
      email: "",
      studentId: "",
      yearOfStudy: "",
      valid: true,
      courseProgramName: "",
      universityName: "",
      dataPay: [],
      currentDate: "",
      date: new Date().toISOString(),
      nameRules: [
        (value) => !!value || "Name is required",
        (value) =>
          (value && value.length >= 2) ||
          "Name needs to be at least 2 characters",
      ],
      phoneRules: [
        (value) => !!value || "Phone number is required",
        (value) =>
          !value ||
          (value &&
            value.length > 8 &&
            value.length < 15 &&
            /[0-15-]+/.test(value)) ||
          "Phone number must be between 9 and 15 digits",
      ],
      emailRules: [
        (value) => !!value || "Email is required",
        (value) =>
          /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(value) ||
          "E-mail must be valid",
      ],
      courselRules: [(value) => !!value || "Course/Program name required"],
      studentIdRules: [(value) => !!value || "Student id is required"],
      yearOfStudyRules: [
        (value) => !!value || "Name year of study is required",
        (value) => /^\d+$/.test(value) || "Value must be an integer",
        (value) => value <= 8 || "Year of study can not more than 8",
      ],
      universityNameRules: [
        (value) => !!value || "University name is required",
      ],
    };
  },
  methods: {
    submit() {
      if (
        this.name != "" &&
        this.phone != "" &&
        this.studentId != "" &&
        this.yearOfStudy != "" &&
        this.courseProgramName != "" &&
        this.universityName != ""
      ) {
        const newPay = {
          name: this.name,
          phone: this.phone,
          studentId: this.studentId,
          yearOfStudy: this.yearOfStudy,
          courseProgramName: this.courseProgramName,
          universityName: this.universityName,
        };
        Cookies.set("paymentInfo", JSON.stringify(newPay), { expires: 1 });
        this.dataPay = newPay;
        this.$router.push("/paymentbycard");
      } else {
        this.valid = false;
      }
    },
  },
};
</script>

<style scoped>
form {
  width: 60%;
  box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  padding: 20px;
  background: #ffffff;
  margin: auto;
  flex: 1;
  margin-right: 15px;
}
.groupForm {
  margin: 20px;
  display: flex;
}
.image {
  flex: 1;
}
.item {
  display: flex;
  gap: 20px;
  margin: 10px;
}

h1 {
  text-align: center;
  color: orange;
  margin-top: 20px;
  margin-bottom: 20px;
}

.next {
  margin-left: 73%;
  background-color: #634b7a;
  color: #f6eeee;
}
.back {
  background-color: orange;
  color: #f6eeee;
}
.btn{
  display: flex;
    margin-left: 1.5%;
}
.input-field {
  width: 50%;
}
</style>
