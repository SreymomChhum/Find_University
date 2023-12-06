<template>
  <div class="groupForm">
    <div class="image">
      <img
        src="../../assets/payment/payment.png"
        style="width: 90%; height: initial"
        alt="Image description"
      />
    </div>
    <v-form @submit.prevent="submit">
      <h1>Make a Payment</h1>
      <div class="content-img">
        <img src="../../assets/payment/unionPay.png" class="img-card" />
        <img src="../../assets/payment/visa.png" class="img-card" />
        <img src="../../assets/payment/aba.png" class="img-card aba" />
      </div>
      <div class="item">
        <v-text-field
          v-model="pay"
          label="Payment amount $ (USD)"
          :rules="paymentRules"
          density="compact"
          placeholder="Enter amount of your payment"
          variant="outlined"
          color="#634B7A"
        ></v-text-field>
      </div>
      <div class="item">
        <v-text-field
          v-model="nameOnCard"
          label="Name on card"
          :rules="nameOnCardRules"
          density="compact"
          placeholder="Enter your card name"
          variant="outlined"
          color="#634B7A"
          class="input-field"
        ></v-text-field>
        <v-text-field
          v-model="numberCard"
          label="Card number"
          :rules="cardNumberRules"
          density="compact"
          placeholder="4111111111111111"
          variant="outlined"
          color="#634B7A"
          class="input-field"
        ></v-text-field>
      </div>
      <div class="item">
        <v-text-field
          v-model="expiryDate"
          label="Expiry date"
          :rules="expiryDateRules"
          density="compact"
          placeholder="MM / YY"
          variant="outlined"
          color="#634B7A"
          class="input-field"
        ></v-text-field>
        <v-text-field
          v-model="securityCode"
          label="Security code"
          :rules="securityCodeRules"
          density="compact"
          placeholder="Example 123"
          variant="outlined"
          color="#634B7A"
          class="input-field"
        ></v-text-field>
      </div>
      <div class="check">
        <v-checkbox
          v-model="checked"
          label="Do you agree to pay?"
          :rules="checkRules"
          color="primary"
        ></v-checkbox>
      </div>
      <v-btn type="submit" class="btn-pay-now">Pay now</v-btn>
    </v-form>
  </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
  data() {
    return {
      expiryDate: "",
      securityCode: "",
      nameOnCard: "",
      numberCard: "",
      checked: "",
      pay: "",
      dataPay: [],
      valid: true,
      paymentRules: [
        (value) => !!value || "Amount is required",
        (value) =>
          /^\d+(\.\d{1,2})?$/.test(value) ||
          "Currency whole dollar, cents optional",
      ],
      cardNumberRules: [
        (value) => !!value || "Card number is required",
        (value) => this.validateCardNumber(value) || "Invalid card number",
        (value) => /^\d+$/.test(value) || "Value must be an integer",
      ],
      securityCodeRules: [
        (value) => !!value || "Security code is required",
        (value) =>
          /^\d{3,4}$/.test(value) || "3-digit (or 4) code on back of card",
      ],
      nameOnCardRules: [
        (value) => !!value || "Name on card is required",
        (value) => /^[A-Za-z\s]+$/.test(value) || "Invalid name on card",
      ],
      expiryDateRules: [
        (value) => !!value || "Expiry date is required",
        (value) =>
          this.validateExpiryDate(value) || "Use 2-digit month / year format",
      ],
      checkRules: [(value) => !!value || "You must agree to continue"],
    };
  },
  methods: {
    // keyword that I search in ai (how to validataion cardnumber for pay in vuetify)
    validateCardNumber(cardNumber) {
      // Remove any non-numeric characters from the string
      cardNumber = cardNumber.replace(/\D/g, "");
      let sum = 0;
      let doubleUp = false;
      for (let i = cardNumber.length - 1; i >= 0; i--) {
        let curDigit = parseInt(cardNumber.charAt(i));
        if (doubleUp) {
          if ((curDigit *= 2) > 9) curDigit -= 9;
        }
        sum += curDigit;
        doubleUp = !doubleUp;
      }
      return sum % 10 == 0;
    },
    // keyword that I search in ai (how to validataion expiryDate for pay in vuetify)
    validateExpiryDate(expiryDate) {
      if (!expiryDate) {
        return false;
      }
      const pattern = /^([01]\d|2[0-2]) \/ \d{2}$/;
      if (!pattern.test(expiryDate)) {
        return false;
      }
      const [month, year] = expiryDate.split(" / ");
      const now = new Date();
      if (parseInt(month) > 12) {
        return false;
      }
      const expiry = new Date(`20${year}`, month, 1);
      return expiry > now;
    },
    submit() {
      if (
        this.pay != "" &&
        this.expiryDate != "" &&
        this.securityCode != "" &&
        this.nameOnCard != "" &&
        this.numberCard != "" &&
        this.checked != ""
      ) {
        const newPay = {
          pay: this.pay,
          expiryDate: this.expiryDate,
          securityCode: this.securityCode,
          nameOnCard: this.nameOnCard,
          numberCard: this.numberCard,
        };
        this.dataPay = newPay;
        this.$router.push("/invoice");
         // https://sweetalert2.github.io/#download
        Swal.fire({
          position: "top-center",
          icon: "success",
          title: "Payment Successful",
          text:
            "Your payment of $" +
            this.pay +
            " has been successfully processed.",
          showConfirmButton: false,
          timer: 4500,
        });
      }
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
form {
  width: 50%;
  box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  padding: 20px;
  background: #ffffff;
  margin: auto;
  margin-right: 15px;
}
.select {
  width: 50%;
  height: 44px;
  color: rgb(141, 137, 137);
  border: 1px solid rgb(124, 123, 123);
  outline-style: solid 1px;
  border-radius: 5px;
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
.select-fee {
  margin-left: 10px;
}

h1 {
  text-align: center;
  color: orange;
  margin-top: 20px;
  margin-bottom: 10px;
}

.check {
  display: flex;
  margin-top: -3%;
}

.btn-pay-now {
  margin-left: 80%;
  background-color: #634b7a;
  color: #f6eeee;
}
.img-card {
  width: 13%;
  margin-left: 6%;
  margin-bottom: 10px;
}

.content-img {
  margin-left: 24%;
  cursor: pointer;
}
.aba {
  margin-bottom: 5%;
}

.input-field {
  width: 50%;
}
</style>
