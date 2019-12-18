<template>
  <div class="option" @click="optionClicked">
    <div class="option-id">{{ option.id }}</div>
    <div class="option-text">{{ option.text }}</div>
  </div>
</template>

<script>
export default {
  props: ["option"],
  methods: {
    optionClicked: function() {
      this.$emit("optionClicked", this.option);
    }
  }
};
</script>

<style scoped>
.option {
  width: 400px;
  cursor: pointer;
  margin: 20px;
  border-radius: 8px;
  display: flex;
}

.option-id {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  background-color: #1e9c31;
  color: #fff;
  padding: 0 20px 0 20px;
  border-top-left-radius: 8px;
  border-bottom-left-radius: 8px;
}

.option-text {
  background-color: #89c454;
  flex: 1;
}
</style>