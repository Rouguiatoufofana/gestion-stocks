@extends('administration.base')

@section('content')
<div class="page-inner">    
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        
            <h3 class="fw-bold mb-3">Liste des départements</h3>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <div class="ms-md-auto py-2 py-md-0">
            <!-- Bouton pour ouvrir la fenêtre modale -->
            <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#departementModal">
                Ajouter un département
            </button>
        </div>
    </div>
     <!-- Tableau des départements -->
     <table id = "departementTablep" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
     <thead style="background-color: #4CAF50; color: white;">
    <tr>
        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Numéro</th>
        <th style="padding: 12px; text-align: left;">Département</th>
        <th style="padding: 12px; text-align: left;">Action</th> <!-- Nouvelle colonne "Action" -->
    </tr>
</thead>
<tbody>
@foreach ($departements as $departement)
    <tr data-id="{{ $departement->id }}">
        <td style="padding: 8px; border: 1px solid #ddd;">{{ $departement->id }}</td>
        <td style="padding: 12px; border: 1px solid #ddd;">{{ $departement->nom }}</td>
        <td style="padding: 12px; border: 1px solid #ddd;">
            <button class="btn btn-danger btn-sm" onclick="deleteDepartement({{ $departement->id }})">Supprimer</button>
        </td>
    </tr>
@endforeach

</tbody>

</table>
@endsection

<!-- Modal pour ajouter un département -->
<div class="modal fade" id="departementModal" tabindex="-1" aria-labelledby="departementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="departementModalLabel">Ajouter un département</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="departementName">Nom du département :</label>
                    <input type="text" class="form-control" id="departementName">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addDepartementBtn">Valider</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('addDepartementBtn').addEventListener('click', function() {
        // Récupérer le nom du département
        var departementName = document.getElementById('departementName').value;

        // Vérifier si le champ est vide
        if (departementName.trim() === '') {
            alert("Veuillez entrer un nom pour le département.");
        } else {
            // Faire la requête AJAX pour ajouter le département à la base de données
            $.ajax({
                url: '/departements',  // L'URL où vous envoyez la requête POST (vous devez adapter cela à votre route)
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',  // Token CSRF pour la sécurité
                    nom: departementName         // Le nom du département
                },
                success: function(response) {
                    // Si la requête est réussie, ajouter le département au tableau
                    alert('Département ajouté: ' + departementName);
                    
                    // Fermer le modal
                    var modal = new bootstrap.Modal(document.getElementById('departementModal'));
                    modal.hide();

                    // Réinitialiser le champ
                    document.getElementById('departementName').value = '';

                    // Ajouter le département au tableau
                    var table = document.getElementById('departementTablep');
                    var newRow = table.insertRow(-1); // Ajouter une nouvelle ligne à la fin du tableau

                    // Créer une nouvelle cellule pour le numéro (par exemple, l'ID du département)
                    var cell1 = newRow.insertCell(0);
                    cell1.textContent = response.departement.id;  // L'ID du département depuis la réponse du serveur

                    // Créer une nouvelle cellule pour le nom du département
                    var cell2 = newRow.insertCell(1);
                    cell2.textContent = response.departement.nom;
                },
                error: function(xhr, status, error) {
                    // En cas d'erreur, afficher un message
                    alert("Erreur lors de l'ajout du département. Essayez à nouveau.");
                }
            });
        }
    });

  // Fonction pour supprimer un département
function deleteDepartement(departementId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce département ?')) {
        // Requête AJAX pour supprimer le département
        $.ajax({
            url: '/departements/' + departementId,  // L'URL de suppression du département
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}',  // Token CSRF pour la sécurité
            },
            success: function(response) {
                // Si la suppression réussit, supprimer la ligne correspondante du tableau
                alert('Département supprimé avec succès');
                
                // Retirer la ligne du tableau en fonction de l'ID
                var row = document.querySelector('tr[data-id="' + departementId + '"]');
                if (row) {
                    row.remove();
                }
            },
            error: function(xhr, status, error) {
                // En cas d'erreur, afficher un message
                alert("Erreur lors de la suppression du département. Essayez à nouveau.");
            }
        });
    }
}

</script>


@endpush

