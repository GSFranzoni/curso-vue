<template>
  <div class='person' v-if="person">
      <h1>ID: {{ person.id }}</h1>
      <h1>Name: {{ person.name }}</h1>
      <h1>Age: {{ person.age }}</h1>
  </div>
  <div class='person' v-else>
      <h2>Nobody selected</h2>
  </div>
</template>

<script>

import bus from '../bus';

export default {
    data: function() {
        return  {
            person: null
        }
    },
    methods: {

    },
    created: function() { 
        bus.onChange((person) => {
            this.person = person;
        });
    }
}
</script>

<style scoped>
    .person {
        border: 1px solid #cccccc;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>