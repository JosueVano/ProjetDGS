<?php App\Lib\View::header() ?>

<div class="flex justify-center mt-20">
    <div class="w-3/5">
        <div class="flex justify-between items-center px-2 border-b-2 border-b-gray-400 mb-3">
            <div class=" text-gray-700 font-semibold text-lg">
                <i class="fal fa-home mr-2"></i>
                Liste des agences
            </div>
            <div class="text-gray-500 space-x-3">
                <a href="/agence/create" class="hover:text-orange-500">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
        </div> 
        <div class="mt-5">     
            <table class="table table-stripped table-hover">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach ($agences as $agence): ?>
                            <tr>
                                <td><?php echo $agence->id_agence ?></td>
                                <td><?php echo $agence->nom ?></td>
                                <td><?php echo $agence->email ?></td>
                                <td class="text-right">
                                    <a href="<?php echo "/agence/show?id=$agence->id_agence" ?>" class="text-gray-500 hover:text-orange-500 mr-2">
                                        <i class="fal fa-search-plus fa-lg"></i>
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