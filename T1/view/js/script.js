/* 
 * 
 *     Author: Daniel Rodrigues
 * 
 */

// AJAX
$(document).ready(function(){
    
    // Criar nova nota
    $(document).on('click', '#btn_new', function(){
        
        var action = "new";
        
        $.post("index.php",
            {
                "action": action,
            },
            function(){
                $("#note-title").val("");
                $("#note-tags").val("");
                $("#note-content").val("");
                console.log("success [new]");      
            }
        );
    });
    
    // Salvar nota
    $(document).on('click', '#btn_save', function(){
        
        var action = "save";
        var title = $('#note-title').val();
        var tag = $('#note-tags').val();
        var content = $('#note-content').val();

        $.post("index.php",
            {
                "action": action,
                "title": title,
                "tag_list": tag,
                "content": content,
            },
            function(data){
                console.log("success [" + action + "]");
                console.log("result {\n" + data + " \n}");
            }
        );
    });
    
    // Carregar notas do usuário
    $(document).on('click', '#btn_folder', function (){
                
        var action = "load";
        
        $.post("index.php",
        {
            "action": action,
        },     
        ).done(function(data, response){
            console.log(response + "[" + action + "]");
            console.log("data2: " + data);
            var result = JSON.parse(data);
            var i = 0;
            var html = '';

            while(i<Object.keys(result).length){
                var title = result[i]['title'];
                var id = result[i]['note_id'];
                
                html += '<div class="loaded-note" data-id="' + id + '">' +
                    "<span class='delete'><a class='fa fa-close' style='font-size:14px'></a></span>" +
                    "<b> " + title + "</b>" +
                    "</div>";
                i++;
            }
            $('#search-result').html(html);
        }).fail(function(){
            console.log("error [" + action + "]");
        });
    });
    
    // Exibir nota selecionada
    $(document).on('click', '.loaded-note', function (){
        
        var id = $(this).data('id');
        var action = "getNote";
        $.post("index.php",
        {
            action: action,
            note_id: id,
        },
        ).done(function(data){
            console.log("success [" + action + "]");
            //console.log("result {\n" + data + " \n}");
            
            var result = JSON.parse(data);
            
            var title = result[0]['title'];
            var content = result[0]['content'];
            
            $("#note-title").val(title);
            $("#note-content").val(content);
        }).fail(function(){
            console.log("error [" + action + "]");
        });
    });
    
    // Deletar nota
    $(document).on('click', '.delete', function(){
                
        var id = $(this).parent().data('id');
        var action = "delete";
        
        $clicked_btn = $(this);

        $.post("index.php",
        {
           action: action,
           note_id: id,
        }).done(function(){
            console.log("success [" + action + "]");
            $clicked_btn.parent().remove();
            $('#title').val('');
            $('#content').val('');
        });
    });
    
    // Abrir janela de cadastro
    $(document).on('click', '#btn_cadastrar', function(){
        $('#box_cadastrar').css("display","flex");
        $('#box_cadastrar').css("width","auto");
    });
    
    // Fechar janela de cadastro
    $(document).on('click', '#btn_cancel', function(){
        $('#box_cadastrar').css("display","none");
        $('#box_cadastrar').css("width","0");
        $('#btn_sgnp').css("background-color","royalblue");
        $('#btn_sgnp').html("Cadastrar");
    });
    
    // Fazer login
    $(document).on('click', '#btn_login', function(){
        var action = 'entrar'
        var usuario = $('#input_username').val();
        var senha = $('#input_password').val();
        
        if(usuario !== '' || senha !== ''){
            $.post("index.php",
            {
                action: action,
                usuario: usuario,
                senha: senha,
            }).done(function(data){
                console.log("data: " + data);
                if(data === 'false'){
                    $('#error_msg2').html("Algo deu errado, tente novamente");
                    $('#error_msg2').css("color","indianred");
                    $('#error_msg2').css("margin-top","0px");
                    $('#error_msg2').css("margin-bottom","0px");
                } else{
                    $.post("index.php",
                    {
                        action: "notes",
                    });
                }
            });
        } else{
            $('#error_msg2').html("Algo deu errado, tente novamente");
            $('#error_msg2').css("color","indianred");
            $('#error_msg2').css("margin-top","0px");
            $('#error_msg2').css("margin-bottom","0px");
        }
    });
    
    // Cadastrar usuário
    $(document).on('click', '#btn_sgnp', function(){
        
        var action = 'cadastrar'
        var usuario = $('#cad_user').val();
        var email = $('#cad_email').val();
        var senha1 = $('#cad_pass1').val();
        var senha2 = $('#cad_pass2').val();
        
        if(senha1 === senha2){
            $.post("index.php",
            {
                action: action,
                usuario: usuario,
                email: email,
                senha: senha1,
            }).done(function(data, response){
                console.log("data: " + data);
                console.log("response: " + response);
                if(data === 'false'){
                    $('#btn_sgnp').css("background-color","indianred");
                    $('#btn_sgnp').html("Tentar novamente");
                    $('#error_msg').html("Algo deu errado, tente novamente");
                    $('#error_msg').css("color","indianred");
                } else {
                    $('#btn_sgnp').css("background-color","lightgreen");
                    $('#btn_sgnp').html("Sucesso!");
                }
            });
        }
    });
});