import './bootstrap';
import '../css/app.css';

import { createApp, DefineComponent, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import '@vuepic/vue-datepicker/dist/main.css';
import { createStore } from 'vuex'
import { viewMode } from "@/store/ViewMode";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const store = createStore({
    modules: {
        viewMode
    }
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(store)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
