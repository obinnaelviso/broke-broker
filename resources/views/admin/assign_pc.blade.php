<div id="assign_pc_{{ $promo_code->id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">

        <form action="{{ route('suser.assign_pc', [$pc_type->id, $promo_code->id]) }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Assign '{{ $promo_code->code }}'</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <div class="form-control">
              <div class="col-8">
                <select class="form-control mb-4" id="pc_assign" name="pc_assign" required>
                  <option value="" disabled selected>Assign Promo Code to: </option>
                  <option value="new_reg" @if($promo_code->id == 10) selected @endif>Newly Registered Users</option>
                  <option value="all">All Users</option>
                  <option value="unassigned">Un-Assign</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Assign Code">
          </div>
        </form>
      </div>
  </div>
</div>