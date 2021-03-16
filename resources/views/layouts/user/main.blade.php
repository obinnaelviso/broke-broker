<!DOCTYPE html>
<html lang="zxx">
@include('layouts.head')
<body>
  @include('layouts.user.header')
  @include('layouts.user.wallet')
  @include('layouts.user.body')
  @include('layouts.footer')
  @include('layouts.js')
    <script>
        var accountNoVisible = false
        var account_no = '{{ $user->acc_no }}'
        $("#acc-no").html(account_no.substr(0,2) + 'XXXXXX' + account_no.substr(7,9))
        $("#show-acc-no").click(function() {
            if(accountNoVisible) {
                accountNoVisible = false
                $("#acc-no").html(account_no.substr(0,2) + 'XXXXXX' + account_no.substr(7,9))
                $("#show-acc-no").html('Show Account Number')
                $("#show-acc-no").attr('class', 'btn btn-danger')
            } else {
                accountNoVisible = true
                $("#acc-no").html(account_no)
                $("#show-acc-no").html('Hide Account Number')
                $("#show-acc-no").attr('class', 'btn btn-success')
            }
        });

        //Tawk
    </script>
</body>
</html>
