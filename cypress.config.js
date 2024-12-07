import { defineConfig } from "cypress";

export default defineConfig({
  e2e: {
    
    baseUrl: 'http://localhost/proyectoSistemaBotica02/public/',

    setupNodeEvents(on, config) {
      // implementa aquí los listeners de eventos de nodo
    },
    specPattern: "cypress/e2e/**/*.cy.{js,jsx,ts,tsx}", // Define el patrón de especificaciones
    excludeSpecPattern: [
      "**/1-getting-started/*.js",
      "**/2-advanced-examples/*.js"
    ],

    "viewportWidth": 1920,
    "viewportHeight": 1080,

    testIsolation: false
  },
});
