$(document).ready(function(){
var toUserId=""
    $("#message_form_text").keypress(function(event){
        if (event.which==13){
        
            $.post( `/mensaje/enviar/${toUserId}`, $(this).serialize())
            $(this).val("")
            
        }
    })

    $(".contact").on("click", function (){
        $("#messages").html("")
        var idUsuario=($('#user').data("user-id"))
        toUserId = $(this).data("id")
        $.getJSON( `/mensaje/${$(this).data("id")}`,function(data){
            var items = [];
            $.each( data, function( index, elemento ) {
                var mensajeOtro =  `<div class="flex mb-2">
                                    <div class="rounded py-2 px-3" style="background-color: #F2F2F2">
                                        <p class="text-sm text-teal">
                                        ${elemento.from_user_name}
                                        </p>
                                        <p class="text-sm mt-1">
                                        ${elemento.text}
                                        </p>
                                        <p class="text-right text-xs text-grey-dark mt-1">
                                        ${elemento.timestamp.date}
                                        </p>
                                     </div>
                                    </div>`
                                            
                var mensajeMio= `<div class=" misMensajes flex justify-end mb-2">
                                    <div class="rounded py-2 px-3" style="background-color: #E2F7CB">
                                        <p class="text-sm mt-1">
                                        ${elemento.text}
                                        </p>
                                        <p class="text-right text-xs text-grey-dark mt-1">
                                        ${elemento.timestamp.date}
                                        </p>
                                    </div>
                                </div>`
                            

                if(elemento.from_user_id == idUsuario){
                $('#messages').append(mensajeMio)
                }else{
                    $('#messages').append(mensajeOtro)
                }
               
            });
            
        } );

    })

})

