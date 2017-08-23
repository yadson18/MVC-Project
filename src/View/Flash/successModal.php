<div class="modal fade in" id="modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="alert alert-success modal-header" role="alert"> 
        <button type="button" class="close closeModal" aria-label="Close">
          <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <h4 class="modal-title">
          <i class="fa fa-check-circle" aria-hidden="true"></i> <?= $message ?>
        </h4> 
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" href="/Contract/add">Sim</a>
        <button type="button" class="btn btn-danger closeModal">Não</button>
      </div>
    </div>
  </div>
</div>
<div class="modal-backdrop fade in" id="background"></div>