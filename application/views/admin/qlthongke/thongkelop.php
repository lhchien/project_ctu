
<div class="container">

    <h1 class="text-muted">Thông kê lớp học</h1>
   
     <div class="col-md-6">
     <div class="panel panel-primary">
       <div class="panel-heading">Bảng thống kê lớp</div>

        <div class="panel-body">
            <div class="col-md-12">           
                                 <table class="table">


                <tr>
                        <td> <strong>Chi tiết thống kê</strong>
                     </td>
                    <td>
                        <strong> Số lượng lớp học</strong>
                    </td>
                      <td>
                        <strong> Chiếm %</strong>
                    </td>
                    
                </tr>

                    <tr>
                        <td> 
                            Tổng số lượng lớp học:
                        </td>
                            <td> 
                             <?php echo count($num); ?> / Lớp
                        </td>
                            <td> 
                              100%
                        </td>
                    </tr>

                    <tr>
                        <td> 
                           Số lượng lớp đả duyệt bài đăng:
                        </td>
                            <td> 
                             <?php echo count($num2); ?> / lớp
                        </td>
                            <td> 

                             <?php echo round((count($num2)/count($num))*100, 2); ?>%
                        </td>
                    </tr>   

                           <tr>
                        <td> 
                           Số lượng lớp chưa duyệt:
                        </td>
                            <td> 
                             <?php echo count($num1); ?> / Lớp
                        </td>
                            <td> 
                           <?php echo round((count($num1)/count($num))*100, 2); ?>%
                        </td>
                    </tr>

            

                    <tr>    
                        <td>
                            <strong>Biểu đồ</strong>

     <script>
                            var data = [
    {
        value: <?php echo count($num2); ?>,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "  Số lượng lớp đả duyệt bài đăng"
    },
    {
        value: <?php echo count($num1); ?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Số lượng lớp chưa duyệt"
    },
 
]
     </script>


                        </td>
                        <td>
                        </td>

                        <td>
                        </td>
                    </tr>
                    </table>
                
                <canvas id="myChart"></canvas>
 
            </div>          

        </div>
     </div>
     </div>
<!--///////////////////////////////////////-->
      <div class="col-md-6">
     <div class="panel panel-primary">
       <div class="panel-heading">Bảng thống kê lớp</div>

        <div class="panel-body">
            <div class="col-md-12">           
                                 <table class="table">


                <tr>
                        <td> <strong>Chi tiết thống kê</strong>
                     </td>
                    <td>
                        <strong> Số lượng lớp học</strong>
                    </td>
                      <td>
                        <strong> Chiếm %</strong>
                    </td>
                    
                </tr>

                    <tr>
                        <td> 
                            Tổng số lượng lớp học:
                        </td>
                            <td> 
                             <?php echo count($num); ?> / Lớp
                        </td>
                            <td> 
                              100%
                        </td>
                    </tr>

                    <tr>
                        <td> 
                           Số lượng lớp đả duyệt bài đăng:
                        </td>
                            <td> 
                             <?php echo count($num2); ?> / lớp
                        </td>
                            <td> 

                             <?php echo round((count($num2)/count($num))*100, 2); ?>%
                        </td>
                    </tr>   

                           <tr>
                        <td> 
                           Số lượng lớp chưa duyệt:
                        </td>
                            <td> 
                             <?php echo count($num1); ?> / Lớp
                        </td>
                            <td> 
                           <?php echo round((count($num1)/count($num))*100, 2); ?>%
                        </td>
                    </tr>

            

                    <tr>    
                        <td>
                            <strong>Biểu đồ</strong>

     <script>
                            var data = [
    {
        value: <?php echo count($num2); ?>,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "  Số lượng lớp đả duyệt bài đăng"
    },
    {
        value: <?php echo count($num1); ?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Số lượng lớp chưa duyệt"
    },
 
]
     </script>


                        </td>
                        <td>
                        </td>

                        <td>
                        </td>
                    </tr>
                    </table>
                
                <canvas id="myChart"></canvas>
 
            </div>          

        </div>
     </div>
     </div>


<!--///////////////////////////-->
     <div class="col-md-6">
    <div class="panel panel-primary">

        <div class="panel-heading">Bảng thống kê lớp đang hoạt động</div>

        <div class="panel-body">
            <div class="col-md-12">           
                                 <table class="table">


                <tr>
                        <td> <strong>Chi tiết thống kê</strong>
                     </td>
                    <td>
                        <strong> Số lượng lớp học</strong>
                    </td>
                      <td>
                        <strong> Chiếm %</strong>
                    </td>
                    
                </tr>

                    <tr>
                        <td> 
                            Tổng số lượng lớp đả duyệt bài đăng:
                        </td>
                            <td> 
                             <?php echo count($num2); ?> / lớp
                        </td>
                            <td> 
                              100%
                        </td>
                    </tr>

               


                    <tr>
                        <td> 
                           Số lượng lớp đang dạy:
                        </td>
                            <td> 
                               <?php echo count($num3); ?> / lớp
                        </td>
                            <td> 
                            <?php echo round((count($num3)/count($num2))*100, 2); ?>%
                            
                        </td>
                    </tr>


                       <tr>
                        <td> 
                           Số lượng lớp có gia sư đăng ký nhưng chưa duyệt:
                        </td>
                            <td> 
                                <?php echo count($num4); ?> / lớp
                        </td>
                            <td> 
                           
                        </td>
                    </tr>

                    <tr>
                        <td> 
                           Số lượng lớp chưa có gia sư đăng ký:
                        </td>
                            <td> 
                                <?php echo count($num6); ?> / lớp
                        </td>
                            <td> 
                           
                        </td>
                    </tr>
                    
                    
             
                    

                    <tr>    
                        <td>
                            <strong>Biểu đồ</strong>

     <script>
                            var data1 = [
    {
        value: <?php echo count($num3); ?>,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: " Số lượng gia sư đang dạy"
    },
    {
        value: <?php echo count($num6); ?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Số lượng gia sư chưa đăng ký lớp dạy"
    }
   
]
     </script>


                        </td>
                        <td>
                        </td>

                        <td>
                        </td>
                    </tr>
                    </table>
                
                <canvas id="myChart1"></canvas>
               
            </div>          

        </div>
        
    </div>


    <style>
    panel panel-primary panel-body {
        color:#FFF !important;
        background-color:#337ab7 !important;
    }
    </style>
    



  </div>


</div><!-- containter-->

               <script>
                $(function () {





     var option = {
     responsive: true,
     };
   
    // Get the context of the canvas element we want to select
             var ctx = document.getElementById("myChart").getContext('2d');
             var myPieChart = new Chart(ctx).Pie(data,option);
              var ctx = document.getElementById("myChart1").getContext('2d');
             var myPieChart = new Chart(ctx).Pie(data1,option);
            });
                
                 </script>