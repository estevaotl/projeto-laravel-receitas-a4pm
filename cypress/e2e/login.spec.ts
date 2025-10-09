describe('Login', () => {
    it('deve autenticar com sucesso', () => {
        const login = 'login_' + Date.now();
        const password = 'senha123';

        cy.visit('/cadastro');

        cy.contains('Cadastro').should('exist');
        cy.get('#nome').type('João');
        cy.get('#login').type(login);
        cy.get('#senha').type(password);
        cy.get('button[type="submit"]').click();

        cy.url({ timeout: 30000 }).should('match', /receitas\/dashboard$/);
        cy.contains('Minhas Receitas', { timeout: 15000 }).should('exist')
        cy.get('#logout').should('exist').click();

        cy.contains('Login', { timeout: 15000 }).should('exist');
        cy.get('#botao-login').click();
        cy.url().should('include', '/login');

        cy.get('#login').type(login);
        cy.get('#senha').type(password);
        cy.get('button[type="submit"]').click();

        cy.visit('/receitas/dashboard');
        // cy.url({ timeout: 30000 }).should('match', /receitas\/dashboard$/);
        cy.contains('Minhas Receitas', { timeout: 15000 }).should('exist');
        cy.get('#logout').should('exist').click();
    });

    it('deve mostrar erro com credenciais inválidas', () => {
        const login = 'login_' + Date.now();
        const password = 'senha123';

        cy.visit('/cadastro');
        cy.contains('Cadastro').should('exist');
        cy.get('#nome').type('João');
        cy.get('#login').type(login);
        cy.get('#senha').type(password);
        cy.get('button[type="submit"]').click();

        cy.url({ timeout: 30000 }).should('match', /receitas\/dashboard$/);
        cy.contains('Minhas Receitas', { timeout: 15000 }).should('exist');
        cy.get('#logout').should('exist').click();

        cy.contains('Login').should('exist');
        cy.get('#botao-login').click();
        cy.url().should('include', '/login');

        cy.get('#login').type(login);
        cy.get('#senha').type('errado');
        cy.get('button[type="submit"]').click();

        cy.contains(/credenciais.*inválidas/i, { timeout: 15000 }).should('exist');
    });
});
