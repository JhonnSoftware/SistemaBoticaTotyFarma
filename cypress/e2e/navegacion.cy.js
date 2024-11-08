describe('Primer Prueba', ()=> {
    //IT es la descripción de la acción que realizará la prueba
    it('Navegar a nuestra primer página', ()=>{
        //Como en nuestra prueba queremos visitar una página, entonces coloque la URL
        cy.visit('https://estudiantesavp.ucontinental.edu.pe/')
    })

    it('Recargar pagina', ()=>{
        cy.reload()
    })

    it('Navegar hacia atras', ()=>{
        cy.visit("https://www.google.com/")
        cy.visit("https://www.google.com/search?q=youtube&sca_esv=03a1954e09502d7b&sxsrf=ADLYWIKTk5qMfY1MgSIbAmB870kEhbHUuA%3A1729898152962&source=hp&ei=qCYcZ_zVOKXe1sQP_t2a2AE&iflsig=AL9hbdgAAAAAZxw0uF-NJKQJ6dTDCr-FdaKeCJyi4ir0&ved=0ahUKEwj8yZzn1KqJAxUlr5UCHf6uBhsQ4dUDCBY&uact=5&oq=youtube&gs_lp=Egdnd3Mtd2l6Igd5b3V0dWJlMhAQLhiABBjRAxjHARgnGIoFMggQABiABBjLATIIEAAYgAQYywEyCBAAGIAEGMsBMggQABiABBjLATIIEAAYgAQYywEyCBAAGIAEGMsBMggQABiABBjLATIIEAAYgAQYywEyCBAAGIAEGMsBSN8QUABY_QtwAHgAkAEAmAG6B6ABqhmqAQsyLTIuMS4wLjEuMrgBA8gBAPgBAZgCBqAC1xnCAgUQABiABMICCxAuGIAEGNEDGMcBwgIFEC4YgASYAwCSBwsyLTIuMS4wLjEuMqAH-zg&sclient=gws-wiz")
        cy.go("back")
        cy.go("forward")
    })
})