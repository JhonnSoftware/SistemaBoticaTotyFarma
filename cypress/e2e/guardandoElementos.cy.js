describe('Formulario de Registrar Proveedor', () => {
    beforeEach(() => {
        cy.visit('http://localhost/proyectoSistemaBotica02/public/proveedores/registrarProveedores');
    });

    it('Verificar elementos del formulario', () => {
        cy.contains('h1', 'CRUD de Proveedores').should('be.visible');
        cy.get('input[name="ruc"]').should('be.visible');
        cy.get('input[name="nombre"]').should('be.visible');
        cy.get('input[name="telefono"]').should('be.visible');
        cy.get('input[name="correo"]').should('be.visible');
        cy.get('input[name="direccion"]').should('be.visible');
        cy.get('select[name="estado"]').should('be.visible');
        cy.get('button[type="submit"]').contains('Guardar Proveedor').should('be.visible');
    });
});
