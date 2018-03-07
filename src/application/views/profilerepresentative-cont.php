

<div class="profile-sidebar">
    <!-- PORTLET MAIN -->
    <div class="portlet light profile-sidebar-portlet ">
        <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic"> <img src="<?php echo base_url().$this->session->userdata('path');?>" class="img-responsive" alt=""> </div>
           <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
          <div class="profile-usertitle-name"> <?php echo  $this->session->userdata('name')." ".$this->session->userdata('surname');?></div>
            <div class="profile-usertitle-job" ><?php echo $this->session->userdata('user_id');?></div>
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->
        <!-- END SIDEBAR BUTTONS -->
        <!-- SIDEBAR MENU -->
        <div class="profile-usermenu">
            <ul class="nav">
                <li> <a href="<?php echo base_url();?>index.php/representative"> <i class="icon-home"></i> Overview </a> </li>
                 <li> <a href="<?php echo base_url();?>index.php/Mailing" > <i class="icon-envelope-letter"></i>Contact to Someone </a> </li>
           <li> <a href="<?php echo base_url();?>index.php/MyFirm"> <i class="icon-briefcase"></i> My Firm </a> </li>
              
                <li> <a href="<?php echo base_url();?>index.php/UserAccount"> <i class="icon-settings"></i> Account Settings </a> </li>
                <li> <a href="<?php echo base_url();?>index.php/representative_help"> <i class="icon-info"></i> Help </a> </li>
            </ul>
        </div>
        <!-- END MENU -->
    </div>
    <!-- END PORTLET MAIN -->
    <!-- PORTLET MAIN -->
    <div class="portlet light ">
        <!-- STAT -->
   
        <!-- END STAT -->
         <div>
            <h4 class="profile-desc-title">About <?php echo $this->session->userdata('name')." ".$this->session->userdata('surname') ;?></h4>
            <div class="margin-top-20 profile-desc-link"> <i class="fa fa-envelope"></i> <a href="mailto:<?php echo $this->session->userdata('email');?>"> <?php echo $this->session->userdata('email');?> </a></div>
            <div class="margin-top-20 profile-desc-link"> <i class="fa fa-twitter"></i>  <a target="_blank" href="http://www.twitter.com/<?php echo $this->session->userdata('twitter');?>"><?php echo $this->session->userdata('twitter');?></a> </div>
            <div class="margin-top-20 profile-desc-link"> <i class="fa fa-facebook"></i> <a target="_blank" href="http://www.facebook.com/<?php echo $this->session->userdata('facebook');?>"><?php echo $this->session->userdata('facebook');?></a></div>
            <div class="margin-top-20 profile-desc-link"> <i class="fa fa-instagram"></i> <a target="_blank" href="http://www.instagram.com/<?php echo $this->session->userdata('instagram');?>"><?php echo $this->session->userdata('instagram');?></a> </div>
            <div class="margin-top-20 profile-desc-link"> <i class="fa fa-globe"></i> <a target="_blank" href="http://<?php echo  $this->session->userdata('webpage');?>"><?php echo $this->session->userdata('webpage');?></a> </div>
        </div>
    </div>
     <!-- Modal Contact Admin-->
                                <div id="modal_ContactAdmin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal_ContactAdmin" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            
                                                                <h4 class="modal-title">Contact Admin</h4>

                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                            <div class="form-group">
                                                                <label>Explanation</label>
                                                                <textarea class="form-control" rows="3" id="message_text"></textarea>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                               <label>Message Priority</label>
                                                               <select class="form-control" name="messagePriority" id="messagePriority"  >
                                                                    <?php 
                                                                               
                                                                        foreach ($messagePriority as $type){
                                                                             
                                                                            echo "<option value=\"".$type["messagepriority_id"]."\">".$type["message_priority_txt"]."</option>";

                                                                         }
                                                                                      

                                                                            ?>
                                                               </select>

                                                           </div>
                                                            
                                                           <label>File (If You Want)</label>
                                                           <div class="form-group">
                                                    
                                                            
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="input-group input-large">
                                                                            <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                                                <span class="fileinput-filename"> </span>
                                                                            </div>
                                                                            <span class="input-group-addon btn default btn-file">
                                                                                <span class="fileinput-new"> Select file </span>
                                                                                <span class="fileinput-exists"> Change </span>
                                                                                <input type="file" name="..."> </span>
                                                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                        </div>
                                                                    </div>
                                                              
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button  id="search_UserClose" class="btn default" data-dismiss="modal" aria-hidden="true">Close</button>
                                                          <a onclick="sendMessage();" type="button" class="btn btn-icon-only red">
                                                                <i class="fa fa-envelope"></i>    </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                <!--/Modal Currency -->
    
    <!-- END PORTLET MAIN -->
</div>

<script language="javascript" type="text/javascript">
    function sendMessage(){
        var message = document.getElementById("message_text").value;
        var dt_now = new Date();
        dt_now.setDate(dt_now.getDate()+ 15 );
        var expire_dt= dt_now.getDate()+"-" +dt_now.getMonth() + "-" + dt_now.getFullYear();
        var messageType_selector= document.getElementById("messagePriority");
        var message_type= messageType_selector.options[messageType_selector.selectedIndex].value;
        var dataString= "message="+message + "&expire_dt=" + expire_dt + "&message_type=" +message_type;
        alert(dataString);
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1/picfy/index.php/Message/sendMessagetoAdmin/",
            data: dataString,
            cache: false,
            success: function (result) {
                alert("inserted");
            }
        }); 
    }
</script>
