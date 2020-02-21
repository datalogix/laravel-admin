import merge from 'deepmerge'
import * as locales from 'vuetify/lib/locale'

export default function (config) {
  let locale = String(config.locale).toLowerCase()

  if (!locales[locale]) {
    locale = locale.substr(0, 2)

    if (!locales[locale]) {
      locale = 'pt'
    }
  }

  const defaults = {
    el: '#app',
    base: '/',
    loading: 'admin-loading',
    vuetify: {
      lang: {
        locales,
        current: locale,
      }
    },
    plugins: {},
  }

  return merge(defaults, config)
}
