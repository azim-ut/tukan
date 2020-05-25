<template>
  <div>
    <div class="engageBar" :style="cssVars">
      <div class="Loading"></div>
    </div>
  </div>
</template>
<script>
export default {
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
        percent: 20,
        checked: []
      },
      show: true,
      updatePercents(val) {
        window.console.log(document.querySelector('.engageBar .Loading:after'))
        // document.querySelector('.engageBar .Loading:after').style.width =
        //   val + '%'
      }
    }
  },
  created() {
    this.$root.$on('engaged', (val) => {
      this.updatePercents(val)
    })
  },
  methods: {
    onSubmit: {},
    onReset: {}
  }
}
</script>
<style scoped>
body {
  /*animation: pulse infinite 5s;*/
}

.engageBar {
  width: 100%;
  margin: 10px auto;
  background: #fff;
  position: relative;
  padding: 20px 40px;
  border-radius: 4px;
  box-sizing: border-box;
}
.engageBar .Loading {
  position: relative;
  display: inline-block;
  width: 100%;
  height: 10px;
  background: #f1f1f1;
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
  border-radius: 4px;
}
.engageBar .Loading:after {
  content: '';
  position: absolute;
  background: #0f0;
  width: 10%;
  left: 0;
  height: 100%;
  border-radius: 4px;
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
}

@keyframes load {
  0% {
    width: 0%;
    background: #f00;
  }
  50% {
    width: 50%;
    background: #00f;
  }
  100% {
    width: 100%;
    background: #0f0;
  }
}

@keyframes pulse {
  0% {
    background: #f00;
  }
  25% {
    background: #00f;
  }
  75% {
    background: #0f0;
  }
  100% {
    background: #f00;
  }
}
#track {
  margin: 5px;
  border: #7b7b7b 2px solid;
  border-radius: 6px;
  overflow: hidden;
  position: relative;
  height: 12px;
  background: #fff;
}
#track #line {
  width: 50%;
  height: 12px;
  margin: 0;
  background-image: linear-gradient(
    to bottom,
    #ffffff,
    #93b454 9%,
    #aaaf37 95%
  );
}

@keyframes appear {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
</style>
