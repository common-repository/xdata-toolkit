function loadXMLDoc(){
    var xmlhttp;
    var qi = document.getElementsByName("queryInterface")[0];
    var qiValue = qi.options.selectedIndex;
    var qiV = qi.options[qiValue].value;
    var linkedItem  = "no";
    if(document.getElementById("linked_item").checked)
    {
        linkedItem = "yes";   
    }
    var page = document.getElementById("page").value;
    var element_name = document.getElementById("element_name").value;    
    //alert("Hello");
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
                document.getElementById("queryResults").innerHTML=xmlhttp.responseText;
        }
    }
    //var url = "http://www.buildautomate.com/structure.txt";
    var plugin_url = document.getElementById("plugin_url").value;
    var url = plugin_url+"/xdata-toolkit/editor/getQueryResults.php?";
    
    url = url + "queryInt="+qiV;
    url = url + "&type=page";
    url = url + "&page="+page;
    url = url + "&element="+element_name;
    url = url + "&linked_item="+linkedItem;
    //alert("URL is "+url);
    xmlhttp.open("GET",url,false);
    xmlhttp.send();
    //document.getElementById("queryResults").innerHTML=xmlhttp.responseText;
}
function selectQueryInterface()
{
    var checked = false;
    var qi = document.getElementsByName("queryInterface")[0];
    var qiValue = qi.options.selectedIndex;
    var qiV = qi.options[qiValue].value;
    
    var linkedItem  = "no";
    //alert(document.getElementsByName("linked_item").value);
    if(document.getElementById("linked_item").checked)
    {
        linkedItem = "yes";   
    }
    var page = document.getElementById("page").value;
    var element_name = document.getElementById("element_name").value;       
    
    var queryInterfaceValue = "[xdataqueryinterface ";
    queryInterfaceValue     = queryInterfaceValue + " queryint=\"";
    queryInterfaceValue     = queryInterfaceValue + qiV;
    queryInterfaceValue     = queryInterfaceValue + "\"";
    queryInterfaceValue     = queryInterfaceValue + " type=\"page\"";
    queryInterfaceValue     = queryInterfaceValue + " linked_item=\"";
    queryInterfaceValue     = queryInterfaceValue + linkedItem;
    queryInterfaceValue     = queryInterfaceValue + "\"]";
    
    var win = window.dialogArguments || opener || parent || top;
    win.send_to_editor(queryInterfaceValue);
}
