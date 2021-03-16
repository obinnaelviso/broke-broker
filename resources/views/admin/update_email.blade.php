<div id="update_email" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">

        <form action="{{ route('suser.update_email', $user->id) }}" method="POST">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title">Update Email Address</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <div class="modal-body">
                <div class="form-control">
                  Email Address: <input type="email" class="form-control" name="email" id="email" placeholder="New Email Address" value="{{ $user->email }}" required>
                </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Update">
              </div>
        </form>
      </div>
  </div>
</div>