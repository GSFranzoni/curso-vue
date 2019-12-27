<template>
    <div id="app">
        <h1>Super Quiz</h1>
        <transition name="flip" mode="out-in">
            <app-result @nextQuestion="nextQuestion" v-if="result" :correct="correct"></app-result>
            <app-question v-else @correct="whenAnswer" :question="questions[questionIndex]"></app-question>
        </transition>
    </div>
</template>

<script>
import questions from "./util/questions";
import Question from "./components/Question";
import Result from "./components/Result";

export default {
    mixins: [questions],
    data: function() {
        return {
            questionIndex: 0,
            correct: false,
            result: false
        };
    },
    components: {
        "app-question": Question,
        "app-result": Result
    },
    methods: {
        whenAnswer: function($correct) {
            this.correct = $correct;
            this.result = true;
        },
        nextQuestion: function() {
            this.questionIndex += 1;
            this.questionIndex%=this.questions.length;
            this.result = false;
        }
    }
};
</script>

<style>
body {
    background: linear-gradient(to right, rgb(0, 0, 70), rgb(28, 181, 224));
    font-family: "Oswald", sans-serif;
    color: #fff;
    height: 100vh;
}

.questions {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
}

#app {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;

    display: flex;
    flex-direction: column;
    align-items: center;
}

#app h1 {
    font-weight: 200;
    font-size: 4rem;
}

@keyframes flip-out {
    from {
        transform: rotateY(0deg);
    }
    to {
        transform: rotateY(90deg);
    }
}

@keyframes flip-in {
    from {
        transform: rotateY(90deg);
    }
    to {
        transform: rotateY(0deg);
    }
}

.flip-enter-active {
    animation: flip-in 0.3s ease;
}

.flip-leave-active {
    animation: flip-out 0.3s ease;
}
</style>
