<?php App\Lib\View::header() ?>
<div class="flex justify-center mt-20">
    <div class="w-2/5">
        <div class="flex justify-between items-center px-2 border-b-2 border-b-gray-400 mb-3">
            <div class=" text-gray-700 font-semibold text-lg">
                <i class="fal fa-cart-shopping mr-2"></i>
                Article
            </div>
            <div class="text-gray-500 space-x-3">
                <a href="/article/create" class="hover:text-orange-500">
                    <i class="fal fa-plus"></i>
                </a>
            </div>
        </div> 
        <div class="mt-5">   
            <form method="POST" action="/article/store">
                <div class="space-y-3">
                    <div>
                        <label for="">Nom de l'article</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div>
                        <label for="">Prix unitaire</label>
                        <input type="text" name="prix" class="form-control">
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-warning">
                        <i class="fal fa-save mr-1"></i>
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php App\Lib\View::footer() ?>