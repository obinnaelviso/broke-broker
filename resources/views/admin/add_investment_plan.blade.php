<div id="add_investment_plan" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <form action="{{ route('suser.investments.plans.add') }}" method="POST">
                @csrf
                <div class="modal-header">
                  <h5 class="modal-title">Add Investment Plans</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <table class="table table-striped" id="table-striped">
                        <tbody>
                            <tr>
                                <td>Title</td>
                                <td><input type="text" class="form-control" name="title" placeholder="Enter Investment Title"/></td>
                            </tr>
                            <tr>
                                <td>Min. Amount</td>
                                <td><input type="text" class="form-control" name="min_amount"/></td>
                            </tr>
                            <tr>
                                <td>Max. Amount</td>
                                <td><input type="text" class="form-control" name="max_amount"/></td>
                            </tr>
                            <tr>
                                <td>Duration</td>
                                <td><input type="text" class="form-control" name="duration" placeholder="Default: 7 days"/></td>
                            </tr>
                            <tr>
                                <td>Cycles</td>
                                <td><input type="text" class="form-control num" name="cycles" placeholder="Default: 1"/></td>
                            </tr>
                            <tr>
                                <td>Percentage</td>
                                <td><input type="text" class="form-control num" name="percentage" placeholder="Default: 15%"/></td>
                            </tr>
                            <tr>
                                <td>Bonus</td>
                                <td><input type="text" class="form-control" name="bonus" placeholder="Payout Bonus"/></td>
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
