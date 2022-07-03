var btn1 = document.querySelector(".btn1"),
    overlay = document.getElementById("overlay"),
    popup = document.getElementById("popup"),
    btnCerrar = document.getElementById("btnCerrar"),
    /**/
    btn2 = document.querySelector(".btn2"),
    overlay2 = document.getElementById("overlay2"),
    popup2 = document.getElementById("popup2"),
    btnCerrar2 = document.getElementById("btnCerrar2"),
    /**/
    btn3 = document.querySelector(".btn3"),
    overlay3 = document.getElementById("overlay3"),
    popup3 = document.getElementById("popup3"),
    btnCerrar3 = document.getElementById("btnCerrar3"),
    /**/
    btn4 = document.querySelector(".btn4"),
    overlay4 = document.getElementById("overlay4"),
    popup4 = document.getElementById("popup4"),
    btnCerrar4 = document.getElementById("btnCerrar4");

    contador = document.getElementById("contador")



btn1.addEventListener('click', function(){
    overlay.classList.add('active');
    popup.classList.add('active');
})

btn2.addEventListener('click', function(){
    overlay2.classList.add('active');
    popup2.classList.add('active');
})

btn3.addEventListener('click', function(){
    overlay3.classList.add('active');
    popup3.classList.add('active');
})

btn4.addEventListener('click', function(){
    overlay4.classList.add('active');
    popup4.classList.add('active');
})



btnCerrar.addEventListener('click', function(){
    overlay.classList.remove('active');
    popup.classList.remove('active');
})

btnCerrar2.addEventListener('click', function(){
    overlay2.classList.remove('active');
    popup2.classList.remove('active');
})

btnCerrar3.addEventListener('click', function(){
    overlay3.classList.remove('active');
    popup3.classList.remove('active');
})

btnCerrar4.addEventListener('click', function(){
    overlay4.classList.remove('active');
    popup4.classList.remove('active');
})













