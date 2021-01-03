<?php
   session_start();
   include "connect.php";
   include "function.php";
   $query= "SELECT * FROM users WHERE ID !='" . $_SESSION['id']."' ";
   $state=$conn->prepare($query);
   $state->execute();
   $all_users=$state->fetchAll();

    ?>
    <div class="all_users">
      <div class="card-header">
        friends
      </div>

    
    <?php
   foreach($all_users as $user)
   {
     
       $dt = new DateTime('', new DateTimeZone('Africa/Cairo'));
       $current_time =$dt->format('Y-m-d H:i:s');
       
      $current_time= date("Y-m-d H:i:s", strtotime($current_time) - 10);
      
        
       $user_last_seen=get_last_seen_user($user['id'],$conn);
       $no_un_read_message=count_un_seen_messages($_SESSION['id'],$user['id'],$conn);
        
       if($user_last_seen >$current_time)
       {
      
         $statue= "online";
       }
       else
       {
        $statue= "offline";
       }
    ?>
        <div class="user start_chat"  data-id="<?php echo $user['id'];?>" data-name="<?php echo $user['name'];?>">
        <h6><?php
         echo $user['name'];
         is_typing($user['id'],$conn);
         ?>
       <?php
       if($no_un_read_message >'0')
       {  
         ?>
          <span class='btn btn-danger  btn-sm'><?php echo $no_un_read_message; ?></span>
         <?php
       }

       
       ?>
        <span><?php 
        if($statue=='online')
        { 
          ?>
          <span class="online"></span>
          <?php
        }
        else
        {
          ?>
          <span class="offline"></span>
          <?php
        }
        ?></span>
        </h6>
        </div>
      
        
    <?php
   }
   ?>
</div>   
 