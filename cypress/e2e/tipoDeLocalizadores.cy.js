describe('Tipos de localizadores', ()=> {
    //IT es la descripción de la acción que realizará la prueba
    it('Obtenerlo por medio de un tag', ()=>{
        //Como en nuestra prueba queremos visitar una página, entonces coloque la URL
        cy.visit('http://localhost/proyectoSistemaBotica02/public/clientes/registrarClientes')
        cy.get('input')
    })

    it('Obtenerlo por medio de un atributo', ()=>{
        cy.get('[placeholder="Maximo 8 numeros"]')
    })

    it('Obtenerlo por medio de su ID', ()=>{
        cy.get('#dni')
    })

    it('Obtenerlo por medio de una clase', ()=>{
        cy.get('.mb-3')
    })

})