import { defineConfig } from 'vitepress'

// https://vitepress.dev/reference/site-config
export default defineConfig({
    cleanUrls: true,
    title: 'Envelop',
    description: 'Next generation emails for Laravel',
    themeConfig: {
        // https://vitepress.dev/reference/default-theme-config
        nav: [
            { text: 'Home', link: '/' },
            { text: 'Docs', link: '/overview/introduction' },
            {
                text: 'Sponsor',
                link: 'https://github.com/sponsors/Larsklopstra',
            },
        ],

        sidebar: [
            {
                text: 'Overview',
                items: [
                    { text: 'Introduction', link: '/overview/introduction' },
                    { text: 'Installation', link: '/overview/installation' },
                ],
            },
            {
                text: 'Atomic CSS',
                items: [
                    { text: 'Introduction', link: '/atomic/introduction' },
                    { text: 'Rules', link: '/atomic/rules' },
                    { text: 'Themes', link: '/atomic/themes' },
                    { text: 'Presets', link: '/atomic/presets' },
                    { text: 'Parser', link: '/atomic/parser' },
                ],
            },
            {
                text: 'Components',
                items: [
                    { text: 'Body', link: '/components/body' },
                    { text: 'Button', link: '/components/button' },
                    { text: 'Column', link: '/components/column' },
                    { text: 'Container', link: '/components/container' },
                    { text: 'Font', link: '/components/font' },
                    { text: 'Head', link: '/components/head' },
                    { text: 'Heading', link: '/components/heading' },
                    { text: 'Hr', link: '/components/hr' },
                    { text: 'Html', link: '/components/html' },
                    { text: 'Img', link: '/components/img' },
                    { text: 'Link', link: '/components/link' },
                    { text: 'Preview', link: '/components/preview' },
                    { text: 'Row', link: '/components/row' },
                    { text: 'Section', link: '/components/section' },
                    { text: 'Text', link: '/components/text' },
                ],
            },
        ],

        socialLinks: [
            { icon: 'github', link: 'https://github.com/larsklopstra/envelop' },
            { icon: 'x', link: 'https://x.com/larsklopstra' },
        ],

        search: {
            provider: 'local',
        },

        footer: {
            message: 'Released under the MIT License.',
            copyright: 'Copyright © 2026-present Lars Klopstra',
        },
    },
})
