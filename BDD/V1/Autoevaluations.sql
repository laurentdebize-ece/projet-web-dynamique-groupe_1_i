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