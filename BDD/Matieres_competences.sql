-- Table: matieres_competences
CREATE TABLE Matieres_competences (
  id_competence INT,
  id_matiere INT,
  PRIMARY KEY (id_competence, id_matiere),
  FOREIGN KEY (id_competence) REFERENCES competences(id),
  FOREIGN KEY (id_matiere) REFERENCES matieres(id)
);