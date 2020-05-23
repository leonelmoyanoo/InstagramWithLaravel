CREATE DATABASE IF NOT EXISTS instagram_laravel;

USE instagram_laravel;

/*Tabla de usuarios*/
CREATE TABLE IF NOT EXISTS users(
    id              int(255) auto_increment not null,
    role            varchar(20),
    name            varchar(100),
    surname         varchar(200),
    nickname        varchar(100),
    email           varchar(255),
    password        varchar(255),
    image           varchar(255),
    created_at      datetime,
    updated_at      datetime,
    remember_token  varchar(255),

    CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;
/*INSERTAR DATOS*/
INSERT INTO users VALUES(
    NULL,
    'user',
    'Franco',
    'Fonseca',
    'franFon',
    'frankito@gmail.com',
    'frankito',
    NULL,
    CURTIME(),
    CURTIME(),
    NULL
);
INSERT INTO users VALUES(
    NULL,
    'user',
    'Julian',
    'Ponce',
    'juliPonce',
    'juliPonce@gmail.com',
    'julito',
    NULL,
    CURTIME(),
    CURTIME(),
    NULL
);
INSERT INTO users VALUES(
    NULL,
    'user',
    'Leonel',
    'Moyano',
    'moyano.leonel',
    'leonelmoyano1809@gmail.com',
    'pass1234',
    NULL,
    CURTIME(),
    CURTIME(),
    NULL
);




/*Tabla de imágenes*/
CREATE TABLE IF NOT EXISTS images(
    id              int(255) auto_increment not null,
    user_id         int(255),
    image_path      varchar(255),
    description     text,
    created_at      datetime,
    updated_at      datetime,

    CONSTRAINT pk_images PRIMARY KEY(id),
    CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;
/*INSERTAR DATOS*/
INSERT INTO images VALUES(
    NULL,
    1,
    'test.jpg',
    'Pueba de imagen 1-1',
    CURTIME(),
    CURTIME()
);
INSERT INTO images VALUES(
    NULL,
    1,
    'playa.jpg',
    'Pueba de imagen 1-2',
    CURTIME(),
    CURTIME()
);
INSERT INTO images VALUES(
    NULL,
    1,
    'arena.jpg',
    'Pueba de imagen 1-3',
    CURTIME(),
    CURTIME()
);

INSERT INTO images VALUES(
    NULL,
    2,
    'test.jpg',
    'Pueba de imagen 2-1',
    CURTIME(),
    CURTIME()
);
INSERT INTO images VALUES(
    NULL,
    2,
    'playa.jpg',
    'Pueba de imagen 2-1',
    CURTIME(),
    CURTIME()
);
INSERT INTO images VALUES(
    NULL,
    3,
    'test.jpg',
    'Pueba de imagen 3-1',
    CURTIME(),
    CURTIME()
);


/*Tabla de comentarios*/
CREATE TABLE IF NOT EXISTS comments(
    id              int(255) auto_increment not null,
    user_id         int(255),
    image_id        int(255),
    content         text,
    created_at      datetime,
    updated_at      datetime,

    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;
/*INSERTAR DATOS*/
INSERT INTO comments VALUES(
    NULL,
    1,
    4,
    'Buena foto maquina',
    CURTIME(),
    CURTIME()
);
INSERT INTO comments VALUES(
    NULL,
    2,
    2,
    'Alta playa pibe',
    CURTIME(),
    CURTIME()
);
INSERT INTO comments VALUES(
    NULL,
    3,
    4,
    'Fachero mal',
    CURTIME(),
    CURTIME()
);
INSERT INTO comments VALUES(
    NULL,
    3,
    2,
    'Miami un poroto',
    CURTIME(),
    CURTIME()
);

/*Tabla de likes*/
CREATE TABLE IF NOT EXISTS likes(
    id              int(255) auto_increment not null,
    user_id         int(255),
    image_id        int(255),
    created_at      datetime,
    updated_at      datetime,

    CONSTRAINT pk_likes PRIMARY KEY(id),
    CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;
/*INSERTAR DATOS*/
INSERT INTO likes VALUES(
    NULL,
    1,
    4,
    CURTIME(),
    CURTIME()
);
INSERT INTO likes VALUES(
    NULL,
    3,
    4,
    CURTIME(),
    CURTIME()
);
INSERT INTO likes VALUES(
    NULL,
    2,
    1,
    CURTIME(),
    CURTIME()
);

