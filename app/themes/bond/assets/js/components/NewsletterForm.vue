<template>
  <div class="newsletter-form">
    <form
      :class="{ 'form-processing': form.processing }"
      class="form"
      @submit.prevent="submit"
    >
      <div class="row">
        <div class="col-12 col-lg-6">
          <input
            v-model="email"
            type="email"
            placeholder="E-MAIL"
          >
        </div>

        <div class="col-12 col-lg-6">
          <div class="newsletter-form-control">
            <button>{{ submitLabel }}</button>
            <h6
              v-if="form.message"
              :class="'status-'+form.status"
              class="form-message"
              v-html="form.message"
            />
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import Form from '../support/Form'

export default {
  props: {
    submitLabel: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      email: '',

      form: new Form({
        baseUrl: '/wp-json/bond/',
        default: {
          lang: window.LANGUAGE_CODE
        }
      })
    }
  },

  methods: {
    submit() {
      if (this.form.processing) {
        return
      }

      // console.log(this.form.data());

      this.form.post('newsletter-subscribe', {
        email: this.email
      })

      // .then(response => {
      //   console.log(response, 'response');
      // })
      // .catch(error => {
      //   console.log(error, 'error');
      // });
    }
  }
}
</script>
