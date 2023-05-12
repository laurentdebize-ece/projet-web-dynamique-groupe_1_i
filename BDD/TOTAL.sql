-- Table: matieres
CREATE TABLE Matieres (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  volume_horaire INT NOT NULL
);

-- Table: classes
CREATE TABLE Classes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom_classe VARCHAR(255) NOT NULL,
  promotion VARCHAR(255) NOT NULL
);

-- Table: competences
CREATE TABLE Competences (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  description TEXT,
  type ENUM('specifique', 'transverse') NOT NULL
);

-- Table: status
CREATE TABLE Statut (
  id INT AUTO_INCREMENT PRIMARY KEY,
  statut VARCHAR(255) NOT NULL UNIQUE
);

-- Table: utilisateurs
CREATE TABLE Utilisateurs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  mot_de_passe VARCHAR(255) NOT NULL,
  statut_id INT NOT NULL,
  FOREIGN KEY (statut_id) REFERENCES Statut(id)
);

-- Table: autoevaluations
CREATE TABLE Autoevaluations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_etudiant INT,
  id_competence INT,
  statut ENUM('non_acquis', 'en_cours', 'acquis') NOT NULL,
  date DATE NOT NULL,
  FOREIGN KEY (id_etudiant) REFERENCES utilisateurs(id),
  FOREIGN KEY (id_competence) REFERENCES competences(id)
);

-- Table: evaluations_professeurs
CREATE TABLE Evaluations_professeurs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_professeur INT,
  id_autoevaluation INT,
  statut ENUM('non_acquis', 'en_cours', 'acquis') NOT NULL,
  commentaire TEXT,
  date DATE NOT NULL,
  FOREIGN KEY (id_professeur) REFERENCES utilisateurs(id),
  FOREIGN KEY (id_autoevaluation) REFERENCES autoevaluations(id)
);

-- Table: etudiants_classes
CREATE TABLE Etudiants_classes (
  id_etudiant INT,
  id_classe INT,
  PRIMARY KEY (id_etudiant, id_classe),
  FOREIGN KEY (id_etudiant) REFERENCES utilisateurs(id),
  FOREIGN KEY (id_classe) REFERENCES classes(id)
);

-- Table: professeurs_classes
CREATE TABLE Professeurs_classes (
  id_professeur INT,
  id_classe INT,
  PRIMARY KEY (id_professeur, id_classe),
  FOREIGN KEY (id_professeur) REFERENCES utilisateurs(id),
  FOREIGN KEY (id_classe) REFERENCES classes(id)
);

-- Table: matieres_competences
CREATE TABLE Matieres_competences (
  id_competence INT,
  id_matiere INT,
  PRIMARY KEY (id_competence, id_matiere),
  FOREIGN KEY (id_competence) REFERENCES competences(id),
  FOREIGN KEY (id_matiere) REFERENCES matieres(id)
);

INSERT INTO Statut (statut)
VALUES ('etudiant'), ('professeur'), ('administrateur');



-- Pour les tests :







