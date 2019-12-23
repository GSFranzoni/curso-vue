<template>
    <div @click='!opened?selected=!selected:""' :class="{door: true, selected, opened}">
        <div :class="{label: true, opened}">
            {{ label }}
        </div>
        <div @click='opened=true' :class="{knob: true, selected, opened}"></div>
        <transition enter-active-class="animated rubberBand">
            <app-gift v-if='opened &&  hasGift'/>
        </transition>
        <div class="floor"></div>
    </div>
</template>

<script>
import Gift from './Gift.vue'

export default {
    data: function() {
        return {
            selected: false,
            opened: false
        }
    },
    props: ['label', 'hasGift'],
    methods: {
        
    },
    components: {
        'app-gift': Gift
    }
};
</script>

<style>
    .door, .selected, .label, .knob {
        transition: all .5s;
    }   
    .door {
        margin: 5px;
        border: 7px solid rgb(131, 63, 14);
        border-bottom: none;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        position: relative;
        width: 160px;
        max-width: 100%;
        height: 270px;
        background-color: chocolate;
    }
    .door.selected {
        border: 7px solid rgb(241, 207, 55);
        border-bottom: none;
    }
    .door.opened {
        background-color: rgba(0, 0, 0, 0.25);
    }
    .label {
        font-size: 3rem;
        color: #fff;
    }
    .label.opened {
        color: transparent!important;
    }
    .knob {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background-color: rgb(131, 63, 14);
        position: absolute;
        left: 18px;
        top: 50%;
    }
    .knob.selected {
        background-color: rgb(241, 207, 55);
    }
    .knob.opened {
        display: none;
    }
    .floor {
        background-color: rgb(161, 159, 159);
        width: 180px;
        height: 15px;
    }
</style>