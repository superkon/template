$(document).ready(function(){
  $(".btn_lang_select").bind("click", function(){
    var langfrom = $(this).attr("data-langfrom");
    var langto = $(this).attr("data-langto");
    location.href = location.href.replace("/"+langfrom+"/", "/"+langto+"/");

  });
  
  $("#contactusform .btn__send").bind("click", function(){
    var errmsg = "";

    var form_data = {};
    form_data.name = $("#name").val();
    form_data.phone = $("#phone").val();
    form_data.email = $("#email").val();
    form_data.remark = $("#remark").val();
    if ($(".btn_salutation.selected.male").length > 0 ){
      form_data.gender = "M";
    }else{
      form_data.gender = "F";
    }

		if ($.trim(form_data.name)==="")
		{
			errmsg+= js_lang.name_empty + "<br/>";
		}else if (!checkName($.trim(form_data.name))){
			errmsg+= js_lang.name_format + "<br/>";
		}

		if ($.trim(form_data.phone)==="")
		{
			errmsg+= js_lang.phone_empty + "<br/>";
		}else if ((!checkphone(form_data.phone))) {
			errmsg += js_lang.phone_format + "<br/>";
		}else if ($.trim(form_data.phone).length != 8){
			errmsg += js_lang.phone_format + "<br/>";
		}else if ($.trim(form_data.phone).substring(0, 3) === "999"){
			errmsg += js_lang.phone_format + "<br/>";
		}else if ($.trim(form_data.phone).substring(0, 1) != "2" && $.trim(form_data.phone).substring(0, 1) != "3" && $.trim(form_data.phone).substring(0, 1) != "5" && $.trim(form_data.phone).substring(0, 1) != "6" && $.trim(form_data.phone).substring(0, 1) != "8" && $.trim(form_data.phone).substring(0, 1) != "9"){
			errmsg += js_lang.phone_format + "<br/>";
		}

		if ($.trim(form_data.email)==="")
		{
			errmsg+= js_lang.email_empty + "<br/>";
		}else if (!emailCheck(form_data.email)){
			errmsg+= js_lang.email_format + "<br/>";
		}

    if (errmsg === ""){
			showLoading();
			loadServer("../api/submit.php", form_data, function(result){
				if (result.status == "1"){
					hideLoading();
					$("#contactusform")[0].reset();
          alertPopBox(js_lang.thanks);
				}else{
					alertPopBox(result.msg);
					hideLoading();
				}
			});
		}else{
			alertPopBox(js_lang.error_prefix+"<br/>"+errmsg);
		}
  });
});


function loadServer(url, data, callback){
	$.ajax({
		cache : false,
		url : url,
		dataType : 'json',
		type : 'post',
		async : true,
		data : data,
		success : function( result ){

			if (result.status === "1"){
				callback(result);
			}else{

				callback(result);
			}

		}
	});
}

function alertPopBox(msg){
	alert(msg);
}

function checkName (str){
    var iChars = "@~`!#$%^&*+=-[]\\\';,/{}|\":<>?0123456789";

    for (var i = 0; i < str.length; i++) {
       if (iChars.indexOf(str.charAt(i)) != -1) {
           return false;
       }
    }
    return true;
}

function checkphone (strString){
	var strValidChars = "0123456789";
	var strChar;
	var blnResult = true;
	if (strString.length === 0) return false;
		// test strString consists of valid characters listed above
	for (i = 0; i < strString.length && blnResult === true; i++){
		strChar = strString.charAt(i);
		if (strValidChars.indexOf(strChar) === -1){
			blnResult = false;
		}
	}
	return blnResult;
}

function emailCheck (emailStr) {

	var checkTLD=1;
	//  var knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/;
	var knownDomsPat=/^(.+)$/;
	var emailPat=/^(.+)@(.+)$/;
	var specialChars="~`!#$%^&*+=|'/,?"+"\\(\\)><@,;:\\\\\\\"\\.\\[\\]";
	var validChars="\[^\\s" + specialChars + "\]";
	var quotedUser="(\"[^\"]*\")";
	var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;
	var atom=validChars + '+';
	var word="(" + atom + "|" + quotedUser + ")";
	var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
	var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
	var matchArray=emailStr.match(emailPat);

	if (matchArray===null) {
		return false;
	}

	var user=matchArray[1];
	var domain=matchArray[2];

  var i;

	for (i=0; i<user.length; i++) {
		if (user.charCodeAt(i)>127) {
			return false;
		}
	}

	for (i=0; i<domain.length; i++) {
		if (domain.charCodeAt(i)>127) {
			return false;
		}
	}

	if (user.match(userPat)===null) {
		return false;
	}

	var IPArray=domain.match(ipDomainPat);
	if (IPArray!==null) {

		for (i=1;i<=4;i++) {
			 if (IPArray[i]>255) {
				return false;
			 }
		}
		return true;
	}

	var atomPat=new RegExp("^" + atom + "$");
	var domArr=domain.split(".");
	var len=domArr.length;

	for (i=0;i<len;i++) {
		if (domArr[i].search(atomPat)==-1) {
		  return false;
		}
	}

	if (checkTLD && domArr[domArr.length-1].length!=2 && domArr[domArr.length-1].search(knownDomsPat)==-1){
		return false;
	}

	if (len<2) {
		return false;
	}
	return true;
}
