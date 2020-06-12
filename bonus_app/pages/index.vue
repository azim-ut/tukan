<template>
  <div>
    <b-container>
      <b-row align-v="center" style="width: 90%;">
        <b-col
          class="contentBlock"
          style="
            z-index: 100;
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
          <ul class="scrollPoints">
            <li
              v-for="row in tabs"
              :key="row"
              :class="row === tab ? 'active' : ''"
              @click="toStep(row)"
            >
              <font-awesome-icon :icon="['fas', 'circle']" />
            </li>
          </ul>
          <div>
            <engage-level />
            <phone v-if="tab === 'phone'" />
            <social-auth v-if="tab === 'social'" />
            <push v-if="tab === 'push'" />

            <b-button
              class="backSubmit"
              type="button"
              variant="primary"
              @click="BackStep()"
            >
              <div>&lt;</div>
            </b-button>

            <b-button
              class="forwardSubmit"
              type="button"
              variant="primary"
              @click="ForwardStep()"
            >
              <div>&gt;</div>
            </b-button>
          </div>
          <div></div>
        </b-col>
      </b-row>
    </b-container>

    <b-modal id="social-auth" centered title="BootstrapVue">
      <p class="my-4">Vertically centered modal!</p>
    </b-modal>
  </div>
</template>
<script>
import axios from 'axios'
import EngageLevel from '~/components/EngageLevel.vue'
import Phone from '~/components/Phone.vue'
import Push from '~/components/Push.vue'
import SocialAuth from '~/components/SocialAuth.vue'

export default {
  components: {
    EngageLevel,
    SocialAuth,
    Push,
    Phone
  },
  fetch({ redirect }) {},
  data() {
    return {
      tabs: ['phone', 'social', 'push'],
      tab: null,
      form: {
        email: '',
        name: '',
        pwd: '',
        checked: []
      },
      show: true,
      engaged: 0
    }
  },
  created() {
    axios.get('/core/rest/loyalty/engaged').then((res) => {
      this.tab = this.tabs[0]
      if (res.data.data) {
        // eslint-disable-next-line nuxt/no-globals-in-created
        window.console.log(res.data.data)
      }
    })
  },
  methods: {
    BackStep() {
      let ind = this.tabs.indexOf(this.tab)
      ind--
      if (ind < 0) {
        ind = this.tabs.length - 1
      }
      this.tab = this.tabs[ind]
    },
    toStep(val) {
      this.tab = val
    },
    ForwardStep() {
      let ind = this.tabs.indexOf(this.tab)
      ind++
      if (ind > this.tabs.length - 1) {
        ind = 0
      }
      this.tab = this.tabs[ind]
    }
  }
}
</script>

<style>
ul.scrollPoints {
  clear: both;
  display: inline-flex;
  position: absolute;
  bottom: 0px;
  left: 0;
  right: 0;
  justify-content: center;
  z-index: 1;
}
ul.scrollPoints li {
  padding: 10px;
  height: 10px;
  display: inline-flex;
  align-items: center;
  list-style: none;
  font-size: 5px;
  color: #717171;
  cursor: pointer;
  vertical-align: middle;
}
ul.scrollPoints li.active {
  color: #0b2e13;
  font-size: xx-small;
}
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
  min-width: 50vw;
}

.backSubmit,
.forwardSubmit {
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
  z-index: 10;
}

.backSubmit {
  left: 10px;
}

.backSubmit div,
.forwardSubmit div {
  border-radius: 30px;
  background: #3a3af5;
  margin: 0 0 0 0;
  width: 40px;
  color: #fff;
}
</style>
