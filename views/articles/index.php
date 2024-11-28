<?php App\Lib\View::header() ?>
<div class="flex justify-center mt-20">
    <div class="w-3/5">
        <div class="flex justify-between items-center px-2 border-b-2 border-b-gray-400 mb-3">
            <div class=" text-gray-700 font-semibold text-lg">
                <i class="fal fa-list mr-2"></i>
                Liste des articles
            </div>
            <div class="text-gray-500 space-x-3">
                <a href="/article/create" class="hover:text-orange-500">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
        </div> 
        <div>   
            <table class="table table-stripped table-hover">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th class="text-right">Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?php echo $article->id_article ?></td>
                            <td><?php echo $article->nom ?></td>
                            <td class="text-right"><?php echo number_format($article->prix, '2',',',' ') ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>
<?php App\Lib\View::footer() ?>