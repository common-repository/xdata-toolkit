function sort(colName)
{
	document.getElementById("sortBy").value = colName;
	document.getElementById("update").value = "View";		
	document.forms["myform"].submit();
}
function highlightChange(itm)
{
	alert("HIGHLIGHTING");	    
	if(itm == null)
	{}else
	  {
	      alert("HIGHLIGHTING ELEMENT "+elemToHighlight);	    
	      var elemToHighlight = "row"+itm;
	      document.getElementById(elemToHighlight).style.background = "#CCFFFF";
	  }		
}					   
function saveTransformDocument()
{
    if(confirm("You are about to save this document "+document.getElementById("transform_name").value+" as "+document.getElementById("transform_file_name").value+".  Please click OK to save."))
    {
	if(document.getElementById("transform_file_name").value == "No Transform")
	{
	        warnNoTransform();
	}else{
	    
	    startLoad();
	    saveTransformDoc();	    
	}
    }
}
function warnNoTransform()
{
    alert("You first must register and upload a transform first or dynamically generate a stylesheet from the Add Function, then associate it with a Query Interface in order to modify it in TransformStudio.");
}
function saveTransformDoc()
{   
    var xmlhttp;
    //Send the proper header information along with the request

    if (window.XMLHttpRequest)
    {   // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {   // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {		
		alert(xmlhttp.responseText);
		stopLoad();
		
                //var $tabs = $('#tabvanilla').tabs(); // first tab selected
                //$tabs.tabs('select', 0);
		//var colName = document.getElementById("sortBy").value;
		//sort(colName);				
		
        }
    }
    var plugin_url = document.getElementById("plugin_url").value;
    
    var url = plugin_url+"/xdata-toolkit/modules/TransformStudio/saveTransform.php";
    
    var xslFilename = encodeURIComponent(document.getElementById("transform_file_name").value);
    var xslName = encodeURIComponent(document.getElementById("transform_name").value);    
    var xsldata=encodeURIComponent(document.getElementById("xsldata").value);
    var parameters="transform_file_name="+xslFilename+"&transform_name="+xslName+"&xsldata="+xsldata;
    
    xmlhttp.open("POST",url,false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", parameters.length);
    xmlhttp.setRequestHeader("Connection", "close");
    xmlhttp.send(parameters);
}
function saveGenTransformDoc()
{   
    var xmlhttp;
    //Send the proper header information along with the request

    if (window.XMLHttpRequest)
    {   // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {   // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {		
		alert(xmlhttp.responseText);
		stopLoad();
		
                var $tabs = $('#tabvanilla').tabs(); // first tab selected
                $tabs.tabs('select', 0);
		var colName = document.getElementById("sortBy").value;
		sort(colName);		
        }
    }
    var plugin_url = document.getElementById("plugin_url").value;
    
    var url = plugin_url+"/xdata-toolkit/modules/TransformStudio/saveGenTransform.php";
    
    var queryInterface = encodeURIComponent(document.getElementById("g_queryInterface").value);    
    var xslFilename = encodeURIComponent(document.getElementById("g_transform_file_name").value);
    var xslName = encodeURIComponent(document.getElementById("g_transform_name").value);    
    var xsldata=encodeURIComponent(document.getElementById("g_xsldata").value);
    var parameters="transform_file_name="+xslFilename+"&transform_name="+xslName+"&xsldata="+xsldata+"&queryInterface="+queryInterface;
    
    xmlhttp.open("POST",url,false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", parameters.length);
    xmlhttp.setRequestHeader("Connection", "close");
    xmlhttp.send(parameters);
}
function genStylesheet()
{   
    var xmlhttp;
    //Send the proper header information along with the request

    if (window.XMLHttpRequest)
    {   // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {   // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {		
		document.getElementById("g_xsldata").innerHTML=xmlhttp.responseText;
	    
        }
    }
    var plugin_url = document.getElementById("plugin_url").value;
    
    var url = plugin_url+"/xdata-toolkit/modules/TransformStudio/generateStylesheetFromXML.php";
    
    var queryInterface = encodeURIComponent(document.getElementById("g_queryInterface").value);
    var parameters="queryInterface="+queryInterface;
    
    xmlhttp.open("POST",url,false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", parameters.length);
    xmlhttp.setRequestHeader("Connection", "close");
    xmlhttp.send(parameters);
}
function getXSLName(){
    
    var xmlhttpName;
    var qi = document.getElementsByName("queryInterface")[0];
    var qiValue = qi.options.selectedIndex;
    var qiV = qi.options[qiValue].value;
    
    var linkedItem  = "no";

    if (window.XMLHttpRequest)
    {   // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttpName=new XMLHttpRequest();
    }
    else
    {   // code for IE6, IE5
        xmlhttpName=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttpName.onreadystatechange=function()
    {
        if (xmlhttpName.readyState==4 && xmlhttpName.status==200)
        {
		//alert(xmlhttpName.responseText);
		var j = xmlhttpName.responseText;
		var a=j;
		ar=a.split("^");
		var first=ar[0];
		var second=ar[1];

		document.getElementById("transform_file_name").value=ar[0];
                document.getElementById("transform_name").value=ar[1];                     
        }
    }
    var plugin_url = document.getElementById("plugin_url").value;
    
    var url = plugin_url+"/xdata-toolkit/modules/TransformStudio/getQueryInterfaceTransformInfo.php?";
    url = url + "queryInt="+qiV;

    xmlhttpName.open("GET",url,false);
    xmlhttpName.send();
    
}
function register(){

    var resp = confirm("Would you like to generate an XSL Stylesheet from an XSL Source?  If not, then you will be presented with a form to register and upload your transform.");
    var url = "";
    
    if(resp == true){
	//alert("Register URL will be generateStylesheet.xsl");
	url = document.getElementById("genSSURL").value;		
    }else
    {
	//alert("Register URL will be registerTransform");
	url = document.getElementById("registerURL").value;	
    }
    var xmlhttpTransformRegister;

    if (window.XMLHttpRequest)
    {   // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttpTransformRegister=new XMLHttpRequest();
    }
    else
    {   // code for IE6, IE5
        xmlhttpTransformRegister=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttpTransformRegister.onreadystatechange=function()
    {
        if (xmlhttpTransformRegister.readyState==4 && xmlhttpTransformRegister.status==200)
        {
		//alert(xmlhttpDataRegister.responseText);
		document.getElementById("registerTransform").innerHTML=xmlhttpTransformRegister.responseText;

                var $tabs = $('#tabvanilla').tabs(); // first tab selected
                
                $tabs.tabs('select', 6);                     
        }
    }

    xmlhttpTransformRegister.open("GET",url,false);
    xmlhttpTransformRegister.send();
		
}

function saveTransform()
{   
    var xmlhttp;
    //Send the proper header information along with the request

    if (window.XMLHttpRequest)
    {   // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {   // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
		
		document.getElementById("transformRegistration").innerHTML=xmlhttp.responseText;
		alert(xmlhttp.responseText);
		
                var $tabs = $('#tabvanilla').tabs(); // first tab selected
                $tabs.tabs('select', 0);
		var colName = document.getElementById("sortBy").value;
		sort(colName);
        }
    }
    
    var url = document.getElementById("saveURL").value;
    document.getElementById("update").value = "Save";				    
    
    var transform_id 		= document.getElementById("e_transform_id").value;
    var transform_name 		= document.getElementById("e_transform_name").value;    
    var transform_file 		= document.getElementById("e_transform_file").value;    

    var update = encodeURIComponent(document.getElementById("update").value);    
    var parameters="transform_id="+transform_id+"&transform_name="+transform_name+"&transform_file="+transform_file+"&update="+update;
    
    xmlhttp.open("POST",url,false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");    
    xmlhttp.setRequestHeader("Content-length", parameters.length);
    xmlhttp.setRequestHeader("Connection", "close");
    
    xmlhttp.send(parameters);
}
function saveNewTransform()
{    
    document.getElementById("update").value = "Save Transform";		
    document.forms[0].submit();
}
function deleteTransform()
{   
    var xmlhttpDel;
    //Send the proper header information along with the request

    if (window.XMLHttpRequest)
    {   // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttpDel=new XMLHttpRequest();
    }
    else
    {   // code for IE6, IE5
        xmlhttpDel=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttpDel.onreadystatechange=function()
    {
        if (xmlhttpDel.readyState==4 && xmlhttpDel.status==200)
        {
		
		document.getElementById("transformRegistration").innerHTML=xmlhttpDel.responseText;
		alert(xmlhttpDel.responseText);
		
                var $tabs = $('#tabvanilla').tabs(); // first tab selected
                $tabs.tabs('select', 0);
		var colName = document.getElementById("sortBy").value;
		sort(colName);
        }
    }
    
    var url = document.getElementById("deleteURL").value;
    document.getElementById("update").value = "Save";				    
    var transform_id 		= document.getElementById("e_transform_id").value;
    var transform_file 		= document.getElementById("e_transform_file").value;
    
    var update = encodeURIComponent(document.getElementById("update").value);    
    var parameters="e_transform_id="+transform_id+"&e_transform_file="+transform_file;
    
    xmlhttpDel.open("POST",url,false);
    xmlhttpDel.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttpDel.setRequestHeader("Content-length", parameters.length);
    xmlhttpDel.setRequestHeader("Connection", "close");
    
    xmlhttpDel.send(parameters);
}
function edit(itm)
{   
    var xmlhttp;
    //Send the proper header information along with the request

    if (window.XMLHttpRequest)
    {   // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {   // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
		document.getElementById("transformRegistration").innerHTML=xmlhttp.responseText;
                var $tabs = $('#tabvanilla').tabs(); // first tab selected
                $tabs.tabs('select', 1);

        }
    }
    
    var url = document.getElementById("editURL").value;

    document.getElementById("itemToModify").value = itm;
    document.getElementById("update").value = "Edit";				    
    
    var itemToModify = encodeURIComponent(document.getElementById("itemToModify").value);
    var update = encodeURIComponent(document.getElementById("update").value);    
    var parameters="update="+update+"&itemToModify="+itemToModify;
    
    xmlhttp.open("POST",url,false);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", parameters.length);
    xmlhttp.setRequestHeader("Connection", "close");
    
    
    xmlhttp.send(parameters);
}
