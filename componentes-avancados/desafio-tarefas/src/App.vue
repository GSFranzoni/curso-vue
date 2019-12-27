<template>
  <div id="app">
    <h1>Tarefas</h1>
    <app-progress :percent="percent"></app-progress>
    <app-form @newTask="newTask"></app-form>
    <div v-if="tasks.length" class="tasks">
      <app-task @removeTask="removeTask" v-for="task in tasks" :key="task.id" :task="task"></app-task>
    </div>
    <div v-else>
      Sua vida está em dia...
    </div>
  </div>
</template>

<script>
import Progress from "./components/Progress";
import Task from "./components/Task";
import Form from "./components/Form";

export default {
  name: "app",
  data: function() {
    return {
      tasks: []
    };
  },
  components: {
    "app-progress": Progress,
    "app-task": Task,
    "app-form": Form
  },
  methods: {
    newTask: function($task) {
      this.tasks.push($task);
      localStorage.setItem('tasks', JSON.stringify(this.tasks));
    },
    removeTask($id) {
      this.tasks = this.tasks.filter(task => {
        return task.id != $id;
      });
      localStorage.setItem('tasks', JSON.stringify(this.tasks));
    }
  },
  computed: {
    percent: function() {
      let perc = 0;
      this.tasks.forEach((task) => {
        perc+=task.completed?1:0;
      });
      localStorage.setItem('tasks', JSON.stringify(this.tasks));
      return this.tasks.length === 0? 0: perc/this.tasks.length*100;
    }
  },
  created: function() {
    if(!JSON.parse(localStorage.getItem('tasks'))) {
      localStorage.setItem('tasks', JSON.stringify(new Array()));
    }
    this.tasks = JSON.parse(localStorage.getItem('tasks'));
    this.tasks = this.tasks == null? []: this.tasks;
  }
};
</script>

<style>

body {
  background: rgb(238, 174, 202);
  background: radial-gradient(
    circle,
    rgba(238, 174, 202, 1) 0%,
    rgba(148, 187, 233, 1) 100%
  );
}

#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  display: flex;
  flex-direction: column;
  align-items: center;
}

h1 {
  color: black;
  padding: 15px;
}

#app > * {
  margin: 10px;
}

.tasks {
  max-width: 80%;
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}

.tasks > * {
  margin: 4px;
}
</style>
