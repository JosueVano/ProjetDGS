<?php App\Lib\View::header() ?>
<div class="flex justify-center mt-20">
    <div class="w-4/5">        
        <div class="flex justify-between items-center px-2 border-b-2 border-b-gray-400 mb-3">
            <div class=" text-gray-700 font-semibold text-lg">
                <i class="fal fa-file mr-2"></i>
                Commande
            </div>
            <div class="text-gray-500 space-x-3">
                <a href="/commande" class="hover:text-orange-500">
                    <i class="fal fa-list"></i>
                </a>
                <a href="/commande" class="hover:text-orange-500">
                    <i class="fal fa-edit"></i>
                </a>
                <a href="/commande" class="hover:text-orange-500">
                    <i class="fal fa-trash-alt"></i>
                </a>
            </div>
        </div> 
        <div>
            <div class="mb-5">
            </div>
            <?php if($mode == 'send'): ?>
            <div class="mb-5">
                <form method="POST" action="<?php echo "/commande/expedier/store?id=$commande->id_commande" ?>">
                    <div class="flex justify-between w-full space-x-2 items-center">
                        <div class="flex flex-1 space-x-2">
                            <div class="w-1/3">
                                <select name="typeTrans" class="form-control">
                                    <option value="1">TAXIBROUSSE</option>
                                    <option value="2">BATEAU</option>
                                    <option value="3">AVION</option>
                                </select>
                            </div>
                            <div class="w-1/3">
                                <input type="date" name="dateExp" class="form-control">
                            </div>
                            <div class="w-1/3">
                                <input type="text" name="refTrans" class="form-control" placeholder="Réf transporteur">
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-warning">
                                <i class="fal fa-paper-plane mr-1"></i>
                                Expedier
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <?php endif ?>
            <div>   
                <table class="table table-stripped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Désignation</th>
                                <th class="text-center">Quantité</th>
                                <th class="text-center">Prix Unit.</th>
                                <th class="text-right">Montant</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $article): ?>
                                <tr>
                                    <td><?php echo $article->id_com_article ?></td>
                                    <td class="uppercase"><?php echo $article->nom ?></td>
                                    <td class="text-center"><?php echo $article->qte ?></td>
                                    <td class="text-center"><?php echo $article->prix ?></td>
                                    <td class="text-right"><?php echo number_format($article->qte * $article->prix,2,',',' ') ?></td>
                                    <td class="text-right">
                                        <a href="" class="text-red-500 hover:text-orange-500 mr-2">
                                            <i class="fal fa-times fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>                            
                        </tbody>
                </table>
            </div>
            <?php if($mode == 'show' && $commande->status == '1'  && $agenceStatus == '1'): ?>
                <div class="mt-3">
                    <a href="<?php echo "/commande/expedier?id=$commande->id_commande" ?>" class="text-orange-500 hover:text-orange-700 hover:underline">
                        <i class="fal fa-paper-plane mr-1"></i>
                        Expedier</a>
                </div>
            <?php endif ?>

            <?php if($mode == 'show' && $commande->status == '2' && $agenceStatus == '2'): ?>
                <div class="mt-3">
                    <a href="<?php echo "/commande/reception?id=$commande->id_commande" ?>" class="text-orange-500 hover:text-orange-700 hover:underline">
                        <i class="fal fa-paper-plane mr-1"></i>
                        Reçu</a>
                </div>
            <?php endif ?>

        </div>
    </div>
</div>
<?php App\Lib\View::footer() ?>
