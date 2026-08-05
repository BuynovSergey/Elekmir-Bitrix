<?php
class HLBlock {
    private $object;

    function __construct($HB, $tableName = false){
        if(!$HB) return;
        CModule::IncludeModule("highloadblock");

        if($tableName) {
            $HLBLOCK_DATA = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('=TABLE_NAME' => $HB)))->fetch();
        } else {
            $HLBLOCK_DATA = \Bitrix\Highloadblock\HighloadBlockTable::getById($HB)->fetch();
        }
        $HLBLOCK_ENTITY = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($HLBLOCK_DATA);
        $this->object = $HLBLOCK_ENTITY->getDataClass();        
    }

    public function addData($data = array()){
        $res = false;
        foreach ($data as $dt) {
            $hb = $this->object;
            $result = $hb::add($dt);
            if ($result->isSuccess()) {
                $res = $result->getId();;
            }
            /*else {
                echo 'ERROR ADDED ';
                print_r($result->getErrors());
            }*/
        }
        return $res;
    }

    public function getData($select = array(''), $filter = array(), $order = array(), $limit = false){
        $hb = $this->object;
        $data = $hb::getList(
            array(
                "select" => $select,
                "order" => $order,
                "filter" => $filter,
                "limit" => $limit
            )
        );

        $result = array();
        while ($arData = $data->Fetch()){
            $result[] = $arData;
        }
        return $result;
    }

    public function  delete($id) {
        $result = true;
        if($id > 0) {
            $hb = $this->object;
            $result = $hb::delete($id);
            if(!$result->isSuccess()){ //произошла ошибка
                $errMsg = $result->getErrorMessages(); //выведем ошибку
                $result = false;
            }
        }

        return $result;
    }
	
	public function update($id, $data){
        $result = true;
        if($id > 0) {
            $hb = $this->object;
            $result = $hb::update($id, $data);
            if(!$result->isSuccess()){
                //$errMsg = $result->getErrorMessages();
                $result = false;
            }
        }

        return $result;
    }
}