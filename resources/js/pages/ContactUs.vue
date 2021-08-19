<template>
  <section class="my-5">
      <h1>Contattaci</h1>

      <div 
        v-show="success"    
        class="alert alert-success">
          Messaggio ricevuto correttamente!
          <br>Ti risponderemo appena possibile.
      </div>

      <form @submit.prevent="sendForm">
          <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" v-model="name" placeholder="Inserisci il tuo nome">
                <small 
                    v-for="(error, index) in errors.name"
                    :key="`err-name-${index}`"
                    class="text-danger d-block">
                    {{ error }}    
                </small>
          </div>
          <div class="form-group">
                <label for="email">Indirizzo Email</label>
                <input type="email" class="form-control" id="email" v-model="email" placeholder="Inserisci il tuo indirizzo e-mail">
                <small 
                    v-for="(error, index) in errors.email"
                    :key="`err-email-${index}`"
                    class="text-danger d-block">
                    {{ error }}    
                </small>
          </div>
          <div class="form-group">
                <label for="message">Messaggio</label>
                <textarea class="form-control" id="message" v-model="message" rows="5" placeholder="Inserisci un messaggio di testo"></textarea>
                <small 
                    v-for="(error, index) in errors.message"
                    :key="`err-message-${index}`"
                    class="text-danger d-block">
                    {{ error }}    
                </small>
          </div>
          <button 
            class="btn btn-primary" 
            type="submit"
            :disabled="sending">
              {{ sending ? 'Invio in corso...' : 'Invia' }}
          </button>
      </form>
  </section>
</template>

<script>
export default {
    name: 'ContactUs',
    data(){
      return{
        name: '',
        email: '',
        message: '',
        errors: {},
        sending: false,
        success: false
      }
    },
    methods:{
      sendForm: function(){
        this.sending = true;

        axios.post('http://127.0.0.1:8000/api/utentes', {
          name: this.name,
          email: this.email,
          message: this.message,
        })
          .then(res=>{
            this.sending = false;

              //console.log(res.data);
              if(res.data.errors) {
                this.errors = res.data.errors;
                this.success = false;
              }else {
                  this.name = '',
                  this.email = '',
                  this.message = '',
                  this.errors = {},
                  this.success = true;
              }
          })
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