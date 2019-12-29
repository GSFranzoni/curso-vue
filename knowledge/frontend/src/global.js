import Vue from 'vue';

export const userKey = '__knowledge_user'

export const baseApiUrl = 'http://localhost:8100';

export function showError(message) {
    Vue.toasted.show(message, { 
        type: 'error',
        theme: "toasted-primary", 
        position: "top-center", 
        duration : 3000
   });
}

export function showSuccess(message) {
    Vue.toasted.show(message, { 
        type: 'success',
        theme: "toasted-primary", 
        position: "top-right", 
        duration : 3000
   });
}


export function parseBoolean(string) {
    switch(string.toLowerCase().trim()){
        case "true": case "yes": case "1": return true;
        case "false": case "no": case "0": case null: return false;
        default: return Boolean(string);
    }
}

export default { baseApiUrl, showError, showSuccess, userKey, parseBoolean }