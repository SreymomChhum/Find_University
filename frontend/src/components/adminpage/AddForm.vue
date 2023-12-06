<template>
  <v-row justify="center">
    <v-dialog v-model="state.open" persistent width="800" height=" 580" >
      <template v-slot:activator="{ props }">
        <p class="addbtn" color="primary" v-bind="props">Add New User</p>
      </template>
      <v-card>
        <v-card-title> </v-card-title>
        <v-card-text>
          <v-container>
          
            <div class="form-container">
              <form style="height: 500px">
                <h1>Add Student</h1>
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

               

                <div class="select">
                  <select class="role" v-model="state.role_id">
                    <option color="purple" value="">Choose_Role</option>
                    <option value="1">Student</option>
                  </select>
                  <p>Your role is: {{ state.role_id }}</p>
                </div>
                 <v-checkbox
                  class="err"
                  v-model="state.checkbox"
                  :error-messages="v$.checkbox.$errors.map((e) => e.$message)"
                  label="Do you agree?"
                  required
                  @change="v$.checkbox.$touch"
                  @blur="v$.checkbox.$touch"
                ></v-checkbox>
                <div class="btn d-flex justify-space-between">
                  <div class="btn">
                    <v-btn
                      class="btnone"
                      color="purple-darken-1"
                      variant="text"
                      @click="
                        state.open = false;
                        clear();
                      "
                    >
                      Cancel
                    </v-btn>
                  </div>
                  <div class="btn">
                    <div class="btn" v-if="v$.$invalid">
                      <v-btn class="me-4" @click="v$.$touch()">Create</v-btn>
                    </div>
                    <div v-else class="sign-in">
                      <v-btn class="me-4" @click="singIn">Create</v-btn>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
export default {
  data() {
    return {
      dialog: false,
      role_id: "",
    };
  },
};
</script>
<script setup>
import { reactive } from "vue";
import { useVuelidate } from "@vuelidate/core";
import { email, required, minLength } from "@vuelidate/validators";
import axios from "axios";

const initialState = {
  open: false,
  name: "",
  email: "",
  role_id: "",
  checkbox: null,
  password: "",
  emailTakenError: false,
  visible: false,
  opend: true,
};
const state = reactive(Object.assign({}, initialState));
// Set role for password
const passwordRule = (value) => {
  const regex =
    /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+{}|:"<>?~`]).{8,}$/;
  const result = regex.test(value);
  return result;
};
// Rule for name email password
const rules = {
  name: { required, minLength: minLength(3) },
  email: {
    required,
    email,
    async unique() {
      const response = await axios.get(`${process.env.VUE_APP_API_URL}users`);
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
      password: state.password,
    };
    console.log(data);
    // Make an API call to add data to the database

    const response = await axios.post(
      `${process.env.VUE_APP_API_URL}users`,
      data
    );

    // Check the server response and alert the user accordingly
    if (response.status === 200) {
      clear();
      state.open = false;
      location.reload();
    } else {
      alert("Failed to singIn the form");
    }
  } catch (error) {
    console.error(error);
  }
}
</script>
<style scoped>

.container {
  display: flex;
}

.btn {
  display: flex;
  margin-top: 4%;
}
.role {
  border: 2px solid #634b7a;
  padding: 5px;
  border-radius: 5px;
}
.role option {
  color: #634b7a;
}
.select p {
  color: #634b7a;
}
.addbtn {
  background-color: #6a4c93;
  padding: 8px;
  color: white;
  margin-right: 55.5%;
  border-radius: 5px;
  width: 10%;
  margin-bottom: -15px;
  margin-top: 40px;
}
.addbtn:hover {
  background-color: #6a4c93;
  cursor: pointer;
}

p {
  margin-top: 12px;
  width: 100%;
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
  padding: 35px;
  border-radius: 10px;
}
.btn > div > div > button {
  background-color: #634b7a;
  color: #f6eeee;
  margin-left: 10px;
}
.link-sign-up {
  color: #fff;
  background-color: #634b7a;
  text-decoration: none;
}
</style>
