<?php
/**
 * Created by PhpStorm.
 * User: Tian Chen
 * Date: 2018/4/6
 * Time: 17:21
 */

namespace classes;


/**  Define a Read Filter class implementing \PhpOffice\PhpSpreadsheet\Reader\IReadFilter  */
class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    private $column;
    public function __construct($column)
    {
        $this->column = $column;
    }

    public function readCell($column, $row, $worksheetName = '') {
        //  Read rows 1 to 7 and columns A to E only
//        if ($row >= 1 && $row <= 7) {
//
//        }
        if (in_array($column,range($this->column,$this->column))) {
            return true;
        }
        return false;
    }
}