<!-- tableau de recherche -->
<div class="text-right">
    <form action="/agence" method="POST">
        <input type="number"  name="id_agence" placeholder="Id de l'agence" required>
        <button type="submit" class="btn btn-info">Rechercher</button>
    </form>
</div>
<?php if (!empty($agencesId)): ?>
    <h1>Resultat recherche</h1>
        <table class="table table-stripped table-hover">
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($agencesId->getIdAgence()); ?></td>
                <td><?php echo htmlspecialchars($agencesId->getNom()); ?></td>
                <td><?php echo htmlspecialchars($agencesId->getEmail()); ?></td>
                <td><?php echo htmlspecialchars($agencesId->getStatus()); ?></td>
                <td>
                    <button class="btn btn-warning" 
                                data-toggle="modal" 
                                data-target="#editAgenceModal" 
                                data-id="<?php echo $agencesId->getIdAgence(); ?>" 
                                data-nom="<?php echo htmlspecialchars($agencesId->getNom()); ?>" 
                                data-email="<?php echo htmlspecialchars($agencesId->getEmail()); ?>" 
                                data-status="<?php echo htmlspecialchars($agencesId->getStatus()); ?>">
                            Modifier
                    </button>
                    <form action="/delete.agence" method="POST" style="display:inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?');">
                        <input type="hidden" name="id_agence" value="<?php echo $agencesId->getIdAgence(); ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        </tbody>
        </table>
<?php endif;  ?>
        
<h1>Liste des Agences</h1>
<table class="table table-stripped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($agences)): ?>
            <?php foreach ($agences as $agence): ?>
                <tr>
                    <td><?php echo htmlspecialchars($agence->getIdAgence()); ?></td>
                    <td><?php echo htmlspecialchars($agence->getNom()); ?></td>
                    <td><?php echo htmlspecialchars($agence->getEmail()); ?></td>
                    <td><?php echo htmlspecialchars($agence->getStatus()); ?></td>
                    <td>
                    <button class="btn btn-warning" 
                                data-toggle="modal" 
                                data-target="#editAgenceModal" 
                                data-id="<?php echo $agence->getIdAgence(); ?>" 
                                data-nom="<?php echo htmlspecialchars($agence->getNom()); ?>" 
                                data-email="<?php echo htmlspecialchars($agence->getEmail()); ?>" 
                                data-status="<?php echo htmlspecialchars($agence->getStatus()); ?>">
                            Modifier
                        </button>
                        <form action="/delete.agence" method="POST" style="display:inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?');">
                            <input type="hidden" name="id_agence" value="<?php echo $agence->getIdAgence(); ?>">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Aucune agence trouvée.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Bouton pour ouvrir la modale -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAgenceModal">
    Ajouter une Agence
</button>

<!-- Modale pour ajouter une nouvelle agence -->
<div id="addAgenceModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Entête de la modale -->
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une nouvelle agence</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Corps de la modale -->
            <form action="/create.agence" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom de l'agence" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email de l'agence" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="" disabled selected>Choisir un statut</option>
                            <option value="Otiv base">Otiv base</option>
                            <option value="Fournisseur">Fournisseur</option>
                        </select>
                    </div>
                </div>

                <!-- Pied de la modale -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" name="AjoutAgence">Ajouter Agence</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modale pour modifier une agence -->
<div id="editAgenceModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Entête de la modale -->
            <div class="modal-header">
                <h4 class="modal-title">Modifier l'agence</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Corps de la modale -->
            <form action="/update.agence" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir modifier cette agence ?');">
                <div class="modal-body">
                    <input type="hidden" name="id_agence" id="editIdAgence">
                    <div class="form-group">
                        <label for="editNom">Nom</label>
                        <input type="text" class="form-control" id="editNom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <select class="form-control" id="editStatus" name="status" required>
                            <option value="" disabled selected>Choisir un statut</option>
                            <option value="Otiv base">Otiv base</option>
                            <option value="Fournisseur">Fournisseur</option>
                        </select>
                    </div>
                </div>

                <!-- Pied de la modale -->
                <div class="modal-footer">
                    <button type="button" class ="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" name="ModifierAgence" >Modifier Agence</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript pour remplir les champs de la modale -->
<script>
    $(document).ready(function() {
        $('#editAgenceModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var idAgence = button.data('id');
            var nom = button.data('nom');
            var email = button.data('email');
            var status = button.data('status');

            $('#editIdAgence').val(idAgence);
            $('#editNom').val(nom);
            $('#editEmail').val(email);
            $('#editStatus').val(status);
        });
    });
</script>