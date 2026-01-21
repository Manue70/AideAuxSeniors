import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',         
                'resources/css/login-page.css',
                'resources/css/onboarding.css',
                'resources/css/dashboard.css',
                'resources/css/info-pages.css',
                'resources/css/reminders.css',
                'resources/css/assistance.css',
                'resources/css/admin.css', 
                'resources/css/header-footer.css',
                'resources/js/app.js',          
                
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
