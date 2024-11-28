<?php App\Lib\View::header() ?>
<div class="flex justify-center mt-40">
    <div class="w-2/5 space-y-6"> 
        <div>
            <a href="/article" class="font-semibold text-lg text-gray-500 hover:text-orange-500">
            <span class="text-orange-500"><i class="fad fa-light fa-scanner-keyboard fa-xl mr-3"></i></span>
                Consulter les prix</a>
        </div>
        <div>
            <a href="/commande" class="font-semibold text-lg text-gray-500 hover:text-sky-600">
            <span class="text-sky-600"><i class="fad fa-cart-plus fa-xl mr-2"></i></span>
                Consulter les commandes</a>
        </div>
        <div>
            <a href="/stock" class="font-semibold text-lg text-gray-500 hover:text-rose-500">
            <span class="text-rose-500"><i class="fa-sharp fa-regular fa-boxes-stacked  fa-xl mr-3"></i></span>
                Consulter les stock</a>
        </div>
    </div>
</div>
<?php App\Lib\View::footer() ?>
