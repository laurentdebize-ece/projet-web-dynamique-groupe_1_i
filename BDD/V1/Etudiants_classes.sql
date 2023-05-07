-- Table: etudiants_classes
CREATE TABLE Etudiants_classes (
  id_etudiant INT,
  id_classe INT,
  PRIMARY KEY (id_etudiant, id_classe),
  FOREIGN KEY (id_etudiant) REFERENCES utilisateurs(id),
  FOREIGN KEY (id_classe) REFERENCES classes(id)
);