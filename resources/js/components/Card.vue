<template>
  <div class="card">
      <img :src="post.cover" alt="post.title">
      <h3>{{post.title}}</h3>
      <p>{{post.body}}</p>
      <router-link :to="{ name: 'single-post', params: { slug: post.slug } }">Leggi</router-link>
  </div>
</template>

<script>
export default {
    name: 'Card',
    props: [
        'post'
    ]
}
</script>

<style> 
    .card {
        display: flex;
        flex-wrap: wrap;
        width: 25%;
    }
</style>