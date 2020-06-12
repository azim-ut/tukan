<template>
  <div>
    <svg :id="svgId" width="50" height="50">
      <path :id="id" />
    </svg>
  </div>
</template>
<script>
export default {
  data() {
    return {
      id: null,
      svgId: null,
      SVG: document.getElementById(this.svgId),
      SHAPE: document.getElementById(this.id),
      D: 100,
      O: {},
      P: 5,
      NF: 50,
      TFN: {
        /* timing functions */
        'ease-out'(k) {
          return 1 - (1 - k) ** 1.675
        },
        'ease-in-out'(k) {
          return 0.5 * (Math.sin((k - 0.5) * Math.PI) + 1)
        },
        'bounce-ini-fin'(k, s = -0.65 * Math.PI, e = -s) {
          return (
            (Math.sin(k * (e - s) + s) - Math.sin(s)) /
            (Math.sin(e) - Math.sin(s))
          )
        }
      },
      dir: -1,
      rID: null,
      m: null,
      cf: 0,
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
      show: true
    }
  },
  created() {},
  mounted() {
    this.id = 'shape' + this._uid
    this.svgId = 'svg' + this._uid
    this.SVG = window.document.getElementById(this.svgId)
    this.SHAPE = window.document.getElementById(this.id)
    if (this.SVG) {
      this.SVG.setAttribute(
        'viewBox',
        [-0.5 * this.D, -0.5 * this.D, this.D, this.D].join(' ')
      )
    }

    this.O.d = {
      ini: this.getStarPoints(),
      fin: this.getHeartPoints(),
      afn(pts) {
        return pts.reduce((a, c, i) => {
          return a + (i % 3 ? ' ' : 'C') + c
        }, `M${pts[pts.length - 1]}`)
      },
      tfn: 'ease-in-out'
    }

    this.O.transform = {
      ini: -180,
      fin: 0,
      afn: (ang) => this.fnStr('rotate', ang),
      tfn: 'bounce-ini-fin',
      cnt: 1
    }

    this.O.fill = {
      ini: [255, 215, 0],
      fin: [220, 20, 60],
      afn: (rgb) => this.fnStr('rgb', rgb),
      tfn: 'ease-out'
    }

    for (const p in this.O) {
      this.O[p].rng = this.range(this.O[p].ini, this.O[p].fin)
      if (this.SHAPE) {
        this.SHAPE.setAttribute(p, this.O[p].afn(this.O[p].ini))
      }
    }
    if (this.SHAPE) {
      this.SHAPE.addEventListener(
        'click',
        (e) => {
          if (this.rID) this.stopAni()
          this.dir *= -1
          this.m = 0.5 * (1 - this.dir)
          this.update()
        },
        false
      )
    }
  },
  methods: {
    getStarPoints(f = 0.5) {
      const RCO = f * this.D /* outer (pentagram) circumradius */
      const BAS = 2 * ((2 * Math.PI) / this.P) /* base angle for star poly */
      const BAC = (2 * Math.PI) / this.P /* base angle for convex poly */
      const RI =
        RCO * Math.cos(0.5 * BAS) /* pentagram/ inner pentagon inradius */
      const RCI = RI / Math.cos(0.5 * BAC) /* inner pentagon circumradius */
      const ND = 2 * this.P /* total number of distinct points we need to get */
      const BAD = (2 * Math.PI) / ND /* base angle for point distribution */
      const PTS = [] /* array we fill with point coordinates */

      for (let i = 0; i < ND; i++) {
        const /* radius at end point (inner)/ control point (outer) */
          cr = i % 2 ? RCI : RCO
        /* angle of radial segment from origin to current point */
        const ca = i * BAD + 0.5 * Math.PI
        const x = Math.round(cr * Math.cos(ca))
        const y = Math.round(cr * Math.sin(ca))

        PTS.push([x, y])
        /* for even indices double it, control points coincide here */
        if (!(i % 2)) PTS.push([x, y])
      }

      return PTS
    },

    getHeartPoints(f = 0.25) {
      const R = f * this.D /* helper circle radius  */
      const RC = Math.round(
        R / Math.SQRT2
      ) /* circumradius of square of edge R */
      const XT = 0
      const YT = -RC /* coords of point T */
      const XA = 2 * RC
      const YA = -RC /* coords of A points (x in abs value) */
      const XB = 2 * RC
      const YB = RC /* coords of B points (x in abs value) */
      const XC = 0
      const YC = 3 * RC /* coords of point C */
      const XD = RC
      const YD = -2 * RC /* coords of D points (x in abs value) */
      const XE = 3 * RC
      const YE = 0 /* coords of E points (x in abs value) */
      /* const for cubic curve approx of quarter circle */
      const C = 0.551915
      const CC = 1 - C
      /* coords of ctrl points on TD segs */
      const XTD = Math.round(CC * XT + C * XD)
      const YTD = Math.round(CC * YT + C * YD)
      /* coords of ctrl points on AD segs */
      const XAD = Math.round(CC * XA + C * XD)
      const YAD = Math.round(CC * YA + C * YD)
      /* coords of ctrl points on AE segs */
      const XAE = Math.round(CC * XA + C * XE)
      const YAE = Math.round(CC * YA + C * YE)
      /* coords of ctrl points on BE segs */
      const XBE = Math.round(CC * XB + C * XE)
      const YBE = Math.round(CC * YB + C * YE)

      return [
        [XC, YC],
        [XC, YC],
        [-XB, YB],
        [-XBE, YBE],
        [-XAE, YAE],
        [-XA, YA],
        [-XAD, YAD],
        [-XTD, YTD],
        [XT, YT],
        [XTD, YTD],
        [XAD, YAD],
        [XA, YA],
        [XAE, YAE],
        [XBE, YBE],
        [XB, YB]
      ].map(([x, y]) => [x, y - 0.09 * R])
    },

    fnStr(fName, fArg) {
      return `${fName}(${fArg})`
    },

    range(ini, fin) {
      return typeof ini === 'number'
        ? fin - ini
        : ini.map((c, i) => this.range(ini[i], fin[i]))
    },

    int(ini, rng, tfn, k, cnt) {
      return typeof ini === 'number'
        ? Math.round(
            ini + cnt * (this.m + this.dir * tfn(this.m + this.dir * k)) * rng
          )
        : ini.map((c, i) => this.int(ini[i], rng[i], tfn, k, cnt))
    },

    stopAni() {
      cancelAnimationFrame(this.rID)
      this.rID = null
    },

    update() {
      this.cf += this.dir

      const k = this.cf / this.NF

      for (const p in this.O) {
        const c = this.O[p]

        this.SHAPE.setAttribute(
          p,
          c.afn(
            this.int(c.ini, c.rng, this.TFN[c.tfn], k, c.cnt ? this.dir : 1)
          )
        )
      }

      if (!(this.cf % this.NF)) {
        this.stopAni()
        return
      }

      this.rID = requestAnimationFrame(this.update)
    }
  }
}
</script>
<style>
body {
  /*animation: pulse infinite 5s;*/
}

.engageBar {
  width: 100%;
  margin: 10px auto;
  position: relative;
  background: #fff;
  padding: 10px 40px;
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
