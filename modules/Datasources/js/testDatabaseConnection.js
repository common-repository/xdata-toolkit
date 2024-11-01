function testDatabaseConnection(){
    var xmlhttpTDC;
    var dsType = document.getElementsByName("ds_type")[0];
    var dsTypeValue = dsType.options.selectedIndex;
    var dstV = dsType.options[dsTypeValue].value;
    //alert(dstV);
    
    if(dstV == 1){
        var ds_identifier = document.getElementById("ds_identifier").value;
        //alert(ds_identifier);
        var ds_username = document.getElementById("ds_username").value;
        //alert(ds_username);
        var ds_password = document.getElementById("ds_password").value;
        //alert(ds_password);
        var ds_port = document.getElementById("ds_port").value;
        //alert(ds_port);
        var ds_host_url = document.getElementById("ds_host_url").value;
        //alert(ds_host_url);
        var DSName = document.getElementById("ds_name").value;
        //alert(DSName);
        
        //alert("Hello");
        if (window.XMLHttpRequest)
        {   // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttpTDC=new XMLHttpRequest();
        }
        else
        {   // code for IE6, IE5
            xmlhttpTDC=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttpTDC.onreadystatechange=function()
        {
            if (xmlhttpTDC.readyState==4 && xmlhttpTDC.status==200)
            {
                   //alert(xmlhttpTDC.responseText);
                   if(xmlhttpTDC.responseText == 1)
                   {
                        alert("Connection Successful");
                        //document.getElementById("sds").disabled = false;                        
                   }else{
                        alert("Could not connect to database.  Please check your data source connection parameters.");
                   }
            }
        }
        
        var url = "/xdatatest/wp-content/plugins/xdata-toolkit/modules/Datasources/testDataSourceConnection.php?";
        url = url + "ds_type="+dstV;
        url = url + "&ds_identifier="+encodeURIComponent(ds_identifier);
        url = url + "&ds_username="+encodeURIComponent(ds_username);
        url = url + "&ds_password="+encodeURIComponent(ds_password);
        url = url + "&ds_port="+encodeURIComponent(ds_port);
        url = url + "&ds_host_url="+encodeURIComponent(ds_host_url);
        url = url + "&DSName="+encodeURIComponent(DSName);
        
        //alert("URL is "+url);
        xmlhttpTDC.open("GET",url,true);
        xmlhttpTDC.send();
        //alert(xmlhttp.responseText);
        //document.getElementById("queryResults").innerHTML=xmlhttp.responseText;
    }else
    {
        document.getElementById("sds").disabled = false;
    }
}