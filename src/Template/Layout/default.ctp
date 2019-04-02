<!doctype html>
<html lang="pt-BR" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Sistema Florart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <?=$this->Html->script('vendors/jquery-3.2.1.min')?>
    <?=$this->Html->script('require.min')?>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->
    <?=$this->Html->css('dashboard')?>
    <?=$this->Html->css('colorbox')?>
    <?=$this->Html->script('dashboard')?>
    <!-- Input Mask Plugin -->
    <?=$this->Html->script('plugins/input-mask/plugin')?>
    <?=$this->Html->script('colorbox.min')?>
  </head>
  <body class="">
    <div class="page">
      <div class="page-main">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="./index.html">
                <img src="/img/logo-florart.png" class="header-brand-img" alt="tabler logo">
              </a>
              <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url(/img/25.jpg)"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">Maria Antonietta</span>
                      <small class="text-muted d-block mt-1">Administradora</small>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-user"></i> Perfil
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-help-circle"></i> Precisa de ajuda?
                    </a>
                    <?=$this->Html->link('<i class="dropdown-icon fe fe-log-out"></i> Sair',['controller'=>'users','action'=>'logout'],['class'=>"dropdown-item",'escape'=>false])?>
                  </div>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.html" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-users"></i> Pessoas</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <?=$this->Html->link('Clientes', ['controller'=>'Clientes','action'=>'/'], ["class"=>"dropdown-item"])?>
                      <?=$this->Html->link('Fornecedores', ['controller'=>'fornecedores','action'=>'/'], ["class"=>"dropdown-item"])?>
                      <?=$this->Html->link('Usuários', ['controller'=>'Users'], ["class"=>"dropdown-item"])?>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-package"></i> Produção</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <?=$this->Html->link('Lotes',[],['class'=>"dropdown-item"])?></a>
                      <?=$this->Html->link('Fabricação',['controller'=>'produtos','action'=>'fabrica'],['class'=>"dropdown-item"])?></a>
                      <?=$this->Html->link('Pré-Fabricação',['controller'=>'produtos','action'=>'preFabrica'],['class'=>"dropdown-item"])?></a>
                      <?=$this->Html->link('Produtos',['controller'=>'produtos'],['class'=>"dropdown-item"])?></a>
                      <?=$this->Html->link('Mão de obra',['controller'=>'produtos','action'=>'maoDeObra'],['class'=>"dropdown-item"])?></a>
                      <?=$this->Html->link('Matéria-prima',['controller'=>'materia-primas'],['class'=>"dropdown-item"])?></a>
                      <?=$this->Html->link('Tipos e Grupos',['controller'=>'tipo-materia-primas'],['class'=>"dropdown-item"])?></a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-dollar-sign"></i> Financeiro</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <?=$this->Html->link('Pedidos',['controller'=>'financeiro','action'=>'pedidos'],['class'=>"dropdown-item"])?></a>
                      <?=$this->Html->link('Compras',['controller'=>'financeiro','action'=>'compras'],['class'=>"dropdown-item"])?></a>
                      <?=$this->Html->link('Vendas',['controller'=>'financeiro','action'=>'vendas'],['class'=>"dropdown-item"])?></a>
                      <?=$this->Html->link('Fechamento',['controller'=>'financeiro','action'=>'fechamento'],['class'=>"dropdown-item"])?></a>
                      <?=$this->Html->link('Relatórios',['controller'=>'relatorios','action'=>'financeiro'],['class'=>"dropdown-item"])?></a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="./form-elements.html" class="nav-link"><i class="fe fe-check-square"></i> Forms</a>
                  </li>
                  <li class="nav-item">
                    <a href="./gallery.html" class="nav-link"><i class="fe fe-image"></i> Gallery</a>
                  </li>
                  <li class="nav-item">
                    <a href="./docs/index.html" class="nav-link"><i class="fe fe-file-text"></i> Documentation</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <?=$this->Flash->render();?>
        <div class="my-3 my-md-5">
            <div class="container">
              <div class="row">
                <?=$this->fetch('content');?>
              </div>
            </div>
        </div>
      </div>
    </div>
    <script>
        $(document).ready(function(){
            $('._colorbox').colorbox();
        });
    </script>
  </body>
</html>
