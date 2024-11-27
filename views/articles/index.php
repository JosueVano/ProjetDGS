<?php App\Lib\View::header() ?>
<h1>Liste des articles</h1>    
<table class="table table-stripped table-hover">
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?php echo $article->id_article ?></td>
                    <td><?php echo $article->nom ?></td>
                    <td><?php echo $article->prix ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
</table>
<?php App\Lib\View::footer() ?>