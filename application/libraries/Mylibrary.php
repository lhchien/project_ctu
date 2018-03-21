<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  
class Mylibrary {

public static function showYearOfBirth($val='') { ?>
        <select name='slNamSinh' class='form-control'>
                <option value=''>Chọn năm sinh</option>
                <?php
                for($i=1930; $i<2017; $i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if($val==$i) echo "selected";?>><?php echo $i; ?></option>
                    <?php
                } ?>
        </select>
        <?php
    }

    public static function showTrinhDo($val='') { ?>
        <select name='slTrinhDo' class='form-control' id="slTrinhDo">
            <option value="">Chọn trình độ</option>
            <option value='Sinh viên năm 1' <?php if($val=='Sinh viên năm 1') echo "selected";?>>Sinh viên năm 1</option>
            <option value='Sinh viên năm 2' <?php if($val=='Sinh viên năm 2') echo "selected";?>>Sinh viên năm 2</option>
            <option value='Sinh viên năm 3' <?php if($val=='Sinh viên năm 3') echo "selected";?>>Sinh viên năm 3</option>
            <option value='Sinh viên năm 4' <?php if($val=='Sinh viên năm 4') echo "selected";?>>Sinh viên năm 4</option>
            <option value='Cao đẳng' <?php if($val=='Cao đẳng') echo "selected";?>>Cao đẳng</option>
            <option value='Đại học' <?php if($val=='Đại học') echo "selected";?>>Đại học</option>
            <option value='Thạc sĩ' <?php if($val=='Thạc sĩ') echo "selected";?>>Thạc sĩ
            <option value='Tiến sĩ' <?php if($val=='Tiến sĩ') echo "selected";?>>Tiến sĩ
        </select>
        <?php
    }

    public static function showLop($val=array()) { ?>
        <?php //var_dump($val); var_dump(in_array(1, $val)); ?>
        <select data-placeholder="Chọn lớp học..." class="chosen-select form-control" multiple tabindex="4" name="multiLop[]">
            <?php
            for($i=1; $i<=12; $i++){ ?>
                <option value="<?php echo 'Lớp '.$i; ?>" <?php if(in_array("Lớp $i", $val)) echo "selected";?>><?php echo 'Lớp '.$i; ?></option>
                <?php
            } ?>
            <option value='Luyện thi đại học' <?php if(in_array('Luyện thi đại học', $val)) echo "selected";?>>Luyện thi đại học</option>
            <option value='Luyện thi HS giỏi' <?php if(in_array('Luyện thi HS giỏi', $val)) echo "selected";?>>Luyện thi HS giỏi</option>
        </select>
        <?php
    }

    public static function showLopNonMulti($val="") { ?>
        <?php //var_dump($val); var_dump(in_array(1, $val)); ?>
        <select data-placeholder="Chọn lớp học..." class="form-control" name="slLop">
            <?php
            for($i=1; $i<=12; $i++){ ?>
                <option value="<?php echo 'Lớp '.$i; ?>" <?php if($val=="Lớp $i") echo "selected";?>><?php echo 'Lớp '.$i; ?></option>
                <?php
            } ?>
            <option value='Luyện thi đại học' <?php if($val=='Luyện thi đại học') echo "selected";?>>Luyện thi đại học</option>
            <option value='Luyện thi HS giỏi' <?php if($val=='Luyện thi HS giỏi') echo "selected";?>>Luyện thi HS giỏi</option>
        </select>
        <?php
    }


    public static function showMon($val=array()) { ?>
        <select data-placeholder="Chọn môn học..." class="chosen-select form-control form-hg" multiple tabindex="4" name="multiMon[]">
            <option value="Toán học" <?php if(in_array('Toán học', $val)) echo "selected";?>>Toán học</option>
            <option value="Vật lý" <?php if(in_array('Vật lý', $val)) echo "selected";?>>Vật lý</option>
            <option value="Hóa học" <?php if(in_array('Hóa học', $val)) echo "selected";?>>Hóa học</option>
            <option value="Sinh học" <?php if(in_array('Sinh học', $val)) echo "selected";?>>Sinh học</option>
            <option value="Tiếng Anh" <?php if(in_array('Tiếng Anh', $val)) echo "selected";?>>Tiếng Anh</option>
            <option value="Tiếng Pháp" <?php if(in_array('Tiếng Pháp', $val)) echo "selected";?>>Tiếng Pháp</option>
            <option value="Tin học" <?php if(in_array('Tin học', $val)) echo "selected";?>>Tin học</option>
        </select>
        <?php
    }


    public static function showMonNonMulti($val="") { ?>
        <select data-placeholder="Chọn môn học..." class="form-control form-hg" name="slMon" id="slMon">
            <option value="" <?php if($val=='') echo "selected";?>>Chọn môn học</option>
            <option value="Toán học" <?php if($val=='Toán học') echo "selected";?>>Toán học</option>
            <option value="Vật lý" <?php if($val=='Vật lý') echo "selected";?>>Vật lý</option>
            <option value="Hóa học" <?php if($val=='Hóa học') echo "selected";?>>Hóa học</option>
            <option value="Sinh học" <?php if($val=='Sinh học') echo "selected";?>>Sinh học</option>
            <option value="Tiếng Anh" <?php if($val=='Tiếng Anh') echo "selected";?>>Tiếng Anh</option>
            <option value="Tiếng Pháp" <?php if($val=='Tiếng Pháp') echo "selected";?>>Tiếng Pháp</option>
            <option value="Tin học" <?php if($val=='Tin học') echo "selected";?>>Tin học</option>
        </select>
        <?php
    }

    public static function showNamKinhNghiem($val='') { ?>
        <select name='slNamKN' id="slNamKN" class='form-control form-hg'>
            <option value="0">Chưa có KN</option>
            <?php
            for($i=1; $i<=20; $i++){ ?>
                <option value="<?php echo $i; ?>" <?php if($val==$i) echo "selected";?>><?php echo $i.' năm'; ?></option>
                <?php
            } ?>
        </select>
        <?php
    }

    public static function showTime($val=array()) { ?>
        <?php //var_dump($val); var_dump(in_array(1, $val)); ?>
        <select data-placeholder="Khoảng thời gian dạy..." class="chosen-select form-control" multiple tabindex="4" name="multiTime[]">
            <?php
            for($i=1; $i<=24; $i++){ ?>
                <option value="<?php echo $i.' giờ'; ?>" <?php if(in_array("$i giờ", $val)) echo "selected";?>><?php echo $i.' giờ'; ?></option>
                <?php
            } ?>
        </select>
        <?php
    }

    public static function showDay($val=array()) { ?>
        <?php //var_dump($val); var_dump(in_array(1, $val)); ?>
        <select data-placeholder="Dạy được ngày (ví dụ: thứ 2, 4, 6)..." class="chosen-select form-control" multiple tabindex="4" name="multiDay[]">
            <?php
            for($i=2; $i<=7; $i++){ ?>
                <option value="<?php echo 'Thứ '.$i; ?>" <?php if(in_array("Thứ $i", $val)) echo "selected";?>><?php echo 'Thứ '.$i; ?></option>
                <?php
            } ?>
            <option value="Chủ nhật" <?php if($val=='Chủ nhật') echo "selected";?>>Chủ nhật</option>
        </select>
        <?php
    }

    public static function configPagination(){
        $config['prev_link']  = '&laquo;';
        $config['next_link']  = '&raquo;';
        $config['last_link']  = 'Cuối';
        $config['first_link'] = 'Đầu';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        return $config;
    }

    /*public static function showTinh() { ?>
        <select name='slTinh' class='form-control'>
                <option value="">Chọn Tỉnh thành</option>
                <?php
                $this->load->database();
                $q=$this->db->get('tinh')->result();
                foreach ($q as $row) { ?>
                    <option value="<?php echo $row->TENTINH; ?>"><?php var_dump($q); echo $row->TENTINH; ?></option>
                    <?php
                } ?>
        </select>
        <?php
    }*/
    public static function checkNgay($val=array()){ ?>
        <div class="checkbox">
            <label><input type="checkbox" name="checkNgay[]" value="Thứ 2" <?php if(in_array('Thứ 2', $val)) echo "checked"?>>Thứ 2, &nbsp;</label>
            <label><input type="checkbox" name="checkNgay[]" value="Thứ 3" <?php if(in_array('Thứ 3', $val)) echo "checked"?>>Thứ 3, &nbsp;</label>
            <label><input type="checkbox" name="checkNgay[]" value="Thứ 4" <?php if(in_array('Thứ 4', $val)) echo "checked"?>>Thứ 4, &nbsp;</label>
            <label><input type="checkbox" name="checkNgay[]" value="Thứ 5" <?php if(in_array('Thứ 5', $val)) echo "checked"?>>Thứ 5, &nbsp;</label>
            <label><input type="checkbox" name="checkNgay[]" value="Thứ 6" <?php if(in_array('Thứ 6', $val)) echo "checked"?>>Thứ 6, &nbsp;</label>
            <label><input type="checkbox" name="checkNgay[]" value="Thứ 7" <?php if(in_array('Thứ 7', $val)) echo "checked"?>>Thứ 7, &nbsp;</label>
            <label><input type="checkbox" name="checkNgay[]" value="Chủ nhật" <?php if(in_array('Chủ nhật', $val)) echo "checked"?>>CN </label>
        </div>
        <?php
    }

    public static function getIconImg($mon){
        switch ($mon) {
            case 'Toán học':
                return './img/iconToan.png';
                break;
            case 'Vật lý':
                return './img/iconLy.png';
                break;
            case 'Hóa học':
                return './img/iconHoa.png';
                break;
            case 'Sinh học':
                return './img/iconSinh.png';
                break;
            case 'Tiếng Anh':
                return './img/iconAnh.png';
                break;
            case 'Tiếng Pháp':
                return './img/iconPhap.png';
                break;
            case 'Tin học':
                return './img/iconTin.png';
                break;
            default:
                return './img/iconusermap.png';
                break;
        }
    }

//_______________PH_______________

    public static function showLop_ph($val='') { ?>
        <?php //var_dump($val); var_dump(in_array(1, $val)); ?>
        <select data-placeholder="Chọn lớp học..." class="form-control form-hg" name="slClass">
            <option value="">--- Chọn lớp ---</option>
            <?php
            for($i=1; $i<=12; $i++){ ?>
                <option value="<?php echo 'Lớp '.$i; ?>" <?php if($val == "Lớp $i") echo "selected";?>><?php echo 'Lớp '.$i; ?></option>
                <?php
            } ?>
            <option value='Luyện thi đại học' <?php if($val == 'Luyện thi đại học') echo "selected";?>>Luyện thi đại học</option>
            <option value='Luyện thi HS giỏi' <?php if($val == 'Luyện thi HS giỏi') echo "selected";?>>Luyện thi HS giỏi</option>
        </select>
        <?php
    }

    public static function showMon_ph($val='') { ?>
        <select  class="form-control form-hg" name="slSubject">
            <option value="">--- Chọn môn ---</option>
            <option value="Toán học" <?php if($val=='Toán học') echo "selected";?>>Toán học</option>
            <option value="Vật lý" <?php if($val=='Vật lý') echo "selected";?>>Vật lý</option>
            <option value="Hóa học" <?php if($val=='Hóa học') echo "selected";?>>Hóa học</option>
            <option value="Sinh học" <?php if($val=='Sinh học') echo "selected";?>>Sinh học</option>
            <option value="Tiếng Anh" <?php if($val=='Tiếng Anh') echo "selected";?>>Tiếng Anh</option>
            <option value="Tiếng Pháp" <?php if($val=='Tiếng Pháp') echo "selected";?>>Tiếng Pháp</option>
            <option value="Tin học" <?php if($val=='Tin học') echo "selected";?>>Tin học</option>
        </select>
        <?php
    }


    public static function showSoLuong($val='') { ?>
        <select name='slMount' id="soLuong" class='form-control form-hg'>
            <option value="">--- Chọn số lượng ---</option>
            <?php
            for($i=1; $i<=100; $i++){ ?>
                <option value="<?php echo $i; ?>" <?php if($val==$i) echo "selected";?>><?php echo $i.' người'; ?></option>
                <?php
            } ?>
        </select>
        <?php
    }


    public static function showBuoiMuti($val=""){ ?>
        <seclect class="chosen-select form-control" multiple tabindex="4" name="sl_multe_time">
            <?php
            for($i=2; $i<=7; $i++){ ?>
                <option value="<?php echo $i; ?>" <?php if($val==$i) echo "selected";?>><?php echo 'Thứ '.$i; ?></option>
                <?php
            } ?>
            <option value="-1">Chủ nhật</option>
        </select>
        <?php
    }

    public static function checkBuoiHoc($val=array()){ ?>
        <div class="checkbox">
            <label><input type="checkbox" name="checkBuoi[]" value="Thứ 2" <?php if(in_array('Thứ 2', $val)) echo "checked"?>>Thứ 2, </label>
            <label><input type="checkbox" name="checkBuoi[]" value="Thứ 3" <?php if(in_array('Thứ 3', $val)) echo "checked"?>>Thứ 3, </label>
            <label><input type="checkbox" name="checkBuoi[]" value="Thứ 4" <?php if(in_array('Thứ 4', $val)) echo "checked"?>>Thứ 4, </label>
            <label><input type="checkbox" name="checkBuoi[]" value="Thứ 5" <?php if(in_array('Thứ 5', $val)) echo "checked"?>>Thứ 5, </label>
            <label><input type="checkbox" name="checkBuoi[]" value="Thứ 6" <?php if(in_array('Thứ 6', $val)) echo "checked"?>>Thứ 6, </label>
            <label><input type="checkbox" name="checkBuoi[]" value="Thứ 7" <?php if(in_array('Thứ 7', $val)) echo "checked"?>>Thứ 7, </label>
            <label><input type="checkbox" name="checkBuoi[]" value="CN" <?php if(in_array('CN', $val)) echo "checked"?>> CN </label>
        </div>
        <?php
    }

    //___________________________________

}
?>