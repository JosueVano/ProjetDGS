<!-- tableau de recherche -->
<div class="text-right">
    <form action="/article" method="POST">
        <input type="number"  name="id_article" placeholder="Id de l'article" required>
        <button type="submit" class="btn btn-info">Rechercher</button>
    </form>
</div>
<?php if (!empty($articlesId)): ?>
    <h1>Resultat recherche</h1>
        <table class="table table-stripped table-hover">
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($articlesId->getIdArticle()); ?></td>
                <td><?php echo htmlspecialchars($articlesId->getNom()); ?></td>
                <td><?php echo htmlspecialchars($articlesId->getPrix()); ?></td>
                <td>
                    <button class="btn btn-warning" 
                            data-toggle="modal" 
                            data-target="#editArticleModal" 
                            data-id="<?php echo $articlesId->getIdArticle(); ?>" 
                            data-nom="<?php echo htmlspecialchars($articlesId->getNom()); ?>"
                            data-prix="<?php echo $articlesId->getPrix(); ?>" >
                        Modifier
                    </button>
                    <form action="/delete.article" method="POST" style="display:inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette article ?');">
                        <input type="hidden" name="id_article" value="<?php echo $articlesId->getIdArticle(); ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        </tbody>
        </table>
<?php endif; ?>



<h1>Liste des Articles</h1>
    <table class="table table-stripped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix (en MGA)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?php echo htmlspecialchars($article->getIdArticle()); ?></td>
                    <td><?php echo htmlspecialchars($article->getNom()); ?></td>
                    <td><?php echo htmlspecialchars($article->getPrix()); ?></td>
                    <td>
                        <button class="btn btn-warning" 
                                data-toggle="modal" 
                                data-target="#editArticleModal" 
                                data-id="<?php echo $article->getIdArticle(); ?>" 
                                data-nom="<?php echo htmlspecialchars($article->getNom()); ?>"
                                data-prix="<?php echo $article->getPrix(); ?>" >
                            Modifier
                        </button>
                        <form action="/delete.article" method="POST" style="display:inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette article ?');">
                            <input type="hidden" name="id_article" value="<?php echo $article->getIdArticle(); ?>">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Aucun article trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

<!-- Bouton pour ouvrir la modale -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addArticleModal">
    Ajouter un Article
</button>

<!-- Modale pour ajouter un nouvel article -->
<div id="addArticleModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Entête de la modale -->
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un nouvel article</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Corps de la modale -->
            <form action="/create.article" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom de l'article" required>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="number" class="form-control" id="prix" name="prix" placeholder="Prix de l'article" required>
                    </div>
                </div>

                <!-- Pied de la modale -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter Article</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modale pour modifier une agence -->
<div id="editArticleModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Entête de la modale -->
            <div class="modal-header">
                <h4 class="modal-title">Modifier l'article</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Corps de la modale -->
            <form action="/update.article" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir modifier cette article ?');">
                <div class="modal-body">
                    <input type="hidden" name="id_article" id="editIdArticle">
                    <div class="form-group">
                        <label for="editNom">Nom</label>
                        <input type="text" class="form-control" id="editNom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="editPrix">Prix</label>
                        <input type="number" class="form-control" id="editPrix" name="prix" required>
                    </div>
                </div>

                <!-- Pied de la modale -->
                <div class="modal-footer">
                    <button type="button" class ="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" name="ModifierArticle" >Modifier Article</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript pour remplir les champs de la modale -->
<script>
    $(document).ready(function() {
        $('#editArticleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var idAgence = button.data('id');
            var nom = button.data('nom');
            var prix =button.data('prix');
           

            $('#editIdArticle').val(idAgence);
            $('#editNom').val(nom);
            $('#editPrix').val(prix);
        });
    });
</script>