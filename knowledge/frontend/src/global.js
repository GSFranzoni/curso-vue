import Vue from 'vue';

export const baseApiUrl = 'http://localhost:8100';

export function showError(message) {
    Vue.toasted.show(message, { 
        theme: "toasted-primary", 
        position: "top-right", 
        duration : 3000
   });
}

export function showSuccess(message) {
    Vue.toasted.show(message, { 
        theme: "toasted-primary", 
        position: "top-center", 
        duration : 3000
   });
}

export default { baseApiUrl, showError, showSuccess }