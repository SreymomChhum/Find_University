<template>
    <title-text >Our Map</title-text>  
    <div class="map">
        <iframe class="mt-8" :src="address"  ></iframe>
    </div>
</template>
<script>
export default {
    props:{
        address:String
    }
}
</script>
<style scoped>
    .map{
        display: flex;
        justify-content: center;
        
    }
   iframe{
        width:92%; 
        height:400px;
        margin-bottom: 15px;
    }
</style>