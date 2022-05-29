function onJsonUsername(json){
    if(json.exists){
        container = document.querySelector('#user_span');
        container.textContent = "Username già esistente";
        document.querySelector('.username_input').classList.add('error');
        
    }else{
        document.querySelector('.username_input').classList.remove('error');
        container = document.querySelector('#user_span');
        container.textContent = ""; 
        //container.textContent = "Username corretto";    
    }
}

function onJsonEmail(json){
    if(json.exists){
        container = document.querySelector('#email_span');
        container.textContent = "Email già usata"; 
        document.querySelector('.email_input').classList.add('error');
    }else{
        document.querySelector('.email_input').classList.remove('error');
        container = document.querySelector('#email_span');
        container.textContent = ""; 
        //container.textContent = "Email corretta"; 
    }
}

function onResponse(response){
    if(!response.ok){
        return null;
    }
    return response.json();
}

function checkNome(){
    const nomeInput = document.querySelector(".nome_input");
    if(nomeInput.value.length > 0){
        container = document.querySelector('#nome_span');
        document.querySelector('.nome_input').classList.remove('error');
        container.textContent = ""; 
        //container.textContent = "Nome corretto";
    }else{
        container = document.querySelector('#nome_span');
        document.querySelector('.nome_input').classList.add('error');
        container.textContent = "Nome non valido";
    }
}

function checkCognome(){
    const nomeInput = document.querySelector(".cognome_input");
    if(nomeInput.value.length > 0){
        container = document.querySelector('#cognome_span');
        document.querySelector('.cognome_input').classList.remove('error');
        container.textContent = ""; 
        //container.textContent = "Cognome corretto";
    }else{
        container = document.querySelector('#cognome_span');
        document.querySelector('.cognome_input').classList.add('error');
        container.textContent = "Cognome non valido";
    }
}

function checkEmail(){
    const emailInput = document.querySelector('.email_input');
    if(!/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(emailInput.value)){
        container = document.querySelector('#email_span');
        document.querySelector('.email_input').classList.add('error');
        container.textContent = "Email non corretta";  
    }else{
        fetch("check_email.php?q=" + encodeURIComponent(emailInput.value)).then(onResponse).then(onJsonEmail);
    }
}

function checkUsername(){
    const usernameInput = document.querySelector('.username_input');
    if(!/^[a-zA-Z0-9_-]{3,15}$/.test(usernameInput.value)){
        container = document.querySelector('#user_span');
        document.querySelector('.username_input').classList.add('error');
        container.textContent = "Pattern username non rispettato";
        
    }else{
        fetch("check_username.php?q=" + encodeURIComponent(usernameInput.value)).then(onResponse).then(onJsonUsername);
    }
}

function checkPassword(){
    const passwordInput = document.querySelector('.password_input');
    if(!/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(passwordInput.value)){
        container = document.querySelector('#password_span');
        document.querySelector('.password_input').classList.add('error');
        container.textContent = "Password non corretta";   
    }else{
        container = document.querySelector('#password_span');
        document.querySelector('.password_input').classList.remove('error');
        container.textContent = ""; 
        //container.textContent = "Password corretta"; 
    }
}

document.querySelector('.nome_input').addEventListener('blur', checkNome);
document.querySelector('.cognome_input').addEventListener('blur', checkCognome);
document.querySelector('.email_input').addEventListener('blur', checkEmail);
document.querySelector('.username_input').addEventListener('blur', checkUsername);
document.querySelector('.password_input').addEventListener('blur', checkPassword);