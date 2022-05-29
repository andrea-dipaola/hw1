function fetchReviewJson(json){
    console.log(json);
    const container = document.querySelector('#reviews');
    
    for(let i in json){
        const h1 = document.createElement('h1');
        const span_nome = document.createElement('span');
        span_nome.textContent = json[i].nome + " " + json[i].cognome;
        const h2 = document.createElement('h2');
        h2.textContent = json[i].locale;
        const p = document.createElement('p');
        p.textContent = "Voto: " + json[i].valutazione;
        const div = document.createElement('div');
        div.textContent = json[i].descrizione;
        const button = document.createElement('button');
        button.textContent = "Aggiungi ai preferiti";

        const testo = document.createElement('h3');
        testo.textContent = "Aggiunto ai preferiti";
        testo.classList.add('hidden_text');

        const id_review = json[i].id_rec;
        
        h1.appendChild(span_nome);
        h1.appendChild(h2);
        h1.appendChild(p);
        h1.appendChild(div);
        h1.appendChild(button);
        container.appendChild(h1);
        h1.appendChild(testo);
        
        button.addEventListener('click', () => {
            onPrefButton(id_review, testo);
        });

    }
}

function podcastJson(json){
    console.log("Podcast json");
    console.log(json);

    const ricetta = document.querySelector('#ricetta_value');
    ricetta.innerHTML = '';

    const library = document.querySelector('#podcast_value');
    library.innerHTML = '';
    const results = json.episodes.items;
    const num_results = results.length;
    for(let i=0; i<num_results; i++){
        const library_data = results[i];
        const title = library_data.description;
        const url = library_data.external_urls.spotify;
        const container = document.createElement('div');
        container.classList.add('pod');
        const titolo = document.createElement('span');
        titolo.textContent = title;
        const url_descr = document.createElement('a');
        url_descr.href = url;
        const image = document.createElement('img');
        image.src = library_data.images[1].url;
        container.appendChild(titolo);
        url_descr.appendChild(image);
        container.appendChild(url_descr);
        library.appendChild(container);
    }
}

function ricettaJson(json){
    console.log("Ricetta json");
    console.log(json);

    const library = document.querySelector('#podcast_value');
    library.innerHTML = '';

    const ricetta = document.querySelector('#ricetta_value');
    ricetta.innerHTML = '';
    const results = json.hits;
    const num_results = results.length;
    for(let i=0; i<num_results; i++){
        const recipe_data = results[i];
        const titolo = recipe_data.recipe.label;
        const immagine = recipe_data.recipe.image;
        const recipe = document.createElement('div');
        recipe.classList.add('ric');
        const img = document.createElement('img');
        img.src = immagine;
        const caption = document.createElement('span');
        caption.textContent = titolo;
        recipe.appendChild(caption);
        recipe.appendChild(img);
        const ingredienti = recipe_data.recipe.ingredientLines;
        const num_ingredienti = ingredienti.length;
        for(let j=0; j<num_ingredienti; j++){
            const ingr = ingredienti[j];
            const caption_ingr = document.createElement('p');
            caption_ingr.textContent = ingr;
            recipe.appendChild(caption_ingr);
        }
        ricetta.appendChild(recipe);
    }
}

function onResponse(response){
    if(!response.ok){
        return null;
    }
    return response.json();
}


function searchPodcast(){
    console.log("Podcast");
    const podcastValue = 'GialloZafferano: le Ricette';
    fetch("search_content_podcast.php?q=" + podcastValue).then(onResponse).then(podcastJson);
}

function cercaRicetta(event){
    event.preventDefault();
    console.log("Ricetta");
    const ricetta_input = document.querySelector('#ricetta_text');
    const ricetta_value = encodeURIComponent(ricetta_input.value);
    fetch("search_content_ricetta.php?q=" + ricetta_value).then(onResponse).then(ricettaJson);

}

function onPrefJson(json){
    console.log(json);
    if(json){
        console.log("Preferito aggiunto");
    }else{
        console.log("Errore aggiunta preferito");
    }
}

function onPrefButton(id_recensione, h3){
    h3.classList.remove('hidden_text');
    fetch("preferiti_review.php?q=" + id_recensione).then(onResponse).then(onPrefJson);
}

function fetchReview(){
    fetch("fetch_review.php").then(onResponse).then(fetchReviewJson);
}

function modalView(){
    const form_ricetta = document.querySelector('#form_ricetta');
    form_ricetta.classList.remove('hidden');
}

fetchReview();
const podcast = document.querySelector('#podcast');
podcast.addEventListener('click', searchPodcast);
const ricetta = document.querySelector('#ricetta');
ricetta.addEventListener('click', modalView);

const form = document.querySelector('#form_ricetta');
form.addEventListener('submit', cercaRicetta);


