
<div class="container">

    <h1 class="text-muted">Thông kê phụ huynh</h1>
   
     <div class="col-md-6">
     <div class="panel panel-primary">
       <div class="panel-heading">Bảng thống kê tài khoản phụ huynh</div>

        <div class="panel-body">
            <div class="col-md-12">           
                                 <table class="table">


                <tr>
                        <td> <strong>Chi tiết thống kê</strong>
                     </td>
                    <td>
                        <strong> Số lượng phụ huynh</strong>
                    </td>
                      <td>
                        <strong> Chiếm %</strong>
                    </td>
                    
                </tr>

                    <tr>
                        <td> 
                            Tổng số lượng tài khoản phụ huynh:
                        </td>
                            <td> 
                             <?php echo count($num); ?> / phụ huynh
                        </td>
                            <td> 
                              100%
                        </td>
                    </tr>

               


                    <tr>
                        <td> 
                           Số lượng phụ huynh đang hoạt động:
                        </td>
                            <td> 
                             <?php echo count($num2); ?> / Gia sư
                        </td>
                            <td> 

                             <?php echo round((count($num2)/count($num))*100, 2); ?>%
                        </td>
                    </tr>   

                           <tr>
                        <td> 
                           Số lượng phụ huynh bị block:
                        </td>
                            <td> 
                             <?php echo count($num5); ?> / Phụ huynh
                        </td>
                            <td> 
                           <?php echo round((count($num5)/count($num))*100, 2); ?>%
                        </td>
                    </tr>

                <tr>
                        <td> 
                           Số lượng tài khoản Phụ huynh đăng ký:
                        </td>
                            <td> 
                             <?php echo count($num1); ?> / Phụ huynh
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
        label: "Số lượng phụ huynh đang hoạt động"
    },
    {
        value: <?php echo count($num1); ?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Số lượng tài khoản Phụ huynh đăng ký"
    },
    {
        value: <?php echo count($num5); ?>,
        color: "#FDB45C",
        highlight: "#FFC870",
        label: "Số lượng phụ huynh bị block"
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
                
                <canvas id="myChart"></canvas>
 
            </div>          

        </div>
     </div>
     </div>

     
     <div class="col-md-6">
    <div class="panel panel-primary">

        <div class="panel-heading">Bảng thống kê gia sư đang hoạt động</div>

        <div class="panel-body">
            <div class="col-md-12">           
                                 <table class="table">


                <tr>
                        <td> <strong>Chi tiết thống kê</strong>
                     </td>
                    <td>
                        <strong> Số lượng gia sư</strong>
                    </td>
                      <td>
                        <strong> Chiếm %</strong>
                    </td>
                    
                </tr>

                    <tr>
                        <td> 
                            Tổng số lượng gia sư hoạt động:
                        </td>
                            <td> 
                             <?php echo count($num2); ?> / Phụ huynh
                        </td>
                            <td> 
                              100%
                        </td>
                    </tr>

               


                    <tr>
                        <td> 
                           Số lượng phụ huynh đang học:
                        </td>
                            <td> 
                               <?php echo count($num3); ?> / Phụ huynh
                        </td>
                            <td> 

                              <?php echo round((count($num3)/count($num2))*100, 2); ?>%
                        </td>
                    </tr>


                    <tr>
                        <td> 
                           Số lượng phụ huynh chưa đăng ký lớp dạy:
                        </td>
                            <td> 
                                <?php echo count($num6); ?> / Gia sư
                        </td>
                            <td> 
                              <?php echo round((count($num6)/count($num2))*100, 2); ?>%
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
        label: " Số lượng phụ huynh đang học"
    },
    {
        value: <?php echo count($num6); ?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "Số lượng phụ huynh chưa đăng ký lớp dạy"
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