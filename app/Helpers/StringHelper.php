<?php

namespace App\Helpers;

use App\PaymentRequest;

class StringHelper {

    public static function getSelectBankOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->bank . ' - ' . $option->name . ' - ' . $option->account_number . '</option>';
        }
        return $html;
    }
    public static function getSelectBodyOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->page->brand . ' - ' . $option->name . '</option>';
        }
        return $html;
    }
    public static function getTextInput($name, $value, $options = null) {
        return '
			<div class="form-group col-md-12">
				<input type="text" name="' . $name . '" class="form-control" placeholder="" value="' . $value . '"/>
            </div>';
    }
    public static function getImageInput($name,$value,$options=null){
        $guid = '';
        if (!empty($options['guid'])) $guid = $options['guid'];
        $id = $guid.'_'.$name;
        return '
            <div class="form-group col-md-12">
				<div class="div-image">
					<input type="file" data-guid="'.$guid.'" multiple="" id="'.$id.'"data-value="'.$value.'" data-field="'.$name.'" class="file-input-overwrite" data-show-upload="false" data-show-remove="true" onclick="BrowseServer(\''.$id.'\',\''.$guid.'\')"/>
					<input type="hidden" class="image_data" data-guid="'.$guid.'" value="'.$value.'" name="'.$name.'"/>
                    <span class="help-block">Chỉ cho phép các file ảnh có đuôi <code>jpg</code>, <code>gif</code> và <code>png</code></span>
                </div>
            </div>';
    }
    public static function getSelectOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->name . '</option>';
        }
        return $html;
    }
    public static function getSelectPageOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->brand . '</option>';
        }
        return $html;
    }
    public static function getSelectOptionsTemplate($options, $selected = '')
    {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->title . '</option>';
        }
        return $html;
    }
    public static function getSelectOptionsMachine_arrangement($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->order->code . '-' .$option->patternRelation->code. '</option>';
        }
        return $html;
    }
    public static function getMachineOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->name . ' - '. $option->category . '</option>';
        }
        return $html;
    }
    public static function getPatternOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->code . '</option>';
        }
        return $html;
    }

    public static function getColorOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>'.$option->code.'-' . $option->name . '</option>';
        }
        return $html;
    }
    public static function getProductOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->code . ' - ' . $option->name . '</option>';
        }
        return $html;
    }

    public static function getSelectSupplierOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . (($option->code)?$option->code.' - ':''). $option->name . '</option>';
        }
        return $html;
    }
    public static function getSelectStockEquipmentOption($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option data-price="'.$option->price.'" value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->name . '</option>';
        }
        return $html;
    }

    public static function getSelectProjectOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->name . '</option>';
        }
        return $html;
    }
    public static function getSelectTransportOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->street->name .' ( Ngày '.date("d/m/Y", strtotime($option->date)).' )' . '</option>';
        }
        return $html;
    }
    public static function getTransportOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->street->name .' ( Ngày '.date("d/m/Y", strtotime($option->date)).' )'.' - '. $option->code . '</option>';
        }
        return $html;
    }
    public static function getMaterialOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->name .' - '. $option->code . '</option>';
        }
        return $html;
    }
    public static function getSelectVehicleOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->license_plate . '</option>';
        }
        return $html;
    }
    public static function getSelectMoocOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->number . '</option>';
        }
        return $html;
    }
    public static function getSelectTireOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->seri . '</option>';
        }
        return $html;
    }
    public static function getSelectSeriOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->seri . '</option>';
        }
        return $html;
    }
    public static function getSelectCustomerOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->name . ' - ' . $option->account_number. ' - ' . $option->categories->name  . '</option>';
        }
        return $html;
    }
    public static function getSelectCustomerOption($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->name . '</option>';
        }
        return $html;
    }
    public static function getSelectStaffOption($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>'. $option->full_name . ' - '. $option->code . '</option>';
        }
        return $html;
    }
    public static function getSelectEterket($options) {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->eterket . '"' . '>'. $option->eterket .'</option>';
        }
        return $html;
    }
    public static function getEterketOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->eterket . '"' . ((is_array($selected) ? in_array($option->eterket, $selected) : $selected == $option->eterket) ? 'selected' : '') . '>'. $option->eterket .'</option>';
        }
        return $html;
    }

    public static function getSelectAgreementOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->code . '</option>';
        }
        return $html;
    }
    public static function getSelectContractOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->code . '</option>';
        }
        return $html;
    }
    public static function getSelectProductOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->name . '</option>';
        }
        return $html;
    }

    public static function getSelectUserOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->name . ' - ' . $option->position->name . '</option>';
        }
        return $html;
    }

    public static function getSelectOrderOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->code. ' - '. $option->customer->name . '</option>';
        }
        return $html;
    }

    public static function getVehicleOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->license_plate . ' - ' . $option->tonnage. ' kg' . '</option>';
        }
        return $html;
    }

    public static function getSelectOption($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option['id'] . '"' . ((is_array($selected) ? in_array($option['id'], $selected) : $selected == $option['id']) ? 'selected' : '') . '>' . $option['name'] . '</option>';
        }
        return $html;
    }
    public static function getPlasticOption($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option['id'] . '"' . ((is_array($selected) ? in_array($option['id'], $selected) : $selected == $option['id']) ? 'selected' : '') . '>' . $option['code'] . ' - ' . $option['name'] . '</option>';
        }
        return $html;
    }
    public static function getSelectBankAccount($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->account_number .'</option>';
        }
        return $html;
    }


    public static function getStatusOption($options, $selected = '') {
        $html = '<option value="0">Chọn</option>';
        foreach ($options as $key => $option) {
            $html .= '<option value="' . $key . '"' . ((is_array($selected) ? in_array($key, $selected) : $selected == $key) ? 'selected' : '') . '>' . $option . '</option>';
        }
        return $html;
    }

    public static function getStaffSelectOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->code . ' - ' . $option->full_name . '</option>';
        }
        return $html;
    }
    public static function getStaffCustomer($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option['id'] . '"' . ((is_array($selected) ? in_array($option['id'], $selected) : $selected == $option['id']) ? 'selected' : '') . '>' . $option['name'] . '</option>';
        }
        return $html;
    }
    public static function getStaffOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->staff_id . '"' . ((is_array($selected) ? in_array($option->staff_id, $selected) : $selected == $option->staff_id) ? 'selected' : '') . '>' . $option->staff_name . ' - ' . $option->staff_phone . '</option>';
        }
        return $html;
    }
    public static function getAccessoryOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->code . ' - ' . $option->name . '</option>';
        }
        return $html;
    }
    public static function getSelectAccessoryCode($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->code . '</option>';
        }
        return $html;
    }

    public static function getCategoryOptions($options, $selected = '') {
        $html = '<option ></option>';
        foreach ($options as $option) {
            $html .= '<optgroup label="' . $option->name . '">';
            if ($option->children) {
                foreach ($option->children as $val) {
                    $html .= '<option value="' . $val->id . '"' . ((is_array($selected) ? in_array($val->id, $selected) : $selected == $val->id) ? 'selected' : '') . '>' . $val->name . '</option>';
                }
            }
        }
        return $html;
    }

    public static function getOrderOptions($options, $selected = '') {
        $html = '<option></option>';
        foreach ($options as $option) {
            $html .= '<option value="' . $option->id . '"' . ((is_array($selected) ? in_array($option->id, $selected) : $selected == $option->id) ? 'selected' : '') . '>' . $option->code .' - '. $option->customer->name. '</option>';
        }
        return $html;
    }

    public static function getOptionsHtml($options, $selected_id = 0) {
        $html = '<option></option>';
        foreach ($options as $val) {
            $html .= '<option value="' . $val['id'] . '" ' . ($selected_id == $val['id'] ? 'selected' : '') . '>' . $val['name'] . '</option>';
        }
        return $html;
    }

    public static function convert_number($number) {
        $hyphen = ' ';
        $conjunction = ' ';
        $separator = ' ';
        $negative = 'âm ';
        $decimal = ' phẩy ';
        $dictionary = array(
            0 => 'không',
            1 => 'một',
            2 => 'hai',
            3 => 'ba',
            4 => 'bốn',
            5 => 'năm',
            6 => 'sáu',
            7 => 'bảy',
            8 => 'tám',
            9 => 'chín',
            10 => 'mười',
            11 => 'mười một',
            12 => 'mười hai',
            13 => 'mười ba',
            14 => 'mười bốn',
            15 => 'mười năm',
            16 => 'mười sáu',
            17 => 'mười bảy',
            18 => 'mười tám',
            19 => 'mười chín',
            20 => 'hai mươi',
            30 => 'ba mươi',
            40 => 'bốn mươi',
            50 => 'năm mươi',
            60 => 'sáu mươi',
            70 => 'bảy mươi',
            80 => 'tám mươi',
            90 => 'chín mươi',
            100 => 'trăm',
            1000 => 'nghìn',
            1000000 => 'triệu',
            1000000000 => 'tỷ',
            1000000000000 => 'nghìn tỷ',
            1000000000000000 => 'ngàn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if ($number < 0) {
            return $negative . StringHelper::convert_number(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list( $number, $fraction ) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . StringHelper::convert_number($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = fmod($number,$baseUnit);
                $string = StringHelper::convert_number($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= StringHelper::convert_number($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

    public static function slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '', $str);
        $str = preg_replace('/---/', '', $str);
        return $str;
    }

    public static function removeVietnameseSign($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }

    public static function getAlias($str) {
        $str = strip_tags($str);
        $str = self::removeVietnameseSign($str);
        $allowed = "/[^A-Za-z0-9- ]/i";
        $str = preg_replace($allowed, '', $str);
        $str = trim($str);
        while (strpos($str, '  ') !== FALSE) {
            $str = str_replace('  ', ' ', $str);
        }
        $str = str_replace(' ', '-', $str);
        while (strpos($str, '--') !== FALSE) {
            $str = str_replace('--', '-', $str);
        }
        $str = strtolower($str);
        return $str;
    }

}
