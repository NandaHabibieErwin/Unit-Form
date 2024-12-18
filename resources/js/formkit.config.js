import { fr } from '@formkit/i18n'
import { defaultConfig } from '@formkit/vue'
import { createMultiStepPlugin } from '@formkit/addons'
import { genesisIcons } from "@formkit/icons"
import { rootClasses } from '../../formkit.theme.mjs'

import '@formkit/addons/css/multistep'

const config = {
  plugins: [createMultiStepPlugin()],
  icons: {
    ...genesisIcons
  },
  config: {
    rootClasses
  }
}

export default config
