-- Table: competences
CREATE TABLE Competences (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  description TEXT,
  type ENUM('specifique', 'transverse') NOT NULL
);