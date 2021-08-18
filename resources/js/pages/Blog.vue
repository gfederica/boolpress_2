<template>
<div class="cont">
  <h2>Blog</h2>
  
  <Card :post='post' v-for="post in posts" :key="post.id"/>
  <div class="buttons">
    <button class="btn btn-primary" v-show="current_page > 1" @click="getPosts(current_page - 1)">Indietro</button>

    <button class="btn btn-primary" v-show="current_page < last_page" @click="getPosts(current_page + 1)">Avanti</button>
  </div>
  

</div>

</template>

<script>
import Card from '../components/Card';
export default {
    name: 'Blog',
    components: {
        Card
    },
    data: function() {
        return {
            posts: [],
            current_page: 1,
            last_page: 1
        }
    },
    // versione contratta
    created() {
        this.getPosts();
    },
    methods: {
        getPosts: function(page = 1) {
        axios
        // pagina con valore di default 1, gestisco la navigazione sui buttons
        .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
        .then(
          res => {
            this.posts = res.data.data;
            this.current_page = res.data.current_page;
            this.last_page = res.data.last_page;
          }
        )
        .catch(
          err => {
            console.log(err);
          }
        );
      }
    }
}
</script>

<style lang="scss" scoped>
 
</style>