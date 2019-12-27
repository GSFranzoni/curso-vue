<template>
  <div class="citacao">
    <slot name="fonte"></slot>
    <slot></slot>
    <div class="autor">
      <slot name="autor"></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {},
  created: function() {
      console.log('created')
  },
  destroyed: function() {
      console.log('destroyed')
  },
  activated: function() {
      console.log('activated')
  },
  deactivated: function() {
      console.log('deactivated')
  }
};
</script>

<style scoped>
.citacao {
  margin: 15px;
  border: 1px solid #ddd;
  background-color: rgba(0, 0, 0, 0.1);
  padding: 25px;
  max-width: 450px;
}
h1 {
  color: red !important;
}
.autor {
    float: right;
}
</style>
