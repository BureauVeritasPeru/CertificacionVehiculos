<script type="text/javascript">
  $(document).ready(function() {
    $('#userName').focus();
    function Login(){
      if($('#userName').val()===''){
        alert('Ingrese su usuario'); $('#userName').focus();
        return;
      }
      if($('#password').val()===''){
        alert('Ingrese su contrase\xF1a'); $('#password').focus();
        return;
      }

      $('#Command').val('login');
      $('form').submit();
    }

    $('#btnSubmit').click(function(){
      Login();
    });
    $('#password').keypress(function(event){
      if ( event.which == 13 ) {
        event.preventDefault();
        Login();
      }
    });
  });
</script>


<div class="form-group has-feedback">
  <input type="text" class="form-control" id="userName" name="userName" placeholder="Usuario">
  <span class="glyphicon glyphicon-user form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
  <input type="password" id="password" name="password" class="form-control" placeholder="Password">
  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<div class="row">
  <div class="col-xs-3">
  </div>
  <!-- /.col -->
  <div class="col-xs-6">
    <button type="submit" id="btnSubmit" name="btSubmit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
  </div>
  <!-- /.col -->
  <div class="col-xs-3">
  </div>
</div>


<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

