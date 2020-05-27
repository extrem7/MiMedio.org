import Vue from 'vue'

import Lang from 'lang.js'
import messages from './messages.js'

const lang = new Lang({
    messages,
    locale: shared().defaultLocale,
    fallback: shared().fallbackLocale
})

Vue.prototype.lang = (code) => {
    return lang.get('vue.' + code)
}
