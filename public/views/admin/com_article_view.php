<!-- tableau de recherche -->
<div class="text-right">
    <form action="/comArticle" method="POST">
        <input type="number"  name="id_comArticle" placeholder="Id de la commande d'article" required>
        <button type="submit" class="btn btn-info">Rechercher</button>
    </form>
</div>
<?php if (!empty($com_articlesId)): ?>
    <h1>Resultat recherche</h1>
        <table class="table table-stripped table-hover">
        <tbody>
        <tr>
                    <td><?php echo htmlspecialchars($com_articlesId->getIdComArticle()); ?></td>
                    <td><?php echo htmlspecialchars($com_articlesId->getCommande()); ?></td>
                    <td><?php echo htmlspecialchars($com_articlesId->getArticle()); ?></td>
                    <td><?php echo htmlspecialchars($com_articlesId->getEntree() ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($com_articlesId->getSortie()); ?></td>
                    <td>
                        <button class="btn btn-warning" 
                                data-toggle="modal" 
                                data-target="#editComArticleModal" 
                                data-id="<?php echo $com_articlesId->getIdComArticle(); ?>" 
                                data-commande="<?php echo htmlspecialchars($com_articlesId->getCommande()); ?>"
                                data-article="<?php echo htmlspecialchars($com_articlesId->getArticle()); ?>"
                                data-entree="<?php echo htmlspecialchars($com_articlesId->getEntree() ?? ''); ?>"
                                data-sortie="<?php echo htmlspecialchars($com_articlesId->getSortie()); ?>">
                            Modifier
                        </button>
                        <form action="/delete.comArticle" method="POST" style="display:inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article de commande ?');">
                            <input type="hidden" name="id_com_article" value="<?php echo $com_articlesId->getIdComArticle(); ?>">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
        </tbody>
        </table>
<?php endif; ?>



<h1>Liste des Articles de Commande</h1>
<table class="table table-stripped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Commande</th>
            <th>Article</th>
            <th>Entree</th>
            <th>Sortie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($com_articles)): ?>
            <?php foreach ($com_articles as $com_article): ?>
                <tr>
                    <td><?php echo htmlspecialchars($com_article->getIdComArticle()); ?></td>
                    <td><?php echo htmlspecialchars($com_article->getCommande()); ?></td>
                    <td><?php echo htmlspecialchars($com_article->getArticle()); ?></td>
                    <td><?php echo htmlspecialchars($com_article->getEntree() ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($com_article->getSortie()); ?></td>
                    <td>
                        <button class="btn btn-warning" 
                                data-toggle="modal" 
                                data-target="#editComArticleModal" 
                                data-id="<?php echo $com_article->getIdComArticle(); ?>" 
                                data-commande="<?php echo htmlspecialchars($com_article->getCommande()); ?>"
                                data-article="<?php echo htmlspecialchars($com_article->getArticle()); ?>"
                                data-entree="<?php echo htmlspecialchars($com_article->getEntree() ?? ''); ?>"
                                data-sortie="<?php echo htmlspecialchars($com_article->getSortie()); ?>">
                            Modifier
                        </button>
                        <form action="/delete.comArticle" method="POST" style="display:inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article de commande ?');">
                            <input type="hidden" name="id_com_article" value="<?php echo $com_article->getIdComArticle(); ?>">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Aucun article de commande trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Bouton pour ouvrir la modale -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addComArticleModal">
    Ajouter un Article de Commande
</button>

<!-- Modale pour ajouter un nouvel article de commande -->
<div id="addComArticleModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un nouvel article de commande</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/create.comArticle" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="commande">Commande</label>
                        <select class="form-control" id="commande" name="commande" required>
                            <option value="">Sélectionnez un commande</option>
                            <?php foreach ($commandes as $commande): ?>
                                <option value="<?php echo $commande->getIdCommande(); ?>">
                                    <?php echo htmlspecialchars($commande->getIdCommande()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="article">Article</label>
                        <select class="form-control" id="article" name="article" required>
                            <option value="">Sélectionnez un article</option>
                            <?php foreach ($articles as $article): ?>
                                <option value="<?php echo $article->getIdArticle(); ?>">
                                    <?php echo htmlspecialchars($article->getNom()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="entree">Entree</label>
                        <input type="number" class="form-control" id="entree" name="entree" value="0" required>
                    </div>
                    <div class="form-group">
                        <label for="sortie">Sortie</label>
                        <input type="number" class="form-control" id="sortie" name="sortie" value="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modale pour modifier une agence -->
<div id="editComArticleModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Entête de la modale -->
            <div class="modal-header">
                <h4 class="modal-title">Modifier la commande de l'article</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Corps de la modale -->
            <form action="/update.comArticle" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir modifier cette article ?');">
                <div class="modal-body">
                    <input type="hidden" name="id_com_article" id="editIdComArticle">
                    <div class="form-group">
                        <label for="editCommande">Commande</label>
                        <select class="form-control" id="editCommande" name="commande" required>
                            <option value="">Sélectionnez un commande</option>
                            <?php foreach ($commandes as $commande): ?>
                                <option value="<?php echo $commande->getIdCommande(); ?>">
                                    <?php echo htmlspecialchars($commande->getIdCommande()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editArticle">Article</label>
                        <select class="form-control" id="editArticle" name="article" required>
                            <option value="">Sélectionnez un article</option>
                            <?php foreach ($articles as $article): ?>
                                <option value="<?php echo $article->getIdArticle(); ?>">
                                    <?php echo htmlspecialchars($article->getNom()); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editEntree">Entree</label>
                        <input type="text" class="form-control" id="editEntree" name="entree" required>
                    </div>
                    <div class="form-group">
                        <label for="editSortie">Sortie</label>
                        <input type="number" class="form-control" id="editSortie" name="sortie" required>
                    </div>
                </div>

                <!-- Pied de la modale -->
                <div class="modal-footer">
                    <button type="button" class ="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" name="ModifierArticle" >Modifier Commande Article</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript pour remplir les champs de la modale -->
<script>
    $(document).ready(function() {
        $('#editComArticleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var idComArticle = button.data('id');
            var commande = button.data('commande');
            var article = button.data('article');
            var entree = button.data('entree');
            var sortie = button.data('sortie');

            $('#editIdComArticle').val(idComArticle);
            $('#editCommande').val(commande);
            $('#editArticle').val(article);
            $('#editEntree').val(entree);
            $('#editSortie').val(sortie);
        });
    });
</script>