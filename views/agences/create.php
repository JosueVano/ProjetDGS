<?php App\Lib\View::header() ?>
<div class="flex justify-center mt-20">
    <div class="w-2/5">
        <div class="flex justify-between items-center px-2 border-b-2 border-b-gray-400 mb-3">
            <div class=" text-gray-700 font-semibold text-lg">
                <i class="fal fa-home mr-2"></i>
                Agence
            </div>
            <div class="text-gray-500 space-x-3">
                <a href="/agence" class="hover:text-orange-500">
                    <i class="fal fa-list"></i>
                </a>
            </div>
        </div> 
        <div class="mt-5">   
            <form method="POST" action="/agence/store">
                <div class="space-y-3">
                    <div>
                        <label for="" class="text-gray-500">Code</label>
                        <input type="text" name="code" class="form-control">
                    </div>
                    <div>
                        <label for="" class="text-gray-500">Nom de l'agence</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div>
                        <label for="" class="text-gray-500">Email</label>
                        <input type="text" name="email" class="form-control">
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