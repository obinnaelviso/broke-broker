<div id="add_default_transaction" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <form action="{{ route('suser.default-transactions.add') }}" method="POST">
                @csrf
                <div class="modal-header">
                  <h5 class="modal-title">Add Default Transactions</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table class="table table-striped" id="table-striped">
                        <tbody>
                            <tr>
                                <td>Initial Deposit</td>
                                <td><input type="text" class="form-control small-input num" name="initial_deposit" placeholder="0.00"/></td>
                            </tr>
                            <tr>
                                <td>Profit Made</td>
                                <td><input type="text" class="form-control small-input num" name="profit_made" placeholder="0.00"/></td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td><input type="text" class="form-control mb-4" name="created_at" id="datetimepicker" value="{{ old('created_at') }}" required readonly></td>
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
