<?php
 
function get_last_seen_user($id,$conn)
{
    $query= "SELECT * FROM login WHERE user_id =$id 
    
    ORDER BY last_seen DESC LIMIT 1";
   $state=$conn->prepare($query);
   $state->execute();
   $result=$state->fetchAll();
   foreach($result as $row)
   {
       return $row['last_seen'];
   }
}
function gett_name($id,$conn)
{
    $query= "SELECT name FROM users WHERE id =$id ";
   $state=$conn->prepare($query);
   $state->execute();
   $result=$state->fetchAll();
   foreach($result as $row)
   {
       return $row['name'];
   }
   
}
function count_un_seen_messages($from_user_id,$to_user_id,$conn)
{
    $query= "SELECT * FROM messages WHERE 
    from_user_id=$to_user_id
    AND 
    to_user_id=$from_user_id
    AND
    statue=1
     ";
   $state=$conn->prepare($query);
   $state->execute();
   $count=$state->rowCount();
    
   $result='';
   if($count>0)
   {
       $result='<span class="badge">'.$count.'</span>';
   }
   return $result;
}
//is typing
function is_typing($user_id,$conn)
{
  $query= "SELECT * FROM login WHERE 
  user_id=$user_id
   ORDER BY last_seen DESC ";
 $state=$conn->prepare($query);
 $state->execute();
 $result=$state->fetchAll();
 foreach ($result as $row)
 {
   if($row['is_typing']==1)
   {
     ?>
      <span class="typing_span">typing</span>
     <?php
   }
   
 }
}

function get_user_messages($from_user_id,$to_user_id,$conn)
{   
    $query= "SELECT * FROM messages WHERE 
    (from_user_id = $from_user_id  AND to_user_id=$to_user_id )
    OR
     (from_user_id = $to_user_id AND to_user_id= $from_user_id )
     ORDER BY time_message ASC ";
      $state=$conn->prepare($query);
      $state->execute();
      $result=$state->fetchAll();
      ?>
      <ul> 
      <?php
      foreach($result as $row)
      {
           
          
          if($row['from_user_id']==$from_user_id)
          {
            ?>

            
           
           <li class="from float-right "><?php echo $row['message'];?></li>
           
            
            
            <?php
          }
          else
          {
            ?>
            <li class="to float-left"><?php echo $row['message'];?></li>
            
            <?php
          }


         ?><br> <div class="bb"></div><?php
          
      }
      ?>

    </ul>
      <?php
     

      $query= "UPDATE messages SET statue=0 WHERE  (from_user_id = $to_user_id AND to_user_id= $from_user_id )";
        $state=$conn->prepare($query);
        $state->execute();
       



}


