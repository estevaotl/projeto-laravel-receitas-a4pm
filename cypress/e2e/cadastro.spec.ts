describe('Cadastro', () => {
    it('deve cadastrar novo usuário com sucesso', () => {
        const login = 'usuario_' + Date.now();

        cy.visit('/cadastro');
        cy.contains('Cadastro', { timeout: 10000 }).should('exist');

        cy.get('#nome').type('Maria Teste');
        cy.get('#login').type(login);
        cy.get('#senha').type('senha123');
        cy.get('button[type="submit"]').click();

        cy.url({ timeout: 20000 }).should('include', '/receitas/dashboard');
        cy.contains('Minhas Receitas', { timeout: 15000 }).should('exist');
        cy.get('#logout', { timeout: 15000 }).should('exist').click();
    });

    it('deve mostrar erro ao tentar cadastrar com login duplicado', () => {
        const login = 'duplicado_' + Date.now();

        // Primeiro cadastro
        cy.visit('/cadastro');
        cy.contains('Cadastro').should('exist');
        cy.get('#nome').type('João');
        cy.get('#login').type(login);
        cy.get('#senha').type('senha123');
        cy.get('button[type="submit"]').click();

        cy.url().should('include', '/receitas/dashboard');
        cy.contains('Minhas Receitas').should('exist');
        cy.get('#logout').click();

        // Segundo cadastro com mesmo login
        cy.visit('/');
        cy.contains('Cadastro').should('exist');
        cy.get('#botao-cadastro').click();
        cy.get('#nome').type('João');
        cy.get('#login').type(login);
        cy.get('#senha').type('senha123');
        cy.get('button[type="submit"]').click();

        cy.contains(/login.*já.*cadastrado/i, { timeout: 15000 }).should('exist');
    });
});
