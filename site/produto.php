<?php
$db = new PDO("sqlite:".__DIR__."/produtos.db");
$produto = $db->query("SELECT * FROM produtos WHERE id = ".$_GET['id']);
$produto = $produto->fetch();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css" media="all">
    <link rel="stylesheet" href="css/florart.min.css" media="all">
    <script src="js/jquery.min.js"></script>
    <meta property="og:url" content="http://www.florart.com.br/">
    <meta property="og:title" content="FlorArt : <?=$produto['titulo']?>">
    <meta property="og:site_name" content="FlorArt : <?=$produto['titulo']?>">
    <meta property="og:description" content="<?=$produto['chamada']?>">
    <meta name="description" content="<?=$produto['chamada']?>">
    <meta property="og:image" content="http://www.florart.com.br/img/<?=$produto['imagem']?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="450">
    <meta property="og:type" content="website">
    <title><?=$produto['titulo']?></title>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/logo-florart.png" alt="FLORART" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="quem-somos.php">Sobre nós</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produtos.php">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="amostras.php">Amostras</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </header>
    <main>
        <section id="produtos">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col order-1 order-md-0 col-md-8 col-12">
                        <h2><?php print $produto['titulo'];?></h2>
                        <h6><i><?=$produto['tamanhos'];?></i></h6>
                        <?=$produto['texto'];?>
                    </div>
                    <div class="col order-0 order-md-1 col-md-4 col-12">
                        <img src="img/<?=$produto['imagem'];?>" class="img-fluid">
                        <h6 class="w-100 text-center"><small>a partir de</small></h6>
                        <h2 class="w-100 text-center">R$ <b><?=number_format($produto['preco'],2,',','.');?></b></h2>
                        <h6 class="w-100 text-center"><small>a dúzia</small></h6>
                    </div>
                </div>
            </div>
        </section>
<?php include('base.php');?>
