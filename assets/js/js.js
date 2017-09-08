$(document).ready(function(){
    
    $(".candidatar").click(function(){
        var id = $(this).val();
        alert(id);
    });
    
    $('.edit').click(function(){
        var array = [];    
        var i = 0;
        $(this).parent().parent().children().each(function(){
            
            if($(this).attr('class') === 'lasttd'){
            }else{
                array.push($(this).text());
            }
        });
        $('#experiencia input').each(function(){
            if($(this).attr('input["submit"')){
                
            }else{
                $(this).val(array[i]);
                i++;
            }
            
        });
    });
    
    $(".delete").click(function(){
        var id = $(this).data('value');
        alert(id);
    });
});