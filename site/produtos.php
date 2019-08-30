<?php include('topo.php');
$db = new PDO("sqlite:".__DIR__."/produtos.db");
$produto = $db->query("SELECT * FROM produtos ORDER BY id");
$produtos = $produto->fetchAll();
?>
    <section id="produtos">
        <div class="container">
        <?php
        $c = 0;
        foreach($produtos as $p){
            if(($c%2)==0){
        ?>
            <div class="row align-items-center">
                <div class="col order-1 order-md-0 col-md-8 col-12">
                    <h2><?=$p['titulo']?></h2>
                    <h6><i><?=$p['tamanhos']?></i></h6>
                    <?=$p['texto']?>
                    <div class="w-100 text-md-left text-center">
                        <a href="produto.php?id=<?=$p['id']?>" class="btn btn-especial"> Mais detalhes </a>
                    </div>
                </div>
                <div class="col order-0 order-md-1 col-md-4 col-12">
                    <img src="img/<?=$p['imagem']?>" class="img-fluid">
                </div>
            </div>
        <?php
            }else{
        ?>
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="img/<?=$p['imagem']?>" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <h2><?=$p['titulo']?></h2>
                    <h6><i><?=$p['tamanhos']?></i></h6>
                    <?=$p['texto']?>
                    <div class="w-100 text-md-left text-center">
                        <a href="produto.php?id=<?=$p['id']?>" class="btn btn-especial"> Mais detalhes </a>
                    </div>
                </div>
            </div>
        <?php
            }
            $c++;
        }
        ?>
    </section>
<?php include('base.php')?>
