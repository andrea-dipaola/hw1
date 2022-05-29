function fetchPreferitiJson(json){
    console.log(json);
    const container = document.querySelector('#recensioni_preferite');
    container.innerHTML = '';
    
    for(let i in json){
        const h1 = document.createElement('h1');
        const h2 = document.createElement('h2');
        h2.textContent = json[i].locale;
        const p = document.createElement('p');
        p.textContent = "Voto: " + json[i].valutazione;
        const div = document.createElement('div');
        div.textContent = json[i].descrizione;
        const button = document.createElement('button');
        button.textContent = "Rimuovi dai preferiti";
        const id_review = json[i].id_rec;
        
        h1.appendChild(h2);
        h1.appendChild(p);
        h1.appendChild(div);
        h1.appendChild(button);
        container.appendChild(h1);
       
        button.addEventListener('click', () => {
            onPrefButton(id_review);
        });

    }
}

function onPrefJson(json){
    console.log(json);
    if(json){
        console.log("Preferito rimosso");
        fetch("fetch_review_preferiti.php").then(onResponse).then(fetchPreferitiJson);

    }else{
        console.log("Errore nella rimozione del preferito");
    }
}

function onPrefButton(id_recensione){
    console.log("onPrefButton");
    //console.log(id_recensione);
    fetch("rimuovi_preferito.php?q=" + id_recensione).then(onResponse).then(onPrefJson);
}

function onResponse(response){
    if(!response.ok){
        return null;
    }
    return response.json();
}

function fetchPreferitiReview(){
    fetch("fetch_review_preferiti.php").then(onResponse).then(fetchPreferitiJson);
}



fetchPreferitiReview();