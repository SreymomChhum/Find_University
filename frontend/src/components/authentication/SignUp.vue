<template>
  <div class="container">
    <div class="image">
      <img
        src="../../assets/images/register.png"
        style="width: 100%; height: inherit"
        alt="Image description"
      />
    </div>
    <div class="form-container">
      <form>
        <h1>Register</h1>
        <v-text-field
          class="err"
          v-model="state.name"
          :error-messages="v$.name.$errors.map((e) => e.$message)"
          :counter="10"
          density="compact"
          placeholder="Enter your name"
          prepend-inner-icon="mdi-account"
          variant="outlined"
          color="#634B7A"
          required
          @input="v$.name.$touch"
          @blur="v$.name.$touch"
        ></v-text-field>
        <v-text-field
          class="err"
          v-model="state.email"
          :error-messages="v$.email.$errors.map((e) => e.$message)"
          required
          density="compact"
          placeholder="Enter your email"
          prepend-inner-icon="mdi-email"
          variant="outlined"
          color="#634B7A"
          @input="v$.email.$touch"
          @blur="v$.email.$touch"
        ></v-text-field>
        <p v-if="state.emailTakenError" class="text-error">
          Email is already taken.
        </p>

        <v-text-field
          class="err"
          :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
          color="#634B7A"
          :type="visible ? 'text' : 'password'"
          density="compact"
          placeholder="Enter your password"
          prepend-inner-icon="mdi-lock-outline"
          variant="outlined"
          @click:append-inner="visible = !visible"
          v-model="state.password"
          :error-messages="
            v$.password.$errors.map((e) =>
              e.$params.custom
                ? e.$params.custom.message
                : 'Value required and should contain uppercase, lowercase, number, sign and more than 8 characters'
            )
          "
          @input="v$.password.$touch"
          @blur="v$.password.$touch"
        ></v-text-field>
        <v-checkbox
          class="err"
          v-model="state.checkbox"
          :error-messages="v$.checkbox.$errors.map((e) => e.$message)"
          label="Do you agree?"
          required
          @change="v$.checkbox.$touch"
          @blur="v$.checkbox.$touch"
        ></v-checkbox>
        <div class="btn">
          <div>
            <div v-if="v$.$invalid">
              <v-btn class="me-4" @click="v$.$touch()">Sign up</v-btn>
            </div>
            <div v-else class="sign-in">
              <v-btn class="me-4" @click="singIn">
                <router-link
                  class="link-sign-up"
                  v-if="state.role_id === '1'" to="/">
                   Sign up
                </router-link>
                <router-link class="link-sign-up" v-else to="/logIn" >Sign up</router-link>
              </v-btn>
            </div>
          </div>
          <p>
            Create university page <router-link to="/sendMail/register">click me</router-link>
            Already have an account?<router-link to="/logIn">Log in</router-link><br>
          </p>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { email, required, minLength } from "@vuelidate/validators";
import Cookies from "js-cookie";
import axios from "axios";

const initialState = {
  name: "",
  email: "",
  role_id: "1",
  checkbox: null,
  password: "",
  emailTakenError: false,
};
const state = reactive(Object.assign({}, initialState));
// Set role for password
const passwordRule = (value) => {
  const password =
    /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+{}|:"<>?~`]).{8,}$/;
  const result = password.test(value);
  return result;
};

// Rule for name email password
const rules = {
  name: { required, minLength: minLength(3) },
  email: {
    required,
    email,
    async unique() {
      const response = await axios.get(`${ process.env.VUE_APP_API_URL}users`);
      // compare new data email with data in database
      const datas = response.data.data;
      const emailExists = datas.some((data) => data.email === state.email);
      state.emailTakenError = emailExists;
    },
  },
  password: { required, minLength: minLength(8), custom: passwordRule },
  checkbox: { required },
};

// Clear validation when input correct
const v$ = useVuelidate(rules, state);
function clear() {
  for (const [key, value] of Object.entries(initialState)) {
    state[key] = value;
  }
  v$.value.$reset();
}
// Insert data into dabase
async function singIn() {
  try {
    const data = {
      name: state.name,
      email: state.email,
      role_id: state.role_id,
      checkbox: state.checkbox,
      password: state.password,
    };

    // Make an API call to add data to the database
    const response = await axios.post(`${ process.env.VUE_APP_API_URL}users`, data);
    Cookies.set("userData", JSON.stringify(response.data), { expires: 30 });
    location.reload();
    // Check the server response and alert the user accordingly
    if (response.status === 200) {
      clear();
      this.$router.push('/')
    } else {
      alert("Failed to singIn the form");
    }
  } catch (error) {
    console.error(error);
  }
}
</script>
<!-- style for log in form -->
<style scoped>
.container {
  display: flex;
}
.image {
  flex: 1;
}

.btn {
  display: flex;
}
h1 {
  margin-bottom: 5%;
  margin-top: 3%;
  text-align: center;
}
p {
  margin-left: 33%;
  margin-top: 3%;
}
.err {
  text-align: start;
}
.text-error {
  text-align: start;
  font-family: sans-serif;
  font-size: 12px;
  margin-bottom: 15px;
  margin-top: -20px;
  margin-left: 15px;
}
label {
  color: #634b7a;
}
.form-container {
  box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
  background-color: #fff;
  margin-right: 6%;
  margin: 6%;
  flex: 1;
  padding: 2%;
  border-radius: 10px;
}
.btn > div > div > button {
  background-color: #634b7a;
  color: #f6eeee;
  margin-left: 6%;
}
.link-sign-up {
  color: #fff;
  background-color: #634b7a;
  text-decoration: none;
}
</style>
