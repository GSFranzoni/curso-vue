<template>
  <div id="app">
    <app-table></app-table>
    <app-person></app-person>
  </div>
</template>

<script>

import Person from './components/Person';
import Table from './components/Table';

export default {
  name: 'app',
  components: {
    'app-person': Person, 'app-table': Table
  }
}
</script>

<style>
#app {
    display: grid;
    grid-template-rows: 1fr;
    grid-template-columns: .6fr .4fr;
}   

app-table {
    grid-area: table;
    background-color: red;
}

app-person {
    grid-area: person;
}

</style>
