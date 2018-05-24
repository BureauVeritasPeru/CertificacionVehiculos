<?php
$q = OWASP::RequestString('q');
?>
<h1><?php echo $oContentLang->title;?></h1>
<div id="cse" style="width: 100%;">Loading</div>
<script src="http://www.google.com.pe/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
  google.load('search', '1', {language : 'es', style : google.loader.themes.V2_DEFAULT});
  google.setOnLoadCallback(function() {
    var customSearchOptions = {};  var customSearchControl = new google.search.CustomSearchControl(
      '012517403685476866867:brtgun2hqxa', customSearchOptions);
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    customSearchControl.draw('cse');
    customSearchControl.execute('<?php echo $q;?>');
  }, true);
</script>
<script type="text/javascript" src="<?php echo $URL_BASE;?>js/jquery.jqtransform.js"></script>
