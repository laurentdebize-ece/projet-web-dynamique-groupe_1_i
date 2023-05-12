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