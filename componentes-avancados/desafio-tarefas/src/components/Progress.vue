<template>
  <div class="progress">
    <div
      class="progress-bar progress-bar-striped progress-bar-animated"
      role="progressbar"
      aria-valuenow="75"
      aria-valuemin="0"
      aria-valuemax="100"
      :style="{'width': percent+'%'}"
    ></div>
    <strong>{{ percent.toFixed(2) }}%</strong>
  </div>
</template>

<script>
export default {
  props: ["percent"]
};
</script>

<style>
.progress-bar {
  transition: width 0.5s;
}
.progress {
  position: relative;
  height: 35px;
  width: 70%;
  background-color: rgba(0, 0, 0, 0.2);
  color: white;
}
strong {
  position: absolute;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
}
</style>