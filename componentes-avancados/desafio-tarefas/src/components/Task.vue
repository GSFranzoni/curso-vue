<template>
  <div @click='task.completed=!task.completed' class='task' :style="{'cursor': 'pointer'}" :class="{'task-completed': task.completed}">
      {{ task.description }}
      <a @click="remove">x</a>
  </div>
</template>

<script>
export default {
    props: {
        task: {
            id: 0,
            description: '',
            completed: false
        }
    },
    data: function() {
        return {
            color: 'yellowgreen',
            border: 'seagreen'
        }
    },
    methods: {
        remove: function() {
            this.$emit('removeTask', this.task.id);
        }
    }
}
</script>

<style>
    .task {
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 300px;
        min-height: 150px;
        max-width: 90%;
        position: relative;
        border-radius: 5px;
        color: white;
        border-left: 8px solid rgb(228, 31, 70);
        background-color: rgb(231, 95, 122);
    }
    .task-completed {
        border-left: 8px solid seagreen;
        background-color: rgb(66, 214, 130);
    }
    .task a {
        position: absolute;
        right: 5px;
        top: 5px;
        color: white;
        cursor: pointer;
        background-color: rgba(0, 0, 0, 0.2);
        padding: 3px 10px;
        box-sizing: border-box;
        border-radius: 50%;
        transition: background-color .4s;
    }

    .task a:hover {
        background-color: rgba(0, 0, 0, .6);
    }

    * {
        transition: border, background-color 1s;
    }
</style>