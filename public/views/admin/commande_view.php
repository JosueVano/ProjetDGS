<!-- tableau de recherche -->
<div class="text-right">
    <form action="/commande" method="POST">
        <input type="number"  name="id_commande" placeholder="Id du commande" required>
        <button type="submit" class="btn btn-info">Rechercher</button>
    </form>
</div>
<?php if (!empty($commandesId)): ?>
    <h1>Resultat recherche</h1>
        <table class="table table-stripped table-hover">
        <tbody>
        <tr>
                    <td><?php echo htmlspecialchars($commandesId->getIdCommande()); ?></td>
                    <td><?php echo htmlspecialchars($commandesId->getAgence()); ?></td>
                    <td><?php echo htmlspecialchars($commandesId->getDate()); ?></td>
                    <td><?php echo htmlspecialchars($commandesId->getStatus()); ?></td>
                    <td>
                        <button class="btn btn-warning" 
                                data-toggle="modal" 
                                data-target="#editCommandeModal" 
                                data-id="<?php echo $commandesId->getIdCommande(); ?>" 
                                data-agence="<?php echo htmlspecialchars($commandesId->getAgence()); ?>"
                                data-date="<?php echo htmlspecialchars($commandesId->getDate()); ?>"
                                data-status="<?php echo htmlspecialchars($commandesId->getStatus()); ?>">
                            Modifier
                        </button>
                        <form action="/delete.commande" method="POST" style="display:inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet commande ?');">
                            <input type="hidden" name="id_commande" value="<?php echo $commandesId->getIdCommande(); ?>">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>                    
                    </td>
                </tr>
        </tbody>
        </table>
<?php endif; ?>

<h1>Liste des Commandes</h1>

<table class="table table-stripped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Agence</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($commandes)): ?>
            <?php foreach ($commandes as $commande): ?>
                <tr>
                    <td><?php echo htmlspecialchars($commande->getIdCommande()); ?></td>
                    <td><?php echo htmlspecialchars($commande->getAgence()); ?></td>
                    <td><?php echo htmlspecialchars($commande->getDate()); ?></td>
                    <td><?php echo htmlspecialchars($commande->getStatus()); ?></td>
                    <td>
                        <button class="btn btn-warning" 
                                data-toggle="modal" 
                                data-target="#editCommandeModal" 
                                data-id="<?php echo $commande->getIdCommande(); ?>" 
                                data-agence="<?php echo htmlspecialchars($commande->getAgence()); ?>"
                                data-date="<?php echo htmlspecialchars($commande->getDate()); ?>"
                                data-status="<?php echo htmlspecialchars($commande->getStatus()); ?>">
                            Modifier
                        </button>
                        <form action="/delete.commande" method="POST" style="display:inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet commande ?');">
                            <input type="hidden" name="id_commande" value="<?php echo $commande->getIdCommande(); ?>">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>                    
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Aucune commande trouvée.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Bouton pour ouvrir la modale -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCommandeModal">
    Ajouter une Commande
</button>

<!-- Modale pour ajouter une nouvelle commande -->
<div id="addCommandeModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter une nouvelle commande</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/create.commande" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="agence">Agence</label>
                        <select class="form-control" id="agence" name="agence" required>
                            <option value="">Sélectionnez un agence</option>
                            <?php foreach ($agences as $agence): ?>
                                <option value="<?php echo $agence->getIdAgence(); ?>">
                                    <?php echo htmlspecialchars($agence->getNom()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="" disabled selected>Choisir un statut</option>
                            <option value="En cours">En attente</option>
                            <option value="Complete">Complété</option>
                            <option value="Annulé">Annulé</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter Commande</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modale pour modifier une commande -->
<div id="editCommandeModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifier la commande</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/update.commande" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_commande" id="editIdCommande">
                    <div class="form-group">
                        <label for="editAgence">Agence</label>
                        <select class="form-control" id="editAgence" name="agence" required>
                            <?php foreach ($agences as $agence): ?>
                                <option value="<?php echo $agence->getIdAgence(); ?>">
                                    <?php echo htmlspecialchars($agence->getNom()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editDate">Date</label>
                        <input type="date" class="form-control" id="editDate" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <select class="form-control" id="editStatus" name="status" required>
                            <option value="" disabled selected>Choisir un statut</option>
                            <option value="En cours">En attente</option>
                            <option value="Complete">Complété</option>
                            <option value="Annulé">Annulé</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Modifier Commande</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript pour remplir les champs de la modale -->
<script>
    $(document).ready(function() {
        $('#editCommandeModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var idCommande = button.data('id');
            var agence = button.data('agence');
            var date = button.data('date');
            var status = button.data('status');

            $('#editIdCommande').val(idCommande);
            $('#editAgence').val(agence);
            $('#editDate').val(date);
            $('#editStatus').val(status);
        });
    });
</script>