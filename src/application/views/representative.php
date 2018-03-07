<div class="row">
    <div class="col-md-9">
        <!-- BEGIN PROFILE CONTENT -->

        <div class="profile-content">
            <div class="row">
                <div class="col-md-6">
                    <!-- BEGIN PORTLET -->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md"> <i class="icon-bar-chart theme-font hide"></i> <span class="caption-subject font-blue-madison bold uppercase">Your Activity</span> <span class="caption-helper hide">weekly stats...</span> </div>
                            <div class="actions" >
                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                    
                                    <input type="button" name="week" class="btn btn-transparent grey-salsa btn-circle btn-sm active" id="period1" value="Week"  onclick="getWeekCount();">
                                    <input type="button" name="month" class="btn btn-transparent grey-salsa btn-circle btn-sm" id="period2" value="Month"   onclick="getMonthCount();">
                                    <input type="button" name="all" class="btn btn-transparent grey-salsa btn-circle btn-sm" id="period3" value="All"   onclick="getAllCount();">
                                     
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row number-stats margin-bottom-30">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="stat-left">
                                        <div class="stat-chart">
                                            <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                            <div id="sparkline_bar"></div>
                                        </div>
                                        <div class="stat-number">
                                            <div class="title"> Total Firm Count</div>
                                            <div class="number"> <?php foreach($allcounts as $counts ) {
                                                echo $counts['countfirm']; } ?> 
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="stat-right">
                                        <div class="stat-chart">
                                            <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                            <div id="sparkline_bar2"></div>
                                        </div>
                                        <div class="stat-number">
                                            <div class="title" id="periodtext"> Selected Period</div>
                                            <div class="number" id="periodcount"> <?php foreach($countperiod as $counts ) {
                                                echo $counts['count']; } ?> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-scrollable table-scrollable-borderless">
                                <table class="table table-hover table-light">
                                    <thead>
                                        <tr class="uppercase">
                                            <th colspan="1"> Firm Counts </th>

                                            <th> Event Counts </th>
                                            <th> Discount Counts </th>
                                            <th> Web Count </th>
                                        </tr>
                                    </thead>
                                    
                                    <?php foreach($allcounts as $counts ) {

                                        echo "<tr>
                                        <td class=\"fit\"> ".$counts['countfirm']." </td>
                                        <td> ". $counts['countevent']." </td>
                                        <td> ". $counts['countticket']." </td>                                       
                                        <td> ".$counts['countweb']." </td> </tr>";
                                    } ?>
                                    
                                  
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET -->
                </div>
                <div class="col-md-6">
                    <!-- BEGIN PORTLET -->
                    <div class="portlet light  tasks-widget">
                        <div class="portlet-title">
                             <div class="caption caption-md"> <i class="icon-globe theme-font hide"></i> <span class="caption-subject font-blue-madison bold uppercase">Private Messages</span> </div>
                            <ul class="nav nav-tabs">
                                <li class="active"> <a href="#tab_1_1" data-toggle="tab"> Messages </a> </li>   

                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content"> 
                                <div class="tab-pane active" id="tab_1_1">
                                    
                                        <div class="scroller" style="height: 282px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                            <!-- START TASK LIST -->
                                            <ul class="task-list">


                                                 <?php foreach($messagespri as $messagepri ) {

                                                      echo "<li>
                                                          <div class=\"task-checkbox\">
                                                        <input type=\"hidden\" value=\"1\" name=\"test\" />
                                                        <input type=\"checkbox\" class=\"liChild\" value=\"2\" name=\"test\" />
                                                    </div>
                                                    <div class=\"task-title\"> <span class=\"task-title-sp\">".$messagepri['mail_content_txt']."(".$messagepri['from_name'].")"."</span> <span class=\"task-bell\"> "
                                                              . " <i class=\" \"></i> </span>  </div>"
                                                              . " <div class=\"task-config\">
                                                        <div class=\"task-config-btn btn-group\"> <a class=\"btn btn-sm default\" href=\"javascript:;\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-close-others=\"true\"> <i class=\"fa fa-cog\"></i> <i class=\"fa fa-angle-down\"></i> </a>
                                                            <ul class=\"dropdown-menu pull-right\">
                                                                <li> <a href=\"javascript:;\"> <i class=\"fa fa-check\"></i> Complete </a> </li>
                                                               <li> <a href=\"javascript:;\"> <i class=\"fa fa-trash-o\"></i> Cancel </a> </li>
                                                            </ul>
                                                        </div>
                                                    </div></li>";



                                                     } ?>

                                              </ul>
                                            <!-- END START TASK LIST -->
                                        </div>
                         
                                    
                                </div>
                            </div>
                        
                          
                        </div>
                    </div>
                    <!-- END PORTLET -->
                </div>
          
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- BEGIN PORTLET -->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md"> <i class="icon-bar-chart theme-font hide"></i> <span class="caption-subject font-blue-madison bold uppercase">Customer Support</span> </div>
                            <div class="inputs">
                                <div class="portlet-input input-inline input-small ">
                                    <div class="input-icon right"> <i class="icon-magnifier"></i>
                                        <input type="text" class="form-control form-control-solid" placeholder="search...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                <div class="general-item-list">
                                    
                                    <?php
                                            foreach ( $support_messages as $support_message)
                                            {
                                                echo "<div class=\"item\">
                                                        <div class=\"item-head\">
                                                            <div class=\"item-details\">  <a href=\"\" class=\"item-name primary-link\">".$support_message["name_txt"]."</a> </div>
                                                              <span class=\"item-status\"> <span class=\"badge badge-empty badge-success\"></span> ".$support_message["message_priority_txt"]."</span> </div>
                                                            <div class=\"item-body\"> ".$support_message["mail_content_txt"]." </div>
                                                     </div>";
                                            }
                                    ?>
                                    
                                <!--    <div class="item">
                                        <div class="item-head">
                                            <div class="item-details">  <a href="" class="item-name primary-link">Nick Larson</a> </div>
                                            <span class="item-status"> <span class="badge badge-empty badge-success"></span> Open</span> </div>
                                        <div class="item-body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </div>
                                    </div> -->
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET -->
                </div>
                <div class="col-md-6">
                    <!-- BEGIN PORTLET -->
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md"> <i class="icon-globe theme-font hide"></i> <span class="caption-subject font-blue-madison bold uppercase">General Messages</span> </div>
                            <ul class="nav nav-tabs">
                                <li class="active"> <a href="#tab_1_3" data-toggle="tab"> System </a> </li>                            
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <!--BEGIN TABS-->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_3">
                                    <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                        <ul class="feeds">
                                                                                    
                                             <?php foreach($gen_messages as $message ) {
                                                   echo "<li> <a>
                                                    <div class=\"col1\">
                                                        <div class=\"cont\">
                                                            <div class=\"cont-col1\">
                                                                <div class=\"label label-sm label-".$message['icon_color']."\"> <i class=\"".$message['icon_type']."\"></i> </div>
                                                            </div>
                                                            <div class=\"cont-col2\">
                                                                <div class=\"desc\">".$message['message_txt']."</div>
                                                            </div>
                                                        </div>
                                                    </div>                                                  
                                                </a> </li>" ;                                         
                                                 
                                                 
                                                 
                                             } ?>
                                                                  
                                        </ul>
                                    </div>
                                </div>
                               
                            </div>
                            <!--END TABS-->
                        </div>
                    </div>
                    <!-- END PORTLET -->
                </div>
            </div>
          
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
    <div class="col-md-3">
        <!-- BEGIN PROFILE SIDEBAR -->
        <?php include 'profilerepresentative-cont.php'; ?>
        <!-- END BEGIN PROFILE SIDEBAR -->
    </div>
</div>
<<script language="javascript" type="text/javascript">

function getAllCount()
{
   
     $.ajax({
                type: "POST",
                url: "Representative/refreshbyperiod/all",
                //data: dataString,
                cache: false,
                success: function (result) {
                    document.getElementById("periodtext").innerHTML = 'All Period';
                    document.getElementById("periodcount").innerHTML = result;
                }
            }); 
          
    }
    function getMonthCount()
   {
            $.ajax({
            type: "POST",
            url: "Representative/refreshbyperiod/month",
            //data: dataString,
            cache: false,
            success: function (result) {
                document.getElementById("periodtext").innerHTML = 'Monthly Period';
                document.getElementById("periodcount").innerHTML = result;
            }
        });
        
    }
        
   
    function getWeekCount()
    {
            $.ajax({
            type: "POST",
            url: "Representative/refreshbyperiod/week",
            //data: dataString,
            cache: false,
            success: function (result) {
                document.getElementById("periodtext").innerHTML = 'Weekly Period';
                document.getElementById("periodcount").innerHTML = result;
            }
        });
        
    }



</script>