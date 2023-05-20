<!DOCTYPE html>
<html>

<head>
    <title>Update compétences</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.competence-status').click(function() {
                var competenceId = $(this).data('competenceid');
                var currentStatus = $(this).data('status');

                // Mettre à jour l'état de la compétence lorsqu'il y a un clic
                if (currentStatus === 'non_acquis') {
                    updateCompetenceStatus(competenceId, 'en_cours');
                } else if (currentStatus === 'en_cours') {
                    updateCompetenceStatus(competenceId, 'acquis');
                } else if (currentStatus === 'acquis') {
                    updateCompetenceStatus(competenceId, 'non_acquis');
                }
            });

            function updateCompetenceStatus(competenceId, status) {
                $.ajax({
                    url: 'competences.php', // Remplacez par le chemin du fichier PHP de mise à jour des compétences
                    method: 'POST',
                    data: {
                        competenceId: competenceId,
                        status: status
                    },
                    success: function(response) {
                        // Mettre à jour l'affichage de l'état de la compétence
                        $('.competence-status[data-competenceid="' + competenceId + '"]').data('status', status).text(status);

                        // Réinitialiser les classes CSS
                        $('.competence-status[data-competenceid="' + competenceId + '"]').removeClass('non-acquis en-cours acquis');

                        // Appliquer les classes CSS appropriées en fonction de l'état
                        if (status === 'non_acquis') {
                            $('.competence-status[data-competenceid="' + competenceId + '"]').addClass('non-acquis');
                        } else if (status === 'en_cours') {
                            $('.competence-status[data-competenceid="' + competenceId + '"]').addClass('en-cours');
                        } else if (status === 'acquis') {
                            $('.competence-status[data-competenceid="' + competenceId + '"]').addClass('acquis');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Afficher l'erreur dans la console en cas d'échec de la requête
                    }
                });
            }
        });
    </script>


</head>

<body>
    <table>
        <tr>
            <th>Compétence</th>
            <th>Statut</th>
        </tr>
        <?php
        // Vos compétences
        $competences = ['Compétence 1', 'Compétence 2', 'Compétence 3', 'Compétence 4'];

        // Parcourir les compétences et générer le tableau
        foreach ($competences as $competence) {
            echo '<tr>';
            echo '<td>' . $competence . '</td>';
            echo '<td class="status" data-status="non-acquis">Non acquis</td>';
            echo '</tr>';
        }
        ?>
    </table>
</body>

</html>