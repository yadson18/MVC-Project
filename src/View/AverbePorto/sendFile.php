<div class="container-fluid col-md-10 col-md-offset-2 col-sm-9 col-sm-offset-3 col-xs-12" id="send-file">
    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12" id="message">
        <?= $this->flashShowMessage() ?>
    </div>
    <div id="send-file-content" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
        <p id="send-file-header">
            <b>Atenção:</b> 
            para que o arquivo seja guardado com sucesso, selecione o 
            <b><abbr title="Documento de dados organizados hierarquicamente">XML</abbr></b> com 
            <a target="blank" href="http://www.nfe.fazenda.gov.br/portal/principal.aspx">NF-e</a>, 
            <a target="blank" href="http://www.cte.fazenda.gov.br/portal/">CT-e</a> ou
            <a target="blank" href="https://www.fazenda.sp.gov.br/mdfe/">MDF-e</a>
             válidos, ou um conjunto de arquivos
            <b><abbr title="Documento de dados organizados hierarquicamente">XML</abbr></b> 
            comprimidos no formato <b><abbr title="Arquivo comprimido">ZIP</abbr></b>.
        </p>
        <form id="form-send-file" method="POST" action="/AverbePorto/sendFile" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" name="file" class="file" required>
                <div class="input-group col-xs-12">
                    <span class="input-group-addon">
                        <i class="fa fa-file-o" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control" disabled placeholder="Selecione um arquivo">
                    <span class="input-group-btn">
                        <button class="browse btn btn-primary" type="button">
                            <i class="fa fa-folder-open-o" aria-hidden="true"></i> Buscar
                        </button>
                    </span>
                </div>
            </div>
            <div id="message-box" class="form-group">
                <i><p class="error"></p></i>
            </div>
            <div class="form-group">
                <button class="form-control btn btn-success input-lg" id="send-file-btn">
                    Enviar <i class="fa fa-upload" aria-hidden="true"></i>
                </button>
            </div>
        </form>
    </div>
</div>