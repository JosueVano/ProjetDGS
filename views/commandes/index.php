<?php App\Lib\View::header() ?>
<div class="px-20 mt-20">
    <div class="flex justify-between items-center px-2 border-b-2 border-b-gray-400 mb-3">
        <div class=" text-gray-700 font-semibold text-lg">
            <i class="fal fa-list mr-2"></i>
            Liste des commandes
        </div>
        <div class="text-gray-500 space-x-3">
            <a href="/commande/cart/create" class="hover:text-orange-500">
                <i class="fal fa-plus"></i>
            </a>
        </div>
    </div> 
    <div>   
        <table class="table table-stripped table-hover">
                <thead>
                    <tr>
                        <th>Réf</th>
                        <th>Agence</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commandes as $commande): ?>
                        <tr>
                            <td><?php echo $commande->id_commande ?></td>
                            <td class="uppercase"><?php echo $commande->nom ?></td>
                            <td><?php echo (new DateTime($commande->date))->format('d/m/Y') ?></td>
                            <td><?php echo key_exists($commande->status, $statusCommande) ? $statusCommande[$commande->status] : 'NA' ?></td>
                            <td class="text-right">
                                <a href="<?php echo "/commande/show?id=$commande->id_commande" ?>" class="text-gray-500 hover:text-orange-500 mr-2">
                                    <i class="fal fa-search-plus fa-lg"></i>
                                </a>
                                <a href="" class="text-gray-500 hover:text-orange-500 mr-2">
                                    <i class="fal fa-print fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
        </table>
    </div>
</div>
<?php App\Lib\View::footer() ?>