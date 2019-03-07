
<!doctype html>
<html lang="en" dir="ltr">
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
    <title>Login - tabler.github.io - a responsive, flat and full featured admin template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="/css/dashboard.css" rel="stylesheet" />
    <script src="/js/dashboard.js"></script>
    <script src="./assets/plugins/input-mask/plugin.js"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <img src="/img/logo-florart.png" class="h-6" alt="">
              </div>
              <?=$this->Form->create(null, ['class'=>"card"])?>
                <div class="card-body p-6">
                  <div class="card-title">Login to your account</div>
                  <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <?=$this->Form->control('email', ['label'=>false,"class"=>"form-control","placeholder"=>"Digite seu e-mail",'autocomplete'=>'off'])?>
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Senha
                    </label>
                    <?=$this->Form->control('password', ['label'=>false,"class"=>"form-control","placeholder"=>"Digite sua senha"])?>
                  </div>
                  <div class="form-footer">
                    <?=$this->Form->button('Entrar', ["class"=>"btn btn-primary btn-block"])?>
                  </div>
                </div>
              <?=$this->Form->end()?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>