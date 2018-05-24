var input_valid = {'border': 'dashed 0px #4CAF50'};
var input_error = {'border': 'dashed  1px #b40139'};
if (typeof (hide_alert) != 'boolean') hide_alert = false;
if (typeof (require_field)!='string') require_field = "dato requerido";
if (typeof (require_email) != 'string') require_email = "el email no es v\xE1lido";
if (typeof (require_number) != 'string') require_number = "ingrese s\xF3lo n\xFAmeros";
if (typeof (require_date) != 'string') require_date = "fecha no v\xE1lida";
if (typeof (require_passw) != 'string') require_passw = "6 o mas caracteres";
if (typeof (require_compare) != 'string') require_compare = "La contrase\xF1a no coincide";

function validateEmail(value) {
    var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return pattern.test(value);
}
function validateNumber(value) {
    var pattern = /^[-+]?\d*$/; //numeros ex. 0001
    return pattern.test(value);
}
function validateDecimal(value){
    var pattern = /^(\d*\.)?\d*$/; //decimales ex. 1.74
    return pattern.test(value);
}
function validateIP(value){
    var pattern = /^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/; //IPv4 ex. 200.25.190.38
    return pattern.test(value);
}
function validateDate(value){
    var pattern = /^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/g; //Fecha ex. 05/10/2012
    return pattern.test(value);
}
function validatePhone(value) {
    var pattern = /^[0-9\-]*$/; //numeros ex. 1052-2212-55-565
    return pattern.test(value);
}
function validatePassword(value){
    var pattern = /^(?=.*\d).{6,16}$/; //para generar contraseñas ex. asdf1234
    return pattern.test(value);
}
function compareFields(value, field2){
    return value==$('#'+field2).val();
}

function valRequired(input) {
    if(input.attr('plugin')=='jqtransform') input.parent().css(input_valid); else input.css(input_valid);

    attr = input.attr('class').split(" ");
    valid = true;
    $.each(attr, function(i, type) {
        if (!valid) return false;
        err = "";
        switch (type) {
            case "required":
                if (input.val() == "") {
                    err = require_field;
                    valid = false; break;
                }
                break;
            case "email":
                if (input.val() != "" && !validateEmail(input.val())) {
                    err = require_email;
                    valid = false; break;
                }
                break;
            case "numeric":
                if (!validateNumber(input.val())) {
                    err = require_number;
                    valid = false; break;
                }
                break;
            case "decimal":
                if (!validateDecimal(input.val())) {
                    err = require_number;
                    valid = false; break;
                }
                break;
            case "date":
                if (!validateDate(input.val())) {
                    err = require_date;
                    valid = false; break;
                }
                break;
            case "ip":
                if (input.val() != "" && !validateIP(input.val())) {
                    err = require_number+' ej. 200.25.190.38';
                    valid = false; break;
                }
                break;
            case "phone":
                if (!validatePhone(input.val())) {
                    err = require_number+' ej. 446-2122-4555';
                    valid = false; break;
                }
                break;
            case "password":
                if (!validatePassword(input.val())) {
                    err = require_passw;
                    valid = false; break;
                }
                break;
            case "compare":
                if (!compareFields(input.val(), input.attr('rel'))) {
                    err = require_compare;
                    valid = false; break;
                }
                break;
        }
        if (err != "") {
            if(input.attr('plugin')=='jqtransform') input.parent().css(input_error); else input.css(input_error);
        }

    });

    return valid;
}

function prepareForm(formID) {
    $(formID + " :input").each(function() {
        var input = $(this);
        var defval = input.attr('default');
        if (defval != undefined) {
            input.val(defval);
        }

        if (input.attr('class') != undefined) {
            input.blur(function() { valRequired(input); });
        }
    });
}

function isValidate(formID) {
    var isValid = true;
    $(formID + " :input").each(function() {
        var input = $(this);
        if (input.attr('class') != undefined && !valRequired(input)) {
            isValid = false;
        }
    });

    return isValid;
}

$(document).ajaxError(function( event, request, settings, exception) {
	alert('Ha ocurrido un error interno en la aplicaci\xf3n. Por favor, int\xe9ntelo mas tarde.');
	console.log("url: " + settings.url);
	console.log("error: " + exception);
	console.log("data: " + request.responseText);
});
