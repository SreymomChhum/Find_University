<template>
    <div class="message">
        <h1>Page Not Found</h1>
        <img src="../assets/images/notfound2.gif" alt="404 Error">
        <p>Sorry, the page you were looking for could not be found.</p>
        <p>Please check the URL and try again, or click <router-link to="/">here</router-link> to go to the homepage.</p>
    </div>
</template>

<script>
export default {
  name: 'NotFound'
}
</script>

<style scoped>
    h1{
        color: red;
    }
    .message{
        margin: 5%;
        margin-bottom: 15%;
        margin-top: 15%;
        text-align: center;
    }
</style>