var     btn2 = document.querySelector(".btn2"),
        overlay2 = document.getElementById("overlay2"),
        popup2 = document.getElementById("popup2"),
        btnCerrar2 = document.getElementById("btnCerrar2")



btn2.addEventListener('click', function(){
    overlay2.classList.add('active');
    popup2.classList.add('active');
})

btnCerrar2.addEventListener('click', function(){
    overlay2.classList.remove('active');
    popup2.classList.remove('active');
})













