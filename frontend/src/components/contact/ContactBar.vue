<template>
    <section>
        <div class="title">
            <h1>Contact Us</h1>
            <p>Have any question? We'd love to hear from you</p>
        </div>
        <div class="container">
            <div class="card">
                <div class="item">
                    <div class="icon">
                        <i class="material-icons">phone</i>
                        <h4>Phone</h4>
                    </div>
                    <p>+885 979273421</p>
                </div>
            </div>
            <div class="card">
                <div class="item">
                    <div class="icon">
                        <i class="material-icons">location_on</i>
                        <h4>Address</h4>
                    </div>
                    <p>BP 511, Phum Tropeang Chhuk (Borey Sorla) Sangtak, Street 371, Phnom Penh, Cambodia</p>
                </div>
            </div>
            <div class="card">
                <div class="item">
                    <div class="icon">
                        <i class="material-icons">mail</i>
                        <h4>Email</h4>
                    </div>
                    <p>ero.cambodia@passerellesnumeriques.org</p>
                </div>
            </div>
        </div>
        <div class="containmap">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3909.0138353924453!2d104.87847017128021!3d11.55086501936944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951add5e2cd81%3A0x171e0b69c7c6f7ba!2sPasserelles%20num%C3%A9riques%20Cambodia%20(PNC)!5e0!3m2!1sen!2snl!4v1689046457730!5m2!1sen!2snl" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
</template>
<script>
</script>

<style scoped>
    .containmap{
        display: flex;
        width: 100%;
        
    }
    iframe {
        margin: auto;
        width: 1400px;
        height:400px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        margin-bottom:20px;

    }
    .title{
        margin-top: 100px;
        text-align: center;
        margin-bottom: 40px;
    }
    .container{
        display: flex;
        justify-content: center;
        width:100%;
        gap: 20px;
        margin-bottom: 40px;
    }
    .card{
        text-align: center;
        width: 30%;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        padding: 10px;
    }
    .icon{
        color:orange;
        display: flex;
        justify-content: center;
    }
</style>
