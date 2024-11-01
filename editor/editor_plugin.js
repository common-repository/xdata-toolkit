function tiny_plugin()
{
    //alert("Going to Display Query Interface");
    var plugin_url = document.getElementById("plugin_url").value;
    var url = plugin_url+'/xdata-toolkit/editor/editor-plugin.js.php';
    mywindow = window.open(url, "mywindow", "location=0,status=0,scrollbars=0,  width=300,height=400");
    mywindow.moveTo(500, 150);

}
                        
function loadXMLDoc()
{
    var xmlhttp;
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            //alert(xmlhttp.responseText);
        }
      }
    var plugin_url = document.getElementById("plugin_url").value;
    var url = plugin_url + "/xdata-toolkit/editor/editor-plugin.js.php";
    xmlhttp.open("GET",url,false);
    xmlhttp.send();
    return xmlhttp.responseText;
}                        

(function() {
    tinymce.create('tinymce.plugins.tinyplugin', {
 
        init : function(ed, url){
            ed.addButton('tinyplugin', {
            title : 'Insert QueryInterface',
                onclick : function() {
                    ed.execCommand(
                    'mceInsertContent',
                    false,
                    tiny_plugin()
                    );
                },
                image: url + "/images/dbadd-small.png"
            });
        }
    });
 
    tinymce.PluginManager.add('tinyplugin', tinymce.plugins.tinyplugin);
 
})();
