// Import font Inter dengan berbagai varian
import '@fontsource/inter/300.css';      // Light
import '@fontsource/inter/400.css';      // Regular
import '@fontsource/inter/500.css';      // Medium
import '@fontsource/inter/600.css';         // SemiBold
import '@fontsource/inter/700.css';         // Bold
import '@fontsource/inter/400-italic.css';  // Italic


// Import font lainnya
import '@fontsource/sunshiney';
import '@fontsource/spicy-rice';
import '@fontsource/stalemate';

import '../css/app.css';
import './bootstrap';


import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
