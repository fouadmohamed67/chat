$(document).ready(function(){
    
    get_user();
    last_seen();
    scroll_top();
    
    
  
        
    setInterval(function(){
        last_seen(),
        get_user(),
         
        realtime();

    },3000);
    function get_user()
    {
        $.ajax({
            url:'get_user.php',
            method:"POST",
            success:function(data){
                $('#user_info').html(data);
            }
        })
    }

    function last_seen()
    {
        $.ajax({
            url:'update_last_seen.php',
            
            success:function(data){
                
            }
        })

    }
    //for scroll top
    function scroll_top()
    {
         
 
        var height = 0;
        $('.chat_history ul li').each(function(i, value){
            height += parseInt($(this).height())+20;
        });
        
        height += '';
        $('.chat_history').scrollTop(height,2000);
       
        
          
         
    }
    function make_pop_div_message(to_user_id,to_user_name)
    {
      
        var content='<div class="card-header head-chat text-center">'+to_user_name+'</div>';
         content+= '<div id="user_dialog_'+to_user_id+'"class="user_dialog" title="'+to_user_name+ '">';
        content+= '<div style="   height: 350px; border: 1px solid #CCC; overflow-y: scroll;   padding: 20px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
        content+= get_old_chat(to_user_id);
        content+="</div>";

        content+='<div class="form-group">';
        content+='<textarea placeholder="your message" id="chat_message_'+to_user_id+'"class="form-control text_ar"></textarea> ';
    
        content+='<button name="send_message" id="'+to_user_id+ '" class="btn btn-info send_message" >send</button>';
        $('#user_chat').html(content);
        scroll_top();
       
         


    }
    $(document).on('click','.start_chat',function(){

        
         scroll_top();
        
        
        
        
});

    $(document).on('click','.start_chat',function(){

        
            var to_user_id=$(this).attr('data-id');
            var to_user_name=$(this).attr('data-name');
            
          
            make_pop_div_message(to_user_id,to_user_name);
           
            $('#chat_message_'+to_user_id).emojioneArea({
                picKerPosition:"top",
                toneStyle:"bullet"
            });
            
            
            
            
    });

    $(document).on('focus','.text_ar',function(){
   
        $.ajax({
            url:'updat_is_typing.php',
            method:"POST",
            data:{is_typing:1},
            
            success:function(data){
                
            }
        }) 

    });
   
   
    
 

     
      
  
       
       



    $(document).on('blur','.text_ar',function(){
      
        $.ajax({
            url:'updat_is_typing.php',
            method:"POST",
            data:{is_typing:0},
            
            success:function(data){
                
            }
        }) 

    });


    $(document).on('click','.send_message',function(){

        scroll_top();
        var to_user_id=$(this).attr('id');

        var message=$('#chat_message_'+to_user_id).val();
        if(message =="")
        {
            return false;
        }
        else
        {
            
            $.ajax({


                url:"insert_message.php",
                method:"POST",
                data : {to_user_id:to_user_id,message:message},
                success:function(data)
                {
                   var area_of_emoje=  $('#chat_message_'+to_user_id).emojioneArea();
                   area_of_emoje[0].emojioneArea.setText('');
                   $('#chat_history_'+to_user_id).html(data);
                    
                }
            })
            
        }
         
        
     });
    
     // to get messages when open 
       function get_old_chat(to_user_id)
       {
           $.ajax({
            url:"get_old_chat.php",
            method:"POST",
            data:{to_user_id:to_user_id},
            success:function(data)
            {
                
               $('#chat_history_'+to_user_id).html(data);
                
            }
           });
           
       }

        //real time
     function realtime()
     {
         $('.chat_history').each(function(){
            var to_user_id=$(this).attr('data-touserid');
            get_old_chat(to_user_id);
            
         });
     }
     
});