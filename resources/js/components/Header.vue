<template>
  <header>
      <nav>
          <ul>
              <!-- <li :class="($route.name == 'home') ? 'active' : ''"> -->
              <li>    
                    <!-- <a href="#" class="active">Home</a> -->

                    <!-- use router-link component for navigation. -->
                    <!-- specify the link by passing the `to` prop. -->
                    <!-- `<router-link>` will be rendered as an `<a>` tag by default -->
                  <router-link :to="{ name: 'home' }">Home</router-link>
              </li>
              <li>
                  <router-link :to="{ name: 'blog' }">Blog</router-link>
              </li>
              <li>
                  <router-link :to="{ name: 'about' }">Chi Siamo</router-link>
              </li>
              <li>
                  <router-link :to="{ name: 'contact-us' }">Contattaci</router-link>
              </li>
          </ul>
      </nav>
  </header>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style lang="scss" scoped>

    ul {
        display: flex;
        justify-content: center;
        li {
            padding: 0 10px;
            list-style-type: none;
        }
    }

</style>