<template>
    <div @click='onClick' :class="{button: true, double, triple, operation}">
        {{ label }}
    </div>
</template>

<script>
export default {
    props: {
        label: {
            type: String,
            required: true
        },
        operation: {
            type: Boolean
        },
        double: {
            type: Boolean,
            default: false
        },
        triple: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        onClick: function() {
            switch(this.label) {
                case 'AC':
                    this.$store.dispatch('clear');
                    break;
                case '=':
                    this.$store.dispatch('calculate');
                    break;
                default:
                    this.$store.dispatch('update', this.label);
                    break;
            }
        }
    }
};
</script>

<style>
    .button {
        border: 1px solid black;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 3em;
        font-weight: 300;
    }
    .button:active {
        background-color: rgba(0, 0, 0, 0.2);
    }
    .triple {
        grid-column: span 3;
    }
    .double {
        grid-column: span 2;
    }
    .operation {
        color: white;
        background-color: #fa8231;
    }
    .operation:active {
        background-color: #b4510f;
    }
</style>