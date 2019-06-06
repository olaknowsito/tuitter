<?php 
    include("includes/header.php");

    $message_obj = new Message($con, $userLoggedIn);

    if(isset($_GET['u'])) {
        $user_to = $_GET['u'];
    } else {
        //retrieve the most recent uyse5r
        $user_to = $message_obj->getMostRecentUser();
        //if you havnt find anybody- meaning yuo havnt start conversation yet
        if($user_to == false) {
            // iff new meanign your sending a new mesages
            $user_to = 'new';
        }
    }

    if($user_to != "new") {
        $user_to_obj = new User($con, $user_to);
    }

    if(isset($_POST['post_message'])) {
        if(isset($_POST['message_body'])) {
            //prepares thge string so we would be able to used in my sqli statemetn. 
            //for ex. there are a signle kote, then it would mess it up if you didnt do this, cancels wdedont need
            $body = mysqli_real_escape_string($con, $_POST['message_body']);
            $date = date("Y-m-d H:i:s");
            $message_obj->sendMessage($user_to, $body, $date);
        }
    }
?>

    <div class="user_details column">
		<a href="<?php echo $userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>

		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
			<?php 
			echo $user['first_name'] . " " . $user['last_name'];

			 ?>
			</a>
			<br>
			<?php echo "Posts: " . $user['num_posts']. "<br>"; 
			echo "Likes: " . $user['num_likes'];

			?>
		</div>
	</div>

    <div class="main_column column" id="main_column">
        <?php 
            if($user_to != "new") {
                echo "<h4> You and <a href='$user_to'>" . $user_to_obj->getFirstAndLastname() . "</a></h4><hr><br>";
                echo "<div class='loaded_messages' id='scroll_messages'>";
                    echo $message_obj->getMessages($user_to);
                echo "</div>";
            } else {
                echo "<h4>New Message</h4>";
            }
        ?>

        <div class="message_post">
            <form action="" method="POST">
                <?php
                    if($user_to == "new") {
                        echo "Select the friend you would like to message <br><br>";
                            //the value of the input is this.value, auto complete. suggestion off 
                        echo "To: <input type='text' onkeyup='getUsers(this.value, <?php echo $userLoggedIn;?>)' name='q' placeholder='Name' autocomplete='off' id='search_text_input'>";
                        echo "<div class='results'></div>";
                    } else {
                        echo "<textarea name='message_body' id='message_textarea' placeholder='Write your message ...'></textarea>";
                        echo "<input type='submit' name='post_message' class='info' id='message_submit' value='Send'>";
                    }
                ?>
            </form>
        </div>
        
        <script>
            var div = document.getElementById("scroll_messages");
            if(div != null) {
                div.scrollTop = div.scrollHeight;
            }
        </script>
                    
    </div>

    <div class="user_details column" id="conversations">
            <h4>Conversations</h4>

            <div class="loaded_conversations">
                <?php echo $message_obj->getConvos();?>
            </div>
            <br>
            <a href="messages.php?u=new">New Message</a>
        </div>