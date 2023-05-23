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

CREATE TABLE Utilisateurs
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    nom          VARCHAR(255)        NOT NULL,
    prenom       VARCHAR(255)        NOT NULL,
    email        VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255)        NOT NULL,
    ecole        VARCHAR(255)        NOT NULL,
    statut_id    INT                 NOT NULL,
    first_login  BOOLEAN DEFAULT 1,
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


INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, ecole, statut_id, first_login)
VALUES ('Admin', 'Laurent', 'admin@ece.fr', '$2y$10$55.Ebfl/vSXK2IVwPl7kw.djRxFSno5A9wm9D4RqklnIxoPLjNJ8K', 'ECE', '3', '0');


-- Pour les tests :
INSERT INTO Utilisateurs (nom, prenom, email, mot_de_passe, ecole, statut_id, first_login)
VALUES ('Etu', 'Laurent', 'etu@ece.fr', '$2y$10$FL5zoBNMgE0M6J1t1E7bHujsQGnyP.h5nxVTQhoxziezL4WUmVFJO', 'ECE', '1', '1'),
       ('Prof', 'Laurent', 'prof@ece.fr', '$2y$10$QjqyQmpPgHbnEVAZrSjcGuv7./e/hQtlFxlQtWVWoNByQ.nTQG3TC', 'ECE', '2', '1'),
       ('crash', 'test', 'crash@ece.fr', '12', 'SuP', '1', '0');



INSERT INTO Competences (nom, description, type)
VALUES ('Competence1', 'Algèbre linéaire : Maîtriser les opérations sur les vecteurs.', 'specifique'),
       ('Competence2', 'Connaissance des méthodes de calcul des intégrales généralisées.', 'specifique'),
       ('Competence3', 'Connaissance des séries de Fourier.', 'specifique'),
       ('Competence4', 'Compréhension des critères de convergence des séries numériques.', 'specifique'),
       ('Competence5', 'Maîtrise des lois de Gauss et d Ampère', 'specifique'),
       ('Competence6', 'Capacité à utiliser les équations de Maxwell.', 'specifique'),
       ('Competence7', 'Capacité à calculer le flux électrique.', 'specifique'),
       ('Competence8', 'Capacité à appliquer la loi de Faraday et la loi de Lenz.', 'specifique'),
       ('Competence9', 'Capacité à utiliser des algorithmes de parcours de graphes.', 'specifique'),
       ('Competence10', 'Compétence dans l écriture et l exécution de requêtes SQL.', 'specifique'),
       ('Competence11', 'Maîtrise des langages de développement web.', 'specifique'),
       ('Competence12', 'Compétence dans l écriture et l exécution de requêtes SQL.', 'specifique'),
       ('Competence13', 'Transformées de Fourier : Comprendre les concepts de base.', 'specifique'),
       ('Competence14', 'Savoir calculé dans le domaine de Laplace ', 'specifique'),
       ('Competence15', 'Conception de circuits imprimés : Avoir une compréhension des techniques de conception de circuits imprimés.', 'specifique'),
       ('Competence16', 'Comprendre les principes de base des circuits logiques.', 'specifique');
       ('Competence17', 'Capacité à travailler efficacement en équipe, à partager les responsabilités, à gérer les dynamiques de groupe et à contribuer à la réalisation des objectifs communs.', 'transverse'),
       ('Competence18', 'Capacité à s exprimer clairement et efficacement en public, à transmettre des idées de manière convaincante et à gérer le trac et les réactions de l auditoire.', 'transverse');


INSERT INTO matieres (nom_matiere, volume_horaire)
VALUES
    ('maths', 30),
    ('electronique', 40),
    ('physique', 30),
    ('ang', 10),
    ('informatique', 30);

INSERT INTO matieres_competences (id_competence, id_matiere)
VALUES
    (1, 1),
    (2, 1),
    (3, 1),
    (4, 1),
    (5, 3),
    (6, 3),
    (7, 3),
    (8, 3),
    (9, 5),
    (10, 5),
    (11, 5),
    (12, 5),
    (13, 2),
    (14, 2),
    (15, 2);

INSERT INTO Autoevaluations (id_etudiant, id_competence, statut, date)
VALUES
    (4, 1, 'non_acquis', '2000-12-12');


SELECT id FROM Utilisateurs WHERE statut_id = 1;
-- Récupérer tous les identifiants de compétences
SELECT id FROM Competences;
-- Insérer toutes les compétences avec le statut "non acquis" pour chaque étudiant
INSERT INTO Autoevaluations (id_etudiant, id_competence, statut, date)
SELECT Utilisateurs.id, Competences.id, 'non_acquis', CURDATE()
FROM Utilisateurs, Competences
WHERE Utilisateurs.statut_id = 1;
