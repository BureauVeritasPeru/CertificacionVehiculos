$(function(){
	// 8
	$("#8").keydown(function(e) {
		if ( event.key == "Tab" || event.which == 13 ) {
			var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
			var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
			var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

			$('#totalEjemplares').val(total);

			if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
			if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
			if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
			if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
			if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
			if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
			if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
			if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
			if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
			if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
			if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
			if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
			if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
			if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
			if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
			if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
			if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
			if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
			if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
			if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
			if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}
			
			var porc = ((juveniles/total)*100).toFixed(3);
			$("#porcJuveniles").val(porc);
		}
	});
    // 8_5
    $("#8_5").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 9
    $("#9").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 9_5
    $("#9_5").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 10
    $("#10").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 10_5
    $("#10_5").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 11
    $("#11").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 11_5
    $("#11_5").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 12
    $("#12").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 12_5
    $("#12_5").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 13
    $("#13").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 13_5
    $("#13_5").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 14
    $("#14").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 14_5
    $("#14_5").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 15
    $("#15").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 15_5
    $("#15_5").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 16
    $("#16").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 16_5
    $("#16_5").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 17
    $("#17").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 17_5
    $("#17_5").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });
    // 18
    $("#18").keydown(function(e) {
    	if ( event.key == "Tab" || event.which == 13 ) {
    		var max = Math.max($("#8").val(),$("#8_5").val(),$("#9").val(),$("#9_5").val(),$("#10").val(),$("#10_5").val(),$("#11").val(),$("#11_5").val(),$("#12").val(),$("#12_5").val(),$("#13").val(),$("#13_5").val(),$("#14").val(),$("#14_5").val(),$("#15").val(),$("#15_5").val(),$("#16").val(),$("#16_5").val(),$("#17").val(),$("#17_5").val(),$("#18").val());
    		var total = ( parseFloat($("#8").val()) + parseFloat($("#8_5").val()) + parseFloat($("#9").val()) + parseFloat($("#9_5").val()) + parseFloat($("#10").val()) + parseFloat($("#10_5").val()) + parseFloat($("#11").val()) + parseFloat($("#11_5").val())+ parseFloat($("#12").val())+ parseFloat($("#12_5").val())+ parseFloat($("#13").val())+ parseFloat($("#13_5").val())+ parseFloat($("#14").val())+ parseFloat($("#14_5").val())+ parseFloat($("#15").val())+ parseFloat($("#15_5").val())+ parseFloat($("#16").val())+ parseFloat($("#16_5").val())+ parseFloat($("#17").val())+ parseFloat($("#17_5").val())+ parseFloat($("#18").val()));
    		var juveniles = (parseFloat($("#8").val())+parseFloat($("#8_5").val())+parseFloat($("#9").val())+parseFloat($("#9_5").val())+parseFloat($("#10").val())+parseFloat($("#10_5").val())+parseFloat($("#11").val())+parseFloat($("#11_5").val()));

    		$('#totalEjemplares').val(total);

    		if($("#8").val() == max){$('#moda').val(max);$('#frecuencia').val('8');}
    		if($("#8_5").val() == max){$('#moda').val(max);$('#frecuencia').val('8.5');}
    		if($("#9").val() == max){$('#moda').val(max);$('#frecuencia').val('9');}
    		if($("#9_5").val() == max){$('#moda').val(max);$('#frecuencia').val('9.5');}
    		if($("#10").val() == max){$('#moda').val(max);$('#frecuencia').val('10');}
    		if($("#10_5").val() == max){$('#moda').val(max);$('#frecuencia').val('10.5');}
    		if($("#11").val() == max){$('#moda').val(max);$('#frecuencia').val('11');}
    		if($("#11_5").val() == max){$('#moda').val(max);$('#frecuencia').val('11.5');}
    		if($("#12").val() == max){$('#moda').val(max);$('#frecuencia').val('12');}
    		if($("#12_5").val() == max){$('#moda').val(max);$('#frecuencia').val('12.5');}
    		if($("#13").val() == max){$('#moda').val(max);$('#frecuencia').val('13');}
    		if($("#13_5").val() == max){$('#moda').val(max);$('#frecuencia').val('13.5');}
    		if($("#14").val() == max){$('#moda').val(max);$('#frecuencia').val('14');}
    		if($("#14_5").val() == max){$('#moda').val(max);$('#frecuencia').val('14.5');}
    		if($("#15").val() == max){$('#moda').val(max);$('#frecuencia').val('15');}
    		if($("#15_5").val() == max){$('#moda').val(max);$('#frecuencia').val('15.5');}
    		if($("#16").val() == max){$('#moda').val(max);$('#frecuencia').val('16');}
    		if($("#16_5").val() == max){$('#moda').val(max);$('#frecuencia').val('16.5');}
    		if($("#17").val() == max){$('#moda').val(max);$('#frecuencia').val('17');}
    		if($("#17_5").val() == max){$('#moda').val(max);$('#frecuencia').val('17.5');}
    		if($("#18").val() == max){$('#moda').val(max);$('#frecuencia').val('18');}

    		var porc = ((juveniles/total)*100).toFixed(3);
    		$("#porcJuveniles").val(porc);
    	}
    });


})