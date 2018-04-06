<?php
/**
 * Created by PhpStorm.
 * User: Tian Chen
 * Date: 2018/4/6
 * Time: 17:18
 */

namespace classes;

class ReadExcel
{
    private $cloumn;

    public function setColumn($column)
    {
        $this->cloumn = $column;
    }

    public function getEmail($inputFileName)
    {
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
        $email_group = array();
        /**  Create an Instance of our Read Filter  **/
        $filterSubset = new MyReadFilter($this->cloumn);

        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Tell the Reader that we want to use the Read Filter  **/
        $reader->setReadFilter($filterSubset);
        /**  Load only the rows and columns that match our filter to Spreadsheet  **/
        $excel = $reader->load($inputFileName);

        foreach($excel->getWorksheetIterator() as $sheet)
        {
            //逐行处理
            foreach($sheet->getRowIterator() as $row)
            {
                //获取excel中数据的索引值，从1开始，excel中第一行返回1，第二行返回2，依次往下...
                //echo $row->getRowIndex();
                //逐列读取
                foreach($row->getCellIterator() as $cell)
                {
                    //获取cell中数据
                    $data = $cell->getValue();
//                echo $data . '<br/>';
                    $email_group[] = $data;
                }
//            echo '<hr/>';
            }
        }

        return $email_group;
    }
}

