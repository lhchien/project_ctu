
    
    <?php
    $sql="SELECT DISTINCT dl_mon FROM daylop WHERE dl_gs_id=$giasu->gs_tk_id ORDER BY dl_mon desc";
    $daylop = $this->db->query($sql)->result(); 

    foreach ($daylop as $dl) {
        $sql = "SELECT dl_gs_id FROM daylop WHERE dl_mon='".$dl->dl_mon."' AND dl_gs_id != $giasu->gs_tk_id GROUP BY dl_gs_id";
        $dl_gs_id = $this->db->query($sql)->result(); ?>
        <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Gia sư khác dạy <?php echo " ".$dl->dl_mon; ?> </div>
        <?php

        foreach ($dl_gs_id as $gs_id) { 
            
            $sql1 = "SELECT * FROM giasu WHERE gs_tk_id=$gs_id->dl_gs_id"; 
            $giasu1 = $this->db->query($sql1)->row();
            ?>
            <div class="panel-body">
                <div class="col-md-4">
                    <img src="<?php echo base_url().$giasu1->gs_hinhanh;?>" class="img-responsive">
                </div>
                <div class="col-md-8">
                    <a href="<?php echo base_url(); ?>giasu/detail/<?php echo $giasu1->gs_tk_id; ?>"><b><?php echo $giasu1->gs_hoten; ?></a></b> <br/>
                    <?php echo "Trình độ: ".$giasu->gs_trinhdo; ?> <br/>
                    <?php echo "Kinh nghiệm: ".$giasu->gs_kinhnghiem." năm"; ?> <br/>
                    <?php 
                        $sql2 = "SELECT ld_diem_cmt FROM lopday a, dangky b WHERE a.ld_id = b.dk_ld_id AND dk_trangthai = 1 AND b.dk_gs_id =".$gs_id->dl_gs_id;
                        $gs = $this->db->query($sql2)->result();
                        $row = ($this->db->query($sql2)->num_rows()==0)?1:$this->db->query($sql2)->num_rows();
                        $diem = 0;
                        foreach ($gs as $gs) {
                            $diem += $gs->ld_diem_cmt;
                        }
                        
                        $a = ($diem/$row <3)?3:$diem/$row;
                        echo "Đánh giá chung: ";
                        for($i=1;$i<=$a;$i++){
                            echo'<span class="glyphicon glyphicon-star"></span>';
                        }
                    ?>
                </div>
            </div>
            <?php
        } ?>
      
        </div>
         </div>
         </div>
        <?php
    }
    ?>
        
</div>