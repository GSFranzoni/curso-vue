<template>
  <footer class="footer">
      <span>Copyright <strong>Gui</strong> © 2019</span>
  </footer>
</template>

<script>
export default {
    name: 'Footer',
    data: function() {
        return {
            
        }
    }
}
</script>

<style>
    .footer {
        grid-area: footer;
        background-color: #DDD;
        color: #333;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-right: 20px;
    }
</style>