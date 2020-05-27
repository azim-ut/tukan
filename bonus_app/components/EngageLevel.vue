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
        checked: [],
      },
      show: true,
      updatePercents(val) {
        const newClassList = []
        document
          .querySelector('.engageBar .Loading')
          .classList.forEach((cls) => {
            if (!cls.match(/engaged(\\d+)/)) {
              newClassList.push(cls)
            }
          })
        newClassList.push('engaged' + Math.round(val / 10) * 10)
        document.querySelector(
          '.engageBar .Loading'
        ).classList = newClassList.join(' ')
      },
    }
  },
  created() {
    this.$root.$on('engaged', (val) => {
      this.updatePercents(val)
    })
  },
  methods: {
    onSubmit: {},
    onReset: {},
  },
}
</script>
<style>
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
  width: 0%;
  left: 0;
  height: 100%;
  border-radius: 4px;
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
}
.engageBar .Loading.engaged10:after {
  width: 10%;
}
.engageBar .Loading.engaged20:after {
  width: 20%;
}
.engageBar .Loading.engaged30:after {
  width: 30%;
}
.engageBar .Loading.engaged40:after {
  width: 40%;
}
.engageBar .Loading.engaged50:after {
  width: 50%;
}
.engageBar .Loading.engaged60:after {
  width: 60%;
}
.engageBar .Loading.engaged70:after {
  width: 70%;
}
.engageBar .Loading.engaged80:after {
  width: 80%;
}
.engageBar .Loading.engaged90:after {
  width: 90%;
}
.engageBar .Loading.engaged100:after {
  width: 100%;
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
