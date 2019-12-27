<template>
    <div class="question">
        <h1>{{ question.text }}</h1>
        <div class='options'>
            <app-option 
                v-for='option in question.options' 
                :key='option.id' 
                :option='option'
                @optionClicked='optionClicked'
            ></app-option>
        </div>
    </div>
</template>

<script>

import Option from './Option';

export default {
    components: {'app-option': Option},
    props: ['question'],
    methods: {
        optionClicked: function($option) {
            this.$emit('correct', $option.correct);
        }
    }
}
</script>

<style>
    .question {
        color: #000;
        background-color: #FFF;
        border-radius: 20px;
        font-size: 2.5rem;
        width: 70%;

        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }
    .options {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
        margin-bottom: 20px;
    }
</style>
