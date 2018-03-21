<div class="col-md-4">
    <div class="panel panel-primary">
        <div class="panel-heading">Lớp mới chưa có gia sư</div>
        <?php
        // $where = array('ld_trangthai' => 1);
        // $lopday = $this->m_phuhuynh->getAllClass($where,5,0);
        $sql="SELECT * FROM lopday WHERE ld_trangthai=1 AND ld_id NOT IN 
             (SELECT dk_ld_id FROM dangky WHERE dk_trangthai=1) ORDER BY ld_id desc LIMIT 5";
        //echo $sql;
        $lopday = $this->db->query($sql)->result();
        if(empty($lopday))
            echo "<div class=panel-body>Chưa có lớp mới</div>";
        foreach ($lopday as $lopday) {
            ?>
            <div class="panel-body">
                <div class="col-md-4">
                        <img src="<?php echo base_url().$lopday->ld_hinhanh;?>" class="img-responsive">
                    </div>
                    <div class="col-md-8">
                        <a href="<?php echo base_url(); ?>lopday/detail/<?php echo $lopday->ld_id; ?>"><b><?php echo $lopday->ld_tieude; ?></a></b> <br/>
                        <?php echo "Môn học: ".$lopday->ld_mon; ?> <br/>
                        <?php echo "Khối lớp: ".$lopday->ld_khoilop; ?> <br/>
                        <?php echo "Số lượng: ".$lopday->ld_soluong." học sinh"; ?>
                    </div>
            </div>
            <?php
        } ?>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">Gia sư xuất sắc</div>
        <div class="panel-body">
        </div>
    </div>
</div>