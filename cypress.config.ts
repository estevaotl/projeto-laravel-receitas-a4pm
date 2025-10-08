import { defineConfig } from 'cypress';

export default defineConfig({
    e2e: {
        baseUrl: 'http://nginx_server',
        specPattern: 'cypress/e2e/**/*.spec.ts',
        supportFile: false,
    },
});
