$('.dragViews').draggable();

/**SABER CUANTOS ELEMENTOS HAY DE LA MIS CLASE */
var tables = document.getElementsByClassName("views").length;
for(var i = 0;i<tables;i++){

    $("#view"+i+" tr").click(function(){
        $(this).addClass('selected').siblings().removeClass('selected');    
        var value=$(this).find('td:first').html();
        alert(value);  
        var value2=$("#view"+i+" thead").find('th:first').html();
        console.log(value2);
     });
    
    
}

