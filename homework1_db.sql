create table users(
    id integer PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255),
    cognome VARCHAR(255),
    email VARCHAR(255),
    username VARCHAR(255),
    password VARCHAR(255)
);

create table recensioni(
    id_rec INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_user INTEGER,
    nome_locale VARCHAR(255),
    descrizione VARCHAR(255),
    voto INTEGER,
    FOREIGN KEY(id_user) REFERENCES users(id) on delete cascade on update cascade
);

create table preferiti(
    user INTEGER,
    review INTEGER,
    index user_id(user),
    index review_id(review),
    FOREIGN KEY(user) REFERENCES users(id) on delete cascade on update cascade,
    FOREIGN KEY(review) REFERENCES recensioni(id_rec) on delete cascade on update cascade,
    PRIMARY KEY(user, review)
);

