
<?php

function asset($path)
{

   echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$path;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" href="<?php asset('css/style.css') ?>">
    <link rel="stylesheet" href="<?php asset('css/icons-font.css') ?>">
</head>
<body>
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1 justify-center items-center">
            <div style="width: 30rem">
                <h2>Connexion</h2>
                <form action="/login" method="post"> <!-- Ensure this points to your login route -->
                    <div class="space-y-3">
                        <input type="text" name="username" placeholder="Nom d'utilisateur" required class="form-control">                
                        <input type="password" name="password" placeholder="Mot de passe" required class="form-control">
                    </div>
                    <button type="submit">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>