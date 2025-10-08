// cypress/e2e/home.spec.ts
describe('Home page', () => {
    it('should load and show welcome message', () => {
        cy.visit('http://localhost:8080');
        cy.contains('Bem-vindo');
    });
});
