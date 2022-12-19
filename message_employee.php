<?php 
  require('layouts/header_emp.php');
    
   
    $user_id = $_SESSION['user_id'];

   
    $update = mysqli_query($con, "UPDATE messages SET seen=1 WHERE employee_id=$user_id AND sender_id='petko'");

    if(isset($_POST['submit-message'])){
        $message = $_POST['message'];
        date_default_timezone_set('Asia/Manila');
        $datetime = date("Y-m-d H:i:s");

        $sender = mysqli_query($con,"SELECT * FROM usertable  WHERE id = $user_id") or die ('query failed');
        $senderQuery = mysqli_fetch_array($sender);

        $name = $senderQuery['first_name'].' '.$senderQuery['last_name'].' '.$senderQuery['suffix'];

        $insert_data = "INSERT INTO messages (employee_id, `admin`, `message`, created_at, sender_name, receiver_name, sender_id)
                            values('$user_id', 'petko', '$message', '$datetime', '$name', 'Administrator', '$user_id')";
        $data_check1 = mysqli_query($con, $insert_data);
    }
?>
        <style>
        .inbox_people {
            background: #f8f8f8 none repeat scroll 0 0;
            float: left;
            overflow: hidden;
            width: 40%;
            border-right: 1px solid #c4c4c4;
        }

        .inbox_msg {
            border: 1px solid #c4c4c4;
            clear: both;
            overflow: hidden;
        }

        .top_spac {
            margin: 20px 0 0;
        }


        .recent_heading {
            float: left;
            width: 40%;
        }

        .srch_bar {
            display: inline-block;
            text-align: right;
            width: 60%;
        }

        .headind_srch {
            padding: 10px 29px 10px 20px;
            overflow: hidden;
            border-bottom: 1px solid #c4c4c4;
        }

        .recent_heading h4 {
            color: #05728f;
            font-size: 21px;
            margin: auto;
        }

        .srch_bar input {
            border: 1px solid #cdcdcd;
            border-width: 0 0 1px 0;
            width: 80%;
            padding: 2px 0 4px 6px;
            background: none;
        }

        .srch_bar .input-group-addon button {
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
            border: medium none;
            padding: 0;
            color: #707070;
            font-size: 18px;
        }

        .srch_bar .input-group-addon {
            margin: 0 0 0 -27px;
        }

        .chat_ib h5 {
            font-size: 15px;
            color: #464646;
            margin: 0 0 8px 0;
        }

        .chat_ib h5 span {
            font-size: 13px;
            float: right;
        }

        .chat_ib p {
            font-size: 14px;
            color: #989898;
            margin: auto
        }

        .chat_img {
            float: left;
            width: 11%;
        }

        .chat_ib {
            float: left;
            padding: 0 0 0 15px;
            width: 88%;
        }

        .chat_people {
            overflow: hidden;
            clear: both;
        }

        .chat_list {
            border-bottom: 1px solid #c4c4c4;
            margin: 0;
            padding: 18px 16px 10px;
        }

        .inbox_chat {
            height: 550px;
            overflow-y: scroll;
        }

        .active_chat {
            background: #ebebeb;
        }

        .incoming_msg_img {
            display: inline-block;
            width: 6%;
        }

        .received_msg {
            display: inline-block;
            padding: 0 0 0 10px;
            vertical-align: top;
            width: 92%;
        }

        .received_withd_msg p {
            background: #ebebeb none repeat scroll 0 0;
            border-radius: 3px;
            color: #646464;
            font-size: 14px;
            margin: 0;
            padding: 5px 10px 5px 12px;
            width: 100%;
        }

        .time_date {
            color: #747474;
            display: block;
            font-size: 12px;
            margin: 8px 0 0;
        }

        .received_withd_msg {
            width: 57%;
        }

        .mesgs {
            float: left;
            padding: 30px 15px 0 25px;
            width: 60%;
        }

        .sent_msg p {
            background: #05728f none repeat scroll 0 0;
            border-radius: 3px;
            font-size: 14px;
            margin: 0;
            color: #fff;
            padding: 5px 10px 5px 12px;
            width: 100%;
        }

        .outgoing_msg {
            overflow: hidden;
            margin: 26px 0 26px;
        }

        .sent_msg {
            float: right;
            width: 46%;
        }

        .input_msg_write input {
            background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
            border: medium none;
            color: #4c4c4c;
            font-size: 15px;
            min-height: 48px;
            width: 100%;
        }

        .type_msg {
            border-top: 1px solid #c4c4c4;
            position: relative;
        }

        .msg_send_btn {
            background: #05728f none repeat scroll 0 0;
            border: medium none;
            border-radius: 50%;
            color: #fff;
            cursor: pointer;
            font-size: 17px;
            height: 33px;
            position: absolute;
            right: 0;
            top: 11px;
            width: 33px;
        }

        .messaging {
            padding: 0 0 50px 0;
        }

        .msg_history {
            height: 516px;
            overflow-y: auto;
        }
        </style>




    <div class="container mt-5 ">
        <!-- ======================================= -->
        <div class="messaging shadow">
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Messages</h4>
                        </div>
                        <div class="srch_bar">
                            <div class="stylish-input-group">
                                <input type="text" class="search-bar" placeholder="Search">
                                <span class="input-group-addon">
                                    <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        <?php 
                        $chats = mysqli_query($con,"SELECT * FROM messages WHERE employee_id = $user_id ORDER BY id DESC LIMIT 1") or die ('query failed');
                        $selectQuery = mysqli_fetch_array($chats);
                    ?>
                        <a href="#">
                            <div class="chat_list active_chat">
                                <div class="chat_people">
                                    <div class="chat_img"> <img style="width:100%;"
                                            src="asset\logopet.png" alt="sunil"> </div>
                                    <div class="chat_ib">
                                        <h5>Petco Animal Clinic <span
                                                class="chat_date"><?php if(isset($selectQuery['created_at'])){ echo date('F d,Y',strtotime($selectQuery['created_at'])); } ?></span>
                                        </h5>
                                        <p><?php if(isset($selectQuery['message'])){ echo $selectQuery['message']; } ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mesgs bg-light">
                    <div class="msg_history">
                        <?php 
                            $get_messages = "SELECT * FROM messages WHERE employee_id = '$user_id'";
                            $res = mysqli_query($con, $get_messages);

                            while($fetch_message = mysqli_fetch_assoc($res)){

                                if($fetch_message['sender_id']==$user_id){
                        ?>

                        <div class="outgoing_msg">
                            <div class="sent_msg">
                                <p><?php echo $fetch_message['message']; ?></p>
                                <span class="time_date">
                                    <?php echo date('h:i a',strtotime($fetch_message['created_at'])); ?> |
                                    <?php echo date('F d',strtotime($fetch_message['created_at'])); ?></span>
                            </div>
                        </div>

                        <?php }else{ ?>
                        <div class="incoming_msg">
                            <div class="incoming_msg_img"> <img style="width:100%;"
                                    src="asset\logopet.png" alt="sunil"> </div>
                            <div class="received_msg">
                                <div class="received_withd_msg">
                                    <p><?php echo $fetch_message['message']; ?></p>
                                    <span class="time_date">
                                        <?php echo date('h:i a',strtotime($fetch_message['created_at'])); ?> |
                                        <?php echo date('F d',strtotime($fetch_message['created_at'])); ?></span>
                                </div>
                            </div>
                        </div>

                        <?php 
                        }
                            }
                        ?>

                    </div>
                    <form action="messages.php" method="post">
                        <div class="type_msg">
                            <div class="input_msg_write">
                                <input type="text" class="write_msg" required name="message"
                                    placeholder="Type a message" />
                                <button class="msg_send_btn" type="submit" name="submit-message"><i
                                        class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



        </div>
        <!-- ======================================= -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#message-menu').addClass('bg-primary');
        });
    </script>
</body>

</html>