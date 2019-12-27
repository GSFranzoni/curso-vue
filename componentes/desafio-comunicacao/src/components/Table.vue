<template>
  <table class="table table-hover table-bordered table-striped">
      <thead>
          <th>#ID</th>
          <th>Nome</th>
      </thead>
      <tbody>   
          <tr v-for="person in people"  @click="onClick(person)" :key="person.id">
              <td> {{ person.id }} </td>
              <td> {{ person.name }} </td>
          </tr>
      </tbody>
  </table>
</template>

<script>

import bus from '../bus';

export default {
    data: function() {
        return {
            people: [
                {
                    id: 1,
                    name: 'Ana',
                    age: 31
                },
                {
                    id: 2,
                    name: 'Carlos',
                    age: 25 
                },
                {
                    id: 3,
                    name: 'Daniel',
                    age: 48    
                },
                {
                    id: 4,
                    name: 'Ema',
                    age: 21
                },
                {
                    id: 5,
                    name: 'Lia',
                    age: 46
                }
            ]
        }
    },
    methods: {
        onClick(p) {
            bus.setPerson(p);
        }
    }
}
</script>

<style>
    table {
        text-align: center;
    }
</style>