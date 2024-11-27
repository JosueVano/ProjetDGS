<?php App\Lib\View::header() ?>

<h1>Liste agence</h1>    
<table class="table table-stripped table-hover">
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
                <?php foreach ($agences as $agence): ?>
                <tr>
                    <td><?php echo $agence->id_agence ?></td>
                    <td><?php echo $agence->nom ?></td>
                    <td><?php echo $agence->email ?></td>
                    <td><?php echo $agence->status ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
</table>

<?php App\Lib\View::footer() ?>