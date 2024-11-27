<?php App\Lib\View::header() ?>
<div class="flex justify-center mt-20">
    <div class="w-3/5">        
        <div class="flex justify-between items-center px-2 border-b-2 border-b-gray-400 mb-3">
            <div class=" text-gray-700 font-semibold text-lg">
                <i class="fal fa-file mr-2"></i>
                Nouveau commande
            </div>
            <div class="text-gray-500 space-x-3">
                <!-- <a href="/commande/create" class="hover:text-orange-500">
                    <i class="fal fa-plus"></i>
                </a> -->
            </div>
        </div> 
        <div>
            <div class="mb-5">
                <?php if($mode == 'create'): ?>
                    <form method="POST" action="/commande/cart/store">
                        <div class="flex w-full space-x-3">
                            <div class="flex flex-1 space-x-3">
                                <div class="w-1/2">                        
                                    <select name="article" class="form-control">
                                        <option value="">-- Sélection une article --</option>
                                        <?php foreach($articles as $article): ?>                                        
                                        <option value="<?php echo $article->id_article ?>"><?php echo $article->nom ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="w-1/2">  
                                    <input type="number" name="qte" value="" class="form-control" placeholder="Quantité">
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-warning">
                                    <i class="fal fa-plus-circle fa-lg"></i>
                                </button>
                            </div>        
                        </div>
                    </form>
                <?php endif ?>
                <?php if($mode == 'cart'): ?>
                    <form method="POST" action="/commande/store">
                        <div class="flex w-full space-x-3">
                            <div class="flex flex-1 space-x-3">
                                <div class="w-1/2">  
                                    <input type="date" name="dateCmd" value="<?php date('Y-m-d') ?>" class="form-control">
                                </div>
                                <div>
                                    <button class="btn btn-warning">
                                        <i class="fal fa-thumbs-up fa-lg"></i>
                                        Terminer
                                    </button>
                                </div>     
                            </div>   
                        </div>
                    </form>
                <?php endif ?>
            </div>
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
                            <?php foreach ($cmdArticles as $commande): ?>
                                <tr>
                                    <td><?php echo $commande->id ?></td>
                                    <td class="uppercase"><?php echo $commande->nom ?></td>
                                    <td class="text-center"><?php echo $commande->qte ?></td>
                                    <td class="text-center"><?php echo $commande->prix ?></td>
                                    <td class="text-right"><?php echo number_format($commande->qte * $commande->prix,2,',',' ') ?></td>
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
            <div class="mt-3">
                <?php if($mode == 'create'): ?>
                <a href="/commande/cart" class="text-orange-500 hover:text-orange-700">
                    Suivant
                    <i class="fad fa-forward ml-2"></i>
                </a>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>
<?php App\Lib\View::footer() ?>
