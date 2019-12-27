import Vue from 'vue';
import axios from 'axios';

//axios.defaults.baseURL = 'https://curso-vue-cod3r-gui.firebaseio.com/';
//axios.defaults.headers.common['Authorization'] = '123';

Vue.use({
    install(Vue) {
        //Vue.prototype.$http = axios;
        Vue.prototype.$http = axios.create({
            baseURL: 'https://curso-vue-cod3r-gui.firebaseio.com/',
            headers: {
                get: {
                    'Authorization': 'abc'
                }
            }
        });

        Vue.prototype.$http.interceptors.request.use(
            config => {
                // eslint-disable-next-line no-console
                console.log(config.method);
                return config;
            },
            error => {
                Promise.reject(error);
            }
        );

        Vue.prototype.$http.interceptors.response.use(
            res => {
                /*
                // eslint-disable-next-line no-console
                const array = [];
                for(let chave in res.data) {
                    array.push({id: chave, ...res.data[chave]});
                }
                res.data = array;
                */
                return res;
            },
            error => {
                Promise.reject(error);
            }
        )
    }
})