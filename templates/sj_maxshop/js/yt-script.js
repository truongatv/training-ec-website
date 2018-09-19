// JavaScript Document
function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(c_name, defaultvalue){	//alert(document.cookie);
	var i,x,y,arrcookies=document.cookie.split(";");
	for (i=0;i<arrcookies.length;i++){
	  x=arrcookies[i].substr(0,arrcookies[i].indexOf("="));
	  y=arrcookies[i].substr(arrcookies[i].indexOf("=")+1);
	  x=x.replace(/^\s+|\s+$/g,"");
	  if (x==c_name){
		  return unescape(y);
	  }
	}
	return defaultvalue;
}

jQuery(document).ready(function(){
	// Resonsive Header Top
    jQuery(".btn-search-mobile .expander").click(function (e) {
        var collapse_content_selector = jQuery(this).attr("href");
        var expander = jQuery(this);
		
        if (!jQuery(collapse_content_selector).hasClass("open")) {
			expander.addClass("open").html("<i class='fa fa-times'></i>") ;
		}
		else expander.removeClass("open").html("<i class='fa fa-search'></i>");
		
		if (!jQuery(collapse_content_selector).hasClass("open")) jQuery(collapse_content_selector).addClass("open").slideDown("normal");
        else jQuery(collapse_content_selector).removeClass("open").slideUp("normal");
        e.preventDefault()
    })
})





