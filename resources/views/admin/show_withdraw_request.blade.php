<div id="process_request_{{ $withdraw_request->id }}" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">

            <form action="{{ route('suser.process_withdraw', $withdraw_request->id) }}" method="POST">
                  @csrf
                  <div class="modal-header">
                    <h5 class="modal-title">Ref No.: {{ strtoupper($withdraw_request->reference_no->reference_no) }}</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <div class="modal-body">
                  	<table class="table table-striped" id="table-striped">
                  		<tbody>
                  			<tr>
                  				<td>User: </td>
                  				<td>{{ ucfirst($withdraw_request->user->first_name) }} {{ ucfirst($withdraw_request->user->last_name) }}</td>
                  			</tr>
                  			<tr>
                  				<td>Amount</td>
                  				<td>{{ $withdraw_request->amount }}</td>
                  			</tr>
                  			<tr>
                  				<td>Charge</td>
                  				<td>{{ $withdraw_request->charge }}</td>
                  			</tr>
                  			<tr>
                  				<td>Account Name</td>
                  				<td>{{ $withdraw_request->acc_name }}</td>
                  			</tr>
                  			<tr>
                  				<td>Bank Name</td>
                  				<td>{{ $withdraw_request->bank_name }}</td>
                  			</tr>
                  			<tr>
                  				<td>Account Number</td>
                  				<td>{{ $withdraw_request->acc_no }}</td>
                  			</tr>
                  			<tr>
                  				<td>Account Type</td>
                  				<td>{{ ucfirst($withdraw_request->acc_type) }}</td>
                  			</tr>
                  			<tr>
                  				<td>Date</td>
                  				<td>{{ $withdraw_request->created_at->toDayDateTimeString() }}</td>
                  			</tr>
                                    <tr>
                                          <td>Withdrawal Message</td>
                                          <td>
                                                @if($withdraw_request->service_stat_id == 5)
                                                      <textarea type="text" class="form-control" name="message" id="message" maxlength="255" rows="1" style="resize: none" placeholder="Give user information about his withdraw request" required>{{ old('message') }}</textarea>
                                                @else
                                                      {{ $withdraw_request->message }}
                                                @endif

                                          </td>
                                    </tr>
                  		</tbody>
                  	</table>
                  </div>
                  <div class="modal-footer">
                        @if($withdraw_request->service_stat_id == 5)
                  		<input type="submit" class="btn btn-success" name="withdraw" value="Accept">
                              <input type="submit" class="btn btn-danger" name="withdraw" value="Reject">
                        @else
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        @endif
                  </div>
            </form>
          </div>
      </div>
</div>