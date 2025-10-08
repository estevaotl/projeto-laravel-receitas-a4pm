describe('Home page', () => {
    it('should load and show welcome message', () => {
        cy.visit('/');
        cy.contains('Bem-vindo');
    });
});