<div id="show_generate_otp" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <form action="{{ route('suser.otps.generate') }}" method="POST">
                @csrf
                <div class="modal-header">
                  <h5 class="modal-title">Generate OTP</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table class="table table-striped" id="table-striped">
                        <tbody>
                            <tr>
                                <td>Select User</td>
                                <td>
                                    <select class="form-control" name="user_id" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ ucfirst($user->first_name.' '.$user->last_name) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
          </form>
        </div>
    </div>
</div>
