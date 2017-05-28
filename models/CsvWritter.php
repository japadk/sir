<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\models;
/**
 * Description of CsvWritter
 *
 * @author Marcelo
 */
class CsvWritter {

    private $collumns;
    private $fileName;
    private $cellData;
    private $content;

    function __construct($name, $collumns=[],$data=[]) {
        $this->fileName = $name;
        $this->collumns = $collumns;
        $this->cellData=$data;
    }
    
    public function getCollumns() {
        return $this->collumns;
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function getCellData() {
        return $this->cellData;
    }

    public function getContent() {
        return $this->content;
    }

        
    function addCollumns($collumns){
        if(is_array($collumns)){
            $this->collumns = array_merge($this->collumns,$collumns);
        }else{
            $this->collumns[] = $collumns;            
        }
    }
    
    function addCellData($data){
        if(is_array($data)){
            $this->cellData = array_merge($this->cellData,$data);
        }else{
            $this->cellData[] = $data;            
        }
    }
    
    function save(){
        
        $this->content = 'sep=;'."\n";
        
        foreach($this->collumns as $collumn){
            $this->content .= $collumn . ';';
        }
        $this->content .= "\n" ;
        
        $cn = count($this->collumns);
//        $cdn = count($this->cellData);
        
        $i = 0;
        foreach($this->cellData as $cell){
            
            $i++;
            $this->content .= $cell . ';';
            if($i == $cn){
                $this->content .= "\n";
                $i = 0;
            }
            
        }
        
        
         $file = fopen($this->fileName, 'w');
//         fwrite($file, "0xEF, 0xBB, 0xBF");
         fwrite($file,chr(0xEF).chr(0xBB).chr(0xBF).$this->content);
         fclose($file);
    }

}

?>
