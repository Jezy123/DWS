$(document).ready(function(){

    
var toUserId=""
    $("#message_form_text").keypress(function(event){
        if (event.which==13){
 
            $.post( `/mensaje/enviar/${toUserId}`, $(this).serialize())
            $(this).val("")
            
        }
    })

    $(".contact").on("click", function cargar(){
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

	//Open a WebSocket connection.
	websocket = new WebSocket("ws://localhost:9000/");

    //Connected to server
	websocket.onopen = function(ev) {
		console.log('Connected to server ');
        //prepare json data
        var msg = {
            type: 'chatData',
            fromUserId: ($('#user').data("user-id")),
            toUserId:'',
        };
        //convert and send data to server
        websocket.send(JSON.stringify(msg));
	}

    //Connection close
	websocket.onclose = function(ev) {
    	console.log('Disconnected');
    };
    websocket.onmessage = function(evt) {
        var response = JSON.parse(evt.data); //PHP sends Json data
        //hacer lo que corresponda con response
        console.log(response)
        
        if(response.message.type=="chatmsg"){

            var mensajeOtro =  `<div class="flex mb-2">
            <div class="rounded py-2 px-3" style="background-color: #F2F2F2">
                <p class="text-sm text-teal">
                ${response.message.fromUserName}
                </p>
                <p class="text-sm mt-1">
                ${response.message.text}
                </p>
                <p class="text-right text-xs text-grey-dark mt-1">
                ${response.message.timestamp.date}
                </p>
             </div>
            </div>`
                    
            var mensajeMio= `<div class=" misMensajes flex justify-end mb-2">
                    <div class="rounded py-2 px-3" style="background-color: #E2F7CB">
                        <p class="text-sm mt-1">
                        ${response.message.text}
                        </p>
                        <p class="text-right text-xs text-grey-dark mt-1">
                        ${response.message.timestamp.date}
                        </p>
                    </div>
                </div>`
    
            if(response.message.fromUserId==($('#user').data("user-id"))){
            $('#messages').append(mensajeMio)
        
            }else{
                $('#messages').append(mensajeOtro)
            }
         
        }
    }

    //Error
	websocket.onerror = function(ev) {
    	console.log('Error '+ev.data);
    };


})


