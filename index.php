<?php
require 'db_conn.php';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>To Do List</title>
        <!-- fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- google fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;400;700;900&display=swap" rel="stylesheet">
        <!-- css -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <section id="root">
            <header>
                <h1>To Do List</h1>
                <div>
                    <form action="app/add.php" method="POST" autocomplete="off">
                        <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                            <input type="text" placeholder="This Field Is Required" name="title"  >
                            <button class="btn" >Add</button>
                        <?php  } else{ ?>
                            <input type="text" placeholder="New Task" name="title" >
                            <button class="btn" >Add</button>
                        <?php }?>
                    </form>
                </div>
            </header>
            <main>
                <?php
                    $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
                ?>

                <?php if($todos->rowCount() === 0){ ?>
                    <h3>Non ci sono task</h3>
                <?php }?>
                <ul>
                   
                    <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>                   
                        <div>
                        <li> 
                            <span id="<?php echo $todo['id']; ?>" class="remove-to-do"> x </span>    
                        <?php if($todo['checked']){ ?>
                            <input type="checkbox"  class="check-box" checked data-todo-id="<?php echo $todo['id']; ?>" >
                            <span><h4 class="checked"><?php echo $todo['title']  ?></h4></span>
                            <span class="note">
                                <small><?php echo $todo['data_time']  ?> </small>
                            </span>  
                            
                        <?php }else { ?>
                            <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>" >  
                            <span><h4 ><?php echo $todo['title']  ?></h4></span>
                            <span class="note">
                                <small><?php echo $todo['data_time']  ?> </small>
                            </span>  
                        
                        <?php }?> 
                        </li>                          
                        </div>   
                    <?php }?>
                    
                </ul>
            </main>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $(' .remove-to-do').click(function(){
                    const id =$(this).attr('id');
                    $.post("app/remove.php",
                    {
                        id:id
                    },
                    (data) => {
                        if(data){
                            $(this).parent().hide(600);
                        }
                    }
                    );
                });
                $(' .check-box').click(function(e){
                    const id=$(this).attr('data-todo-id');
                    $.post('app/check.php',
                    {
                        id:id
                    },
                    (data) => {
                        if(data != 'error'){
                            const h4=$(this).next();
                            if(data === '1'){
                                h4.removeClass('checked');
                            }else{
                                h4.addClass('checked');
                            }
                        };
                    }
                    )
                });
            });
        </script>
    </body>
</html>