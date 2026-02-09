import type { Theme } from 'vitepress'
import DefaultTheme from 'vitepress/theme-without-fonts'

import '@fontsource-variable/geist-mono'
import '@fontsource-variable/geist'
import './style.css'

export default {
    extends: DefaultTheme,
} satisfies Theme
