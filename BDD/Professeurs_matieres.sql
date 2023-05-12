-- Table: professeurs_matieres
CREATE TABLE Professeurs_matieres (
  id_professeur INT,
  id_matiere INT,
  PRIMARY KEY (id_professeur, id_matiere),
  FOREIGN KEY (id_professeur) REFERENCES utilisateurs(id),
  FOREIGN KEY (id_matiere) REFERENCES matieres(id)
);