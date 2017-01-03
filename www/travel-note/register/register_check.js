var id_num = 0; 
var email_num  = 0;
 
function CheckUserName(){
    var userid  = document.getElementById('userid');

    if(userid.value.length >= 4)
    {
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari 
          xmlhttp=new XMLHttpRequest();
		  xmlhttp.overrideMimeType('text/xml');
        }
        else
        {// code for IE6, IE5 
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
			    var check = xmlhttp.responseText;
				//document.getElementById('test').innerHTML = check.length;
					
				if(check.length == 332)
                {
					document.getElementById('ErrorSpan').innerHTML=""; 
					userid.className = "inputOK";
					id_num  = 1 ;

                }				
                else
                {	
					document.getElementById('ErrorSpan').innerHTML="此帳號已被人註冊!" ; 
					userid.className = "inputERROR";		

                }
				
				//document.getElementById('checkdiv').innerHTML = userid.value + check  ;

            }
         }
         xmlhttp.open("GET","check_ID.php?q="+userid.value,true); 
         xmlhttp.send(); 
     } 
	 if(userid.value != "" && userid.value.length < 4){
		 document.getElementById('ErrorSpan').innerHTML="請輸入長一點的帳號喔!";
		 userid.className="inputERROR";
		}
 } 
 
 
function CheckUserEmail(){
var email  = document.getElementById('email');
var emailRegxp = /^([\w]+)(.[\w]+)*@([\w]+)(.[\w]{2,3}){1,2}$/;

if(email.value!=""){
	if(emailRegxp.test(email.value) == true){
		//信箱格式正確
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari 
          xmlhttp=new XMLHttpRequest();
		  xmlhttp.overrideMimeType('text/xml');
        }
        else
        {// code for IE6, IE5 
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
              
			    var check_email = xmlhttp.responseText;
			   // document.getElementById('test').innerHTML = check_email.length;
             
				
				if(check_email.length == 362)
                {
					document.getElementById('ErrorSpan_EMAIL').innerHTML=""; 
					email.className="inputOK";
					email_num  = 1;
                }				
                else
                {	
					document.getElementById('ErrorSpan_EMAIL').innerHTML="此信箱已被人註冊!";  
					email.className="inputERROR";
				}

             }
         }
         xmlhttp.open("GET","check_email.php?e="+email.value,true); 
         xmlhttp.send(); 
     } 
	 else{
		 document.getElementById('ErrorSpan_EMAIL').innerHTML="信箱格式不正確喔!"; }
 } 
else{
	 document.getElementById('ErrorSpan_EMAIL').innerHTML="信箱為必填!"; 
}
}

function CheckPW(){
	var pw = document.getElementById('password');
	if(pw.value!=""){
		pw.className="inputOK";
	}
	else {pw.className="";}
}
  
function SendForm(){
	var password = document.getElementById('password');
	if( password.value != ""  && id_num + email_num  == 2){ 
	document.getElementById('userid').className="inputOK"; 
	document.getElementById('password').className="inputOK";
	document.getElementById('email').className="inputOK"; 
	//submit
	document.register.submit();
	}
	
	if(password.value == "" && id_num + email_num  == 2){
		password.focus();
		document.getElementById('ErrorSpan_pw').innerHTML="密碼為必填!"; 
		document.getElementById('password').className="inputERROR";
	}
	
	if(password.value == "" && id_num + email_num  == 0){
		document.getElementById('userid').className="inputERROR"; 
		document.getElementById('password').className="inputERROR";
		document.getElementById('email').className="inputERROR"; 
	}
	
	/*
	if(email_num  == 0 && id_num  == 1){
	document.getElementById('ErrorSpan_send').innerHTML="信箱部分有錯喔，麻煩改一下!"; 
	}
	
	if(id_num  == 0 && email_num  == 1){
	document.getElementById('ErrorSpan_send').innerHTML="帳號部分有錯喔，麻煩改一下!"; 
	}
	
	if(id_num  + email_num  == 0){
	document.getElementById('ErrorSpan_send').innerHTML="帳號&信箱都有錯喔，麻煩改一下!"; 
	}
	*/
}

function resetClass(){
	document.getElementById('userid').className=""; 
	document.getElementById('password').className="";
	document.getElementById('email').className=""; 
}