<?php include('topo.php');?>
    <section id="carousel">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
            <!-- Slide One - Set the background image for this slide in the line below -->
            <div class="carousel-item active" style="background-image: url('img/banner1.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-4">Da natureza para você</h2>
                </div>
            </div>
            <!-- Slide Two - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('img/banner2.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-4">Produtos religiosos</h2>
                    <p class="lead">Feitos com carinho, respeitando todas as fés</p>
                </div>
            </div>
            <!-- Slide Three - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('img/banner3.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="display-4">Bonecas feitas à mão</h2>
                    <p class="lead">Artesanatos de qualidade, feitos por vó com amor de vó</p>
                </div>
            </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>    
    </section>
    <section id="experimente">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-8 offset-2 text-center">
                    <h2>Conheça toda a linha</h2>
                    <p>Aqui está nosso catálogo para revendedores, os preços são atualizados ocasionalmente, pode ser que esteja com um catálogo anterior, quer se atualizar?</p>
                    <a href="catalogo.pdf" class="btn btn-especial" target="_blank"> Baixe nosso portfólio </a>
                </div>
            </div>
        </div>
    </section>
<?php include('base.php')?>