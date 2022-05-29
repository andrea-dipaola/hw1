function controllo(event){
    if(form.username.value == 0 || form.password.value == 0){
        alert("Compilare tutti i campi.");
        event.preventDefault();
    }
}

const form = document.forms['login_form'];
form.addEventListener('submit', controllo);