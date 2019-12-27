<template>
    <div class="display">{{ result }}</div>
</template>

<script>
export default {
    computed: {
        result: function() {
            return this.$store.state.result;
        }
    }
};
</script>

<style>
.display {
    overflow-x: scroll;
    grid-column: span 4;
    height: 100px;
    color: #fff;
    background-color: rgba(0, 0, 0, 0.6);
    font-size: 2.5rem;
    display: flex;
    flex-direction: row-reverse;
    justify-content: start;
    align-items: center;
    padding-right: 10px;
}
::-webkit-scrollbar {
    width: 12px;
}

::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
}
</style> 