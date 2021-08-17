<template>
    <div id="conteudo">
        <a v-for="(posts, index) in post" :key="posts.id" :href="'/post/'+ index + '/' + posts.title | urlCase">
        <figure class="Fpost">
          <img :src="posts.img" :alt="posts.title + ' - Bubowl'">
          <figcaption>
            <p class="hidden"> {{index}} </p>
            <span>Rolês</span>
            <h2>{{posts.title}}</h2>
          </figcaption>
        </figure>
        </a>
    </div>
</template>
<script>
import axios from 'axios';

export default {
  data(){
    return{
      post: [],
    }
  },
  created: function(){
    console.log(axios);
    axios.get("http://localhost:8000/api/").then(res => {
      this.post = res.data;
      console.log(res.data);
    })
  },
  computed: {
    // resultSearch: function(){
    //   if(this.search == "" || this.search == ' '){
    //     return this.pokemons;
    //   }else{
    //     return this.pokemons.filter(pokemon => pokemon.name == this.search );
    //   }
    // }
  },
  filters: {
    urlCase: function (value) {
      var newUrl = value.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "");
      newUrl = newUrl.replace(/[!"#$%&'()*+,\-.:;<=>?@[\]^_`{|}~]/g, "");
      newUrl = newUrl.replace(/[ \t\r\n\v\f]/g, "-");
      return newUrl;
    }
  }
}
</script>
<style>
    .hidden{
      display: none;
    }
</style>