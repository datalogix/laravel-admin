import Hookable from 'hable'
import Vue from 'vue'
import getConfig from './getConfig'
import { resolvePlugins } from './utils'
import VueRouter from './plugins/vue-router'
import Vuetify from './plugins/vuetify'
import GlobalSearch from './components/GlobalSearch.vue'
import Notifications from './components/Notifications.vue'

export default class Admin extends Hookable {
  constructor(config) {
    super()

    this.config = getConfig(config);
  }

  async _initApp() {
    if (this.app) {
      return this.app
    }

    Vue.component('global-search', GlobalSearch);
    Vue.component('notifications', Notifications);

    Vue.mixin({
      methods: {
        __(param) {
          return param;
        }
      }
    });

    const plugins = resolvePlugins(this.config)

    this.router = VueRouter({ base: this.config.base })
    this.vuetify = Vuetify(this.config.vuetify)
    this.app = new Vue({
      ...plugins,
      router: this.router,
      vuetify: this.vuetify,
      data: {
        drawer: null,
      },
    })

    return this.app
  }

  async init() {
    this.showLoading()

    await this.callHook('init', Vue, this)

    const app = await this._initApp()

    await this.callHook('booting', Vue, this)

    app.$mount(this.config.el)

    await this.callHook('booted', Vue, this)

    this.hideLoading()
  }

  showLoading() {
    if (typeof this.config.loading === 'string') {
      document.documentElement.classList.add(this.config.loading)
    }
  }

  hideLoading() {
    if (typeof this.config.loading === 'string') {
      document.documentElement.classList.remove(this.config.loading)
    }
  }
}
