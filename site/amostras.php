<?php include('topo.php');?>
        <section id="principal">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6 offset-3">
                        <?php
                        if(isset($_POST['nome']) && $_POST['nome']!=''){
                            $nome = htmlspecialchars($_POST['nome']);
                            $email = htmlspecialchars($_POST['email']);
                            $telefone = htmlspecialchars($_POST['telefone']);
                            $mensagem = htmlspecialchars($_POST['mensagem']);
                            $created = date('Y-m-d H:i:s');
                            $db = new PDO("sqlite:".__DIR__."/produtos.db");
                            $db->exec("INSERT INTO mensagens (nome, email, telefone, mensagem, created) VALUES ('$nome', '$email', '$telefone', '$mensagem', '$created')");
                            mail('mariaversiani@yahoo.com.br','[FLORART] Nova mensagem', "O cliente $nome ($email - $telefone) enviou a mensagem <b>$mensagem</b>");
                        ?>
                        <h2>Obrigado pelo contato</h2>
                        <p>Registramos seu contato, em breve nossa representante comercial entrará em contato.</p>
                        <div class="text-center my-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
                                <g fill="none" stroke="#8EC343" stroke-width="2">
                                    <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                                    <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                                </g>
                            </svg>                            
                        </div>
                        <?php
                        }else{
                        ?>
                        <h2>Solicite uma amostra</h2>
                        <p>Ou simplesmente <b>fale conosco</b>, teremos o maior prazer em receber seus comentários sobre nosso produto.</p>
                        <form action="amostras.php" method="POST">
                            <div class="form-group">
                                <input type="text" name="nome" placeholder="Seu nome" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Seu e-mail" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="telefone" placeholder="Seu telefone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <textarea name="mensagem" id="" cols="30" rows="10" class="form-control" placeholder="Fale um pouco da sua empresa/loja ou de você, para assim separarmos uma seleção ideal." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-especial"> Pedir </button>
                        </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
<?php include('base.php');?>