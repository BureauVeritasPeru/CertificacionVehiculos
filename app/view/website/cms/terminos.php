<style type="text/css">
      body {
        background: #fff;
        margin:0px;
        padding: 0px;
        overflow:hidden;
      }
      .terminos_condiciones {
        text-align: left;
        font-size: 12px;
        font-family: 'Arial';
        padding: 20px;
      }
      .terminos_condiciones h2, .terminos_condiciones h3 {
        color: #313a54;
        font-size: 12px;
        font-family: 'Arial';
      }
      .terminos_condiciones p {
        margin-bottom: 15px;
      }
      .terminos_condiciones h2 {
        text-align: center;
        margin-bottom: 20px;
      }
      .terminos_condiciones h3 {
        margin-bottom: 0px;
        font-weight: bold;
      }
      .nano .content div {
      margin-right: 20px;
      padding-bottom: 40px;
      }
    </style>

<div class="terminos_condiciones">
    <div class="nano">
      <div class="content">
      <div>
          
          <?php echo $oContentLang->description;?>
          
           </div>
    </div>
  </div>
  </div>
<script type="text/javascript">
  var nano = $(".nano");
  if(nano.length > 0){
    nano.nanoScroller({ scroll: 'top', alwaysVisible: true });
  }
</script>