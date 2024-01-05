const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  pwa: {
    name: "OrMin Livestock Monitoring",
    themeColor: "#1867C0",
    iconPaths: {
      favicon32: 'img/icons2/favicon-32x32.png',
      favicon16: 'img/icons2/favicon-16x16.png',
      appleTouchIcon: 'img/icons2/apple-touch-icon.png',
      maskIcon: 'img/icons2/safari-pinned-tab.svg',
      msTileImage: 'img/icons2/mstile-150x150.png',
    },
    icons:{
      
    }
  },

  transpileDependencies: true,

  pluginOptions: {
    vuetify: {
			// https://github.com/vuetifyjs/vuetify-loader/tree/next/packages/vuetify-loader
		}
  },
})
