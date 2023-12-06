<template>
  <section>
    <div class="lop" v-for="(item, index) in menbers" :key="index">
      <div class="mision" >
        <div class="text">
          <div class="missiontext">
            <div>
              <h4>{{ item.name }}</h4>
              <p>{{ item.description }}</p>
            </div>
          </div>
        </div>
        <div class="image" >
          <img
            :src="item.src"
            alt="Image"
            style="width: 200px; height: 200px; border-radius: 100px"
          />
        </div>
      </div>
    
    </div>

  </section>
</template>
<script>
export default {
  data() {
    return {
      menbers: [
        {
          name: "SCRUM MASTER",
          description:
            "Hello, my name is Navin Chhorn💙. I'm 19 years old. I'm from Kompong Cham province. Currently I'm a second years student at Passerellesnumeriques Cambodia. On the free time I like: cooking🫕🥗 , travelling🚵🏻🏕🏝, sleeping 🤪🤪",
          src: require("@/assets/images/navin.jpg"),
        },
        {
          name: "TESTER",
          description:
            "My name is Loeub Seyla. I'm 19 years old. I'm from Bonteay MeanChey Province. My position is Tester.",
          src: require("@/assets/images/seyla.jpg"),
        },
        
        {
          name: "DAVOPS MASTER",
          description:
            "My name is Phoung Vibol. I'm 20 years old. I'm from Kompong Cham province. My position is DevOps. My hobby, I like reseachering, cooking and reading books.😍",
          src: require("@/assets/images/vibol.jpg"),
        },
        {
          name: "UX/UI",
          description:
            "My name is Dyna Hen 20 year old From: Pursat Position: Web programming favorite: Watching movie",
          src: require("@/assets/images/dyna.jpg"),
        },
        {
          name: "DATABASE",
          description:
            "Makara Phoem From: Takeo Position: Developer favorite:  listen music, traveling",
          src: require("@/assets/images/makara.jpg"),
        },
        {
          name: "CODE QUALITY",
          description:
            "Sreymom Chhum 20 year old From: Kampong Cham Position: Developer Favorite: Football listen music single ❤️",
          src: require("@/assets/images/sreymom.jpg"),
        },
      ],
    };
  },
};
</script>

<style scoped>
.mision {
  background: #e4e3e3;;
  display: flex;
  padding: 20px;
  width: 100%;
  justify-content: space-around;
}

.text {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  justify-content: center;
  width: 40%;
}
.image {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}
h4{
  color:orange;
}
</style>
