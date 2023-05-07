-- Table: professeurs_classes
CREATE TABLE Professeurs_classes (
  id_professeur INT,
  id_classe INT,
  PRIMARY KEY (id_professeur, id_classe),
  FOREIGN KEY (id_professeur) REFERENCES utilisateurs(id),
  FOREIGN KEY (id_classe) REFERENCES classes(id)
);