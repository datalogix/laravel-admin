import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from '../routes'

Vue.use(VueRouter)

export default function (options) {
    return new VueRouter({
        mode: 'history',
        routes,
        ...options
    })
}
