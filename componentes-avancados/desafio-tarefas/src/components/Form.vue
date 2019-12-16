<template>
  <div class="input-group w-25">
    <input v-on:keyup.enter="addTask" v-model='task.description' type="text" class="form-control" aria-label="Text input with segmented dropdown button" />
    <div class="input-group-append">
      <button @click="addTask()" type="button" class="btn btn-primary">+</button>
    </div>
  </div>
</template>

<script>

import { uuid } from 'vue-uuid';

export default {
    data: function() {
        return {
            task: {
                id: this.generateId(),
                description: '',
                completed: false
            }
        }
    },
    methods: {
        addTask: function() {
            this.$emit('newTask', this.task);
            this.task = {
                id: this.generateId(),
                description: '',
                completed: false
            }
        },
        generateId: function() {
            return uuid.v1();
        }
    }
};
</script>

<style scoped>

</style>