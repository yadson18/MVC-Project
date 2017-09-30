<div id="home-container" class="col-md-12 col-sm-12 col-xs-12">
        <?php  
            // Fazer método para setar variáveis da view no atributo da classe TemplateSystem
            // O método deve serializar todos os dados.

            // Fazer o método para mostrar as variáveis na view, a deserialização dos dados deve ser feita.
            // Os nomes das variáveis na view, serão baseadas nos índices do array.

            /*echo "<br><br><br><br><br>";

            class Car{
                public $modelo;
                public $marca;
            }

            function setViewData($data){
                $viewData = [];

                if(!empty($data) && is_array($data)){
                    foreach($data as $variableName => $variableContent){
                        if(is_string($variableName)){
                            $viewData[$variableName] = $variableContent;
                        }
                    }

                    return call_user_func_array("serialize", [$viewData]);
                }
                return false;
            }

            function loadViewVars($variables){
                ob_start();

                $variables = unserialize($variables);

                foreach($variables as $name => $value){
                    $$name = $value;

                    debug($$name);
                }

                return ob_get_clean();
            }

            $a = new Car();

            $result = setViewData([
                "Users" => $a, 
                "Products" => $a,
                "Nfe" => $a,
                "Nfce" => $a,
                "Destinataries" => $a
            ]);
            
            $Users = loadViewVars($result);

            debug($Users); */
        ?>
    <div class="banner">
        <h1 class="banner-title">Framework ILP</h1>
        <img src="/images/notebook.png" class="banner-image">
    </div>
    <div class="features">
        <h1 class="features-title">Funcionalidades</h1>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <div class="icon">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    </div>
                    <div class="caption">
                        <h3>Exemplo</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent placerat felis est, et sollicitudin nibh sollicitudin ac. Mauris non porttitor massa. Quisque ut lobortis augue, sit amet malesuada lacus. Etiam a dapibus elit.
                        </p>
                        <p>
                            <a href="#" class="btn btn-primary" role="button">Button</a> 
                            <a href="#" class="btn btn-default" role="button">Button</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <div class="icon">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    </div>
                    <div class="caption">
                        <h3>Exemplo</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent placerat felis est, et sollicitudin nibh sollicitudin ac. Mauris non porttitor massa. Quisque ut lobortis augue, sit amet malesuada lacus. Etiam a dapibus elit.
                        </p>
                        <p>
                            <a href="#" class="btn btn-primary" role="button">Button</a> 
                            <a href="#" class="btn btn-default" role="button">Button</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <div class="icon">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    </div>
                    <div class="caption">
                        <h3>Exemplo</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent placerat felis est, et sollicitudin nibh sollicitudin ac. Mauris non porttitor massa. Quisque ut lobortis augue, sit amet malesuada lacus. Etiam a dapibus elit.
                        </p>
                        <p>
                            <a href="#" class="btn btn-primary" role="button">Button</a> 
                            <a href="#" class="btn btn-default" role="button">Button</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer id="home-footer" class="col-md-12 col-sm-12 col-xs-12">
    <div class="col-md-3">
        <a href="#" target="blank">
            <p>
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                Encontre-nos
            </p> 
        </a>
    </div>
    <div class="col-md-3">
        <a href="https://www.facebook.com/" target="blank">
            <p>
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                Facebook
            </p> 
        </a>
    </div>
    <div class="col-md-3">
        <p class="padding">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            email@email.com
        </p> 
    </div>
    <div class="col-md-3">
        <p class="padding">
            <i class="fa fa-phone-square" aria-hidden="true"></i>
            (81) 99999-9999
        </p> 
    </div>
</footer>