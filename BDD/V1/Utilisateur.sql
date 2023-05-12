-- Table: utilisateurs
CREATE TABLE Utilisateurs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  mot_de_passe VARCHAR(255) NOT NULL,
  status_id INT NOT NULL,
  FOREIGN KEY (status_id) REFERENCES Status(id)
);