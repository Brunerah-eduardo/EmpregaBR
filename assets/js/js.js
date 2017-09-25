$(document).ready(function(){
    
    $(".newVaga").click(function(){
        var id = $(this).attr('id');
        console.log(id);
        $(".container").each(function(){
            var idcon = $(this).attr('id');
            if(idcon === id){
                $(this).show();
            }
        });
    });
    
    $(".submitValues").click(function(){
        var array = new Array();
        $(".avancacandidato").each(function(){
            if($(this).prop("checked")){
                var valor = {};
                
                var id = $(this).val();
                valor["id"] = id;   
                $(".container").each(function(){
                    var idcon = $(this).attr('id');
                    if(idcon === id){
                        valor["avaliacao"] = $("#"+idcon+" input[name=avaliacao]").val();    
                        valor["comentario"] = $("#"+idcon+" input[name=comentario]").val();    
                        array.push(valor);
                    }
                });
            }
            
        });
        console.log(array);
    });
    
    $(".avancacandidato").change(function(){
        var id = $(this).val();
        $(".container").each(function(){
            var idcon = $(this).attr('id');
            if(idcon === id){
                
                $(this).toggle();
            }
        });
    });
    
    $(".selecionarTodos").click(function(){
        $(".candidatosID").children().children().each(function(){
            $(this).children().each(function(){
                $(this).children().each(function(){
                    if($(this).attr("type") == 'submit'){
                        
                    }else{
                        $(this).prop('checked', true); 
                    }
                    
                });
            });
            
            
        });
    });
    
    $(".adicionar").click(function(){
        var array = [];
        $('.curso-container input').each(function(){
            if($(this).attr('class') == 'submit'){
                $(this).val("Adicionar");
            }else{
                $(this).val("");
            }
            
        });
    });
    
    $('.editar').click(function(){
        var array = [];    
        var i = 0;
        $(this).parent().children().each(function(){
            array.push($(this).text());
        });
        $('.curso-container input').each(function(){
            if($(this).attr('class') == 'submit'){
                $(this).val("Editar");
            }else{
                $(this).val(array[i]);
                i++;
            }
            
        });
    });
    
    $(".deletar").click(function(){
        var array = [];    
        var i = 0;
        $(this).parent().children().each(function(){
            array.push($(this).text());
        });
        $('.curso-container input').each(function(){
            if($(this).attr('class') == 'submit'){
                $(this).val("Deletar");
            }else{
                $(this).val(array[i]);
                i++;
            }
            
        });
    });
});