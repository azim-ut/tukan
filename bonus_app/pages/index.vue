<template>
  <div>
    <b-container>
      <b-row align-v="center">
        <b-col
          class="contentBlock"
          style="
            padding: 0;
            position: relative;
            overflow: hidden;
            display: flex;
            border-radius: 25px;
            min-height: 80vh;
            justify-content: center;
            vertical-align: center;
            align-items: center;
          "
        >
          <div style="">
            <font-awesome-icon :icon="['fab', 'linkedin']" />
            <b-form v-if="show" @submit="onSubmit" @reset="onReset">
              <b-input-group prepend="Email" class="mb-2">
                <b-form-input
                  v-model="form.email"
                  aria-label="First name"
                  type="email"
                ></b-form-input>
              </b-input-group>
              <b-input-group prepend="Name" class="mb-2">
                <b-form-input
                  v-model="form.name"
                  aria-label="First name"
                  type="email"
                ></b-form-input>
              </b-input-group>

              <b-button
                class="formSubmit"
                type="button"
                variant="primary"
                @click="FirstStep()"
                >Send
                <div>&gt;</div></b-button
              >
            </b-form>
            <engage-level />
          </div>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script>
import EngageLevel from '~/components/EngageLevel.vue'

export default {
  components: {
    EngageLevel,
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        dob: '',
        fb: '',
        w_app: '',
        instagram: '',
        telegram: '',
        checked: [],
      },
      show: true,
      FirstStep() {
        this.$root.$emit('engaged', 20)
      },
    }
  },
  methods: {
    onSubmit: {},
    onReset: {},
  },
}
</script>

<style>
.container {
  margin: 0 auto;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}
.contentBlock {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}
.formSubmit {
  position: absolute;
  display: flex;
  right: 10px;
  bottom: 10px;
  color: #0f3e68 !important;
  padding: 0;
  line-height: 40px;
  border: none;
  font-size: small;
  background: transparent !important;
}

.formSubmit div {
  border-radius: 30px;
  background: #3a3af5;
  margin: 0 0 0 5px;
  width: 40px;
  color: #fff;
}
</style>
