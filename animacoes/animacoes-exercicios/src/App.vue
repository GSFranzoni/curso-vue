<template>
  <div id="app" class="container-fluid">
    <h1>Animações</h1>
    <hr />
    <!--
    <b-button @click="exibir=!exibir" variant="primary" class="mb-4">Mostrar mensagem</b-button>

     <transition name="fade" appear>
      <b-alert v-if="exibir" variant="info" show>{{ msg }}</b-alert>
    </transition>

    <transition name="slide" type="animation" appear>
      <b-alert v-show='exibir' variant="info" show>{{ msg }}</b-alert>
    </transition>

	<transition 
		leave-active-class="animated bounce"
		enter-active-class="animated shake"
		>
      <b-alert v-show='exibir' variant="info" show>{{ msg }}</b-alert>
    </transition> 

	<hr>
	<b-select v-model='tipo'>
		<option value="fade">Fade</option>
		<option value="slide">Slide</option>
	</b-select>
	<transition :name="tipo">
      <b-alert v-show='exibir' variant="info" show>{{ msg }}</b-alert>
    </transition>
    
    <b-select v-model="tipo">
      <option value="fade">Fade</option>
      <option value="slide">Slide</option>
    </b-select>
    <transition :name="tipo" mode="out-in">
      <b-alert v-if="exibir" variant="info" key="info" show>{{ msg }}</b-alert>
      <b-alert v-else variant="warning" key="warning" show>{{ msg }}</b-alert>
    </transition>

    <hr />
    <button @click="exibir2=!exibir2">Alterar</button>
    <transition
      :css="false"
      @before-enter="beforeEnter"
      @enter="enter"
      @after-enter="afterEnter"
      @enter-canceled="enterCancelled"
      @before-leave="beforeLeave"
      @leave="leave"
      @after-leave="afterLeave"
      @leave-canceled="leaveCancelled"
    >
      <div v-if="exibir2" class="caixa"></div>
    </transition>

    <hr />

    <div class="mb-4">
      <b-button class="mr-2" variant="primary" @click="componenteSelecionado='AlertaInfo'">Info</b-button>
      <b-button variant="secondary" @click="componenteSelecionado='AlertaAdvertencia'">Advertencia</b-button>
    </div>

    <transition name="fade" mode="out-in">
      <component :is="componenteSelecionado"></component>
    </transition>
    -->
    <hr />
    <b-button @click="addAluno">Add Aluno</b-button>
    <transition-group tag="div" name="slide" mode="out-in">
      <b-list-group @click="remove(i)" v-for="(aluno, i) in alunos" :key="aluno">
        <b-list-group-item>{{ aluno }}</b-list-group-item>
      </b-list-group>
    </transition-group>
  </div>
</template>

<script>
import AlertaAdvertencia from "./AlertaAdvertencia";
import AlertaInfo from "./AlertaInfo";

export default {
  data: function() {
    return {
      msg: "Uma mensagem de informação para o usuário!",
      exibir: false,
      exibir2: true,
      tipo: "fade",
      larguraBase: 0,
      componenteSelecionado: "AlertaInfo",
      alunos: ["Roberto", "Ana", "Tereza", "Guilherme", "Joana"]
    };
  },
  methods: {
    addAluno() {
      const s = Math.random()
        .toString(36)
        .substring(2)
        .split("")
        .filter(c => {
          return !(c >= "0" && c <= "9");
        })
        .join("");
      this.alunos.push(s);
    },
    remove(i) {
      this.alunos.splice(i, 1);
    },
    animar(el, done, negativo) {
      let rodada = 1;
      const temporizador = setInterval(() => {
        const novaLargura =
          this.larguraBase + (negativo ? -1 : 1) * rodada * 10;
        el.style.width = `${novaLargura}px`;
        rodada++;
        if (rodada > 30) {
          clearInterval(temporizador);
          done();
        }
      }, 20);
    },
    beforeEnter(el) {
      this.larguraBase = 0;
      el.style.width = "0px";
    },
    enter(el, done) {
      this.animar(el, done, false);
    },
    afterEnter(el) {
      console.log("afterEnter");
    },
    enterCancelled() {
      console.log("enterCancelled");
    },
    beforeLeave(el) {
      this.larguraBase = 300;
      el.style.width = "300px";
    },
    leave(el, done) {
      this.animar(el, done, true);
    },
    afterLeave(el) {
      console.log("afterLeave");
    },
    leaveCancelled() {
      console.log("leaveCancelled");
    }
  },
  components: { AlertaInfo, AlertaAdvertencia }
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  font-size: 1.5rem;
}

.caixa {
  height: 100px;
  width: 300px;
  margin: 30px auto;
  background-color: lightgreen;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.fade-leave-active,
.fade-enter-active {
  position: absolute;
  width: 100%;
  left: 0;
  box-sizing: border-box;
  transition: opacity 1s;
}
/*
.slide-leave-active {
  animation: slide-out 1s ease;
}
.slide-enter-active {
  animation: slide-in 1s ease;
}
*/
@keyframes slide-in {
  from {
    transform: translateY(40px);
  }
  to {
    transform: translateY(0);
  }
}

@keyframes slide-out {
  from {
    transform: translateY(0);
  }
  to {
    transform: translateY(40px);
  }
}

.slide-enter,
.slide-leave-to {
  opacity: 0;
}

.slide-leave-active {
  position: absolute;
  width: 100%;
  left: 0;
  animation: slide-out 1s ease;
  transition: opacity 1s;
}
.slide-enter-active {
  position: absolute;
  width: 100%;
  left: 0;
  animation: slide-in 1s ease;
  transition: opacity 1s;
}

.slide-move {
  transition: transform 1s;
}

.fade-move {
  transition: transform 1s;
}
</style>
