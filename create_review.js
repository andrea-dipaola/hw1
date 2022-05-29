
function checkVoto(){
    const voto = document.querySelector('#votazione');
    if(isNaN(voto.value)){ 
        container = document.querySelector('#voto_span');
        document.querySelector('#votazione').classList.add('error');
        container.textContent = "Inserisci un numero";
    }else{
        document.querySelector('#votazione').classList.remove('error');
        container = document.querySelector('#voto_span');
        container.textContent = "";
    }   
}

document.querySelector('#votazione').addEventListener('blur', checkVoto);


