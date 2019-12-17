<template>
  <div id="app" class="container-fluid">
    <h1>Animações</h1>
    <hr />
    <b-button @click="exibir=!exibir" variant="primary" class="mb-4">Mostrar mensagem</b-button>

    <!-- <transition name="fade" appear>
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
    -->
    <b-select v-model="tipo">
      <option value="fade">Fade</option>
      <option value="slide">Slide</option>
    </b-select>
    <transition :name="tipo" mode="out-in">
      <b-alert v-if="exibir" variant="info" key="info" show>{{ msg }}</b-alert>
      <b-alert v-else variant="warning" key="warning" show>{{ msg }}</b-alert>
    </transition>

    <hr />
    <button @click="exibir2=!exibir2">Mostrar</button>
    <transition
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
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      msg: "Uma mensagem de informação para o usuário!",
      exibir: false,
      exibir2: true,
      tipo: "fade"
    };
  },
  methods: {
    beforeEnter(el) {
      console.log("beforeEnter");
    },
    enter(el, done) {
	  console.log("enter");
	  done();
    },
    afterEnter(el) {
      console.log("afterEnter");
    },
    enterCancelled() {
      console.log("enterCancelled");
    },
    beforeLeave(el) {
      console.log("beforeLeave");
    },
    leave(el, done) {
	  console.log("leave");
	  done();
    },
    afterLeave(el) {
      console.log("afterLeave");
    },
    leaveCancelled() {
      console.log("leaveCancelled");
    }
  }
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
  transition: opacity 1s;
}

.slide-leave-active {
  animation: slide-out 1s ease;
}
.slide-enter-active {
  animation: slide-in 1s ease;
}

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
  animation: slide-out 1s ease;
  transition: opacity 1s;
}
.slide-enter-active {
  animation: slide-in 1s ease;
  transition: opacity 1s;
}
</style>
