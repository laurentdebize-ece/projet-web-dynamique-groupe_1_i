-- Table: matieres
CREATE TABLE Matieres
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    nom_matiere    VARCHAR(255) NOT NULL,
    volume_horaire INT          NOT NULL
);

-- Table: classes
CREATE TABLE Classes
(
    id        INT AUTO_INCREMENT PRIMARY KEY,
    groupe    INT          NOT NULL,
    promotion VARCHAR(255) NOT NULL,
    ecole        VARCHAR(255)        NOT NULL
);

-- Table: competences
CREATE TABLE Competences
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nom         VARCHAR(255) NOT NULL,
    description TEXT,
    type        ENUM('specifique', 'transverse') NOT NULL
);

-- Table: status
CREATE TABLE Statut
(
    id     INT AUTO_INCREMENT PRIMARY KEY,
    statut VARCHAR(255) NOT NULL UNIQUE
);

-- Table: utilisateurs
CREATE TABLE Utilisateurs
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    nom          VARCHAR(255)        NOT NULL,
    prenom       VARCHAR(255)        NOT NULL,
    email        VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255)        NOT NULL,
    ecole        VARCHAR(255)        NOT NULL,
    statut_id    INT                 NOT NULL,
    FOREIGN KEY (statut_id) REFERENCES Statut (id)
);

-- Table: autoevaluations
CREATE TABLE Autoevaluations
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    id_etudiant   INT,
    id_competence INT,
    statut        ENUM('non_acquis', 'en_cours', 'acquis') NOT NULL,
    date          DATE NOT NULL,
    FOREIGN KEY (id_etudiant) REFERENCES utilisateurs (id),
    FOREIGN KEY (id_competence) REFERENCES competences (id)
);

-- Table: evaluations_professeurs
CREATE TABLE Evaluations_professeurs
(
    id                INT AUTO_INCREMENT PRIMARY KEY,
    id_professeur     INT,
    id_autoevaluation INT,
    statut            ENUM('non_acquis', 'en_cours', 'acquis') NOT NULL,
    commentaire       TEXT,
    date              DATE NOT NULL,
    FOREIGN KEY (id_professeur) REFERENCES utilisateurs (id),
    FOREIGN KEY (id_autoevaluation) REFERENCES autoevaluations (id)
);

-- Table: etudiants_classes
CREATE TABLE Etudiants_classes
(
    id_etudiant INT,
    id_classe   INT,
    PRIMARY KEY (id_etudiant, id_classe),
    FOREIGN KEY (id_etudiant) REFERENCES utilisateurs (id),
    FOREIGN KEY (id_classe) REFERENCES classes (id)
);

-- Table: professeurs_classes
CREATE TABLE Professeurs_classes
(
    id_professeur INT,
    id_classe     INT,
    PRIMARY KEY (id_professeur, id_classe),
    FOREIGN KEY (id_professeur) REFERENCES utilisateurs (id),
    FOREIGN KEY (id_classe) REFERENCES classes (id)
);

-- Table: professeurs_matieres
CREATE TABLE Professeurs_Matieres
(
    id_professeur INT,
    id_matiere    INT,
    PRIMARY KEY (id_professeur, id_matiere),
    FOREIGN KEY (id_professeur) REFERENCES Utilisateurs (id),
    FOREIGN KEY (id_matiere) REFERENCES Matieres (id)
);

-- Table: matieres_competences
CREATE TABLE Matieres_competences
(
    id_competence INT,
    id_matiere    INT,
    PRIMARY KEY (id_competence, id_matiere),
    FOREIGN KEY (id_competence) REFERENCES competences (id),
    FOREIGN KEY (id_matiere) REFERENCES matieres (id)
);

INSERT INTO Statut (statut)
VALUES ('etudiant'),
       ('professeur'),
       ('administrateur');


INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, ecole, statut_id)
VALUES ('Admin', 'Laurent', 'admin@ece.fr', '$2y$10$55.Ebfl/vSXK2IVwPl7kw.djRxFSno5A9wm9D4RqklnIxoPLjNJ8K', 'ECE', '3');


-- Pour les tests :
INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, ecole, statut_id)
VALUES ('Etu', 'Laurent', 'etu@ece.fr', '$2y$10$FL5zoBNMgE0M6J1t1E7bHujsQGnyP.h5nxVTQhoxziezL4WUmVFJO', 'ECE', '1'),
       ('Prof', 'Laurent', 'prof@ece.fr', '$2y$10$QjqyQmpPgHbnEVAZrSjcGuv7./e/hQtlFxlQtWVWoNByQ.nTQG3TC', 'ECE', '2');









