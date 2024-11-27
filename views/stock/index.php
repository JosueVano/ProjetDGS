<?php App\Lib\View::header() ?>
<div class="flex justify-center mt-20">
    <div class="w-3/5">
        <div class="flex justify-between items-center px-2 border-b-2 border-b-gray-400 mb-3">
            <div class=" text-gray-700 font-semibold text-lg">
                <i class="fal fa-list mr-2"></i>
                Stock
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
                            <th>#</th>
                            <th>Nom de l'article</th>
                            <th>Quantite</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0 ?>
                        <?php foreach ($stocks as $stock): ?>
                            <?php $i++; ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="uppercase"><?php echo $stock->nom ?></td>
                                <td class="uppercase"><?php echo $stock->qte ?></td>
                                <td class="text-right">
                                    <a href="" class="text-gray-500 hover:text-orange-500 mr-2">
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
</div>
<?php App\Lib\View::footer() ?>