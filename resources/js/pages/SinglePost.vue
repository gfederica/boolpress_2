<template>
  <div class="container">
      <h2>Post</h2>
  </div>
</template>

<script>
export default {
    name: 'SinglePost',
    created: function() {
        // richiamo il metodo della chiamata axios al created
        this.getPost(this.$route.params.slug)
    },
    // collection post inizialmente vuota
    data: function() {
        return {
            post: null
        }
    },
     methods: {
        //  chiamata axios singolo post, come parametro mi serve lo slug perchè lo passo nella query get
        getPost: function(slug) {
            axios
                .get(`http://127.0.0.1:8000/api/posts/${slug}`)
                .then(
                    res => {
                        this.post = res.data;
                        // se importo dei dati, il loading diventa false, disattivo la vista del loader nel v-if dell'articolo
                        // this.loading = false;
                // soluzione con REDIRECT AUTOMATICO piuttosto che col componente: this.$router.push
                        // if(JSON.stringify(res.data) == '{}') {
                        //     this.$router.push( { name: 'not-found' } );
                        // } else {
                        //     (di norma questo va nel res)
                        //     this.post = res.data;
                        //     this.loading = false;
                        // }
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

<style>

</style>