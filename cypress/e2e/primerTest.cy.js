//DESCRIBE es el nombre de la funcion que contendrá nuestra prueba
describe('Primer Prueba', ()=> {
    //IT es la descripción de la acción que realizará la prueba
    it('Navegar a nuestra primer página', ()=>{
        //Como en nuestra prueba queremos visitar una página, entonces coloque la URL
        cy.visit('https://jacob-mitsubishi-network-dependence.trycloudflare.com')
    })
})