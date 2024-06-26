<?php

namespace App\Controllers;
use CodeIgniter\HTTP\RedirectResponse;

class AFCProcessingController extends BaseController{
    private array $data;
    public function test(){
        $this->data['edForms']= [];
        $res= $this->model->db->table("3report")->select("specShape,count(id) as cnt")->groupBy("specShape")->get()->getResult();
        foreach ($res as $rec)
            $this->data['edForms'][$rec->specShape]= $rec->cnt;

        $res= $this->model->db->table("3report")->select("appDate,specShape,count(id) as cnt")->groupBy("specShape,appDate")->orderBy("appDate")->get()->getResult();
        foreach ($res as $rec){
            if(!isset($edFormsByDay[$rec->appDate]['total']))
                $edFormsByDay[$rec->appDate]['total']= 0;
            $edFormsByDay[$rec->appDate][$rec->specShape]= $rec->cnt;
            $edFormsByDay[$rec->appDate]['total']+= $rec->cnt;
        }
        echo view("test",$this->data);
        dd($edFormsByDay);

        $res= $this->model->db->table("3report")->select("count(id) as cnt, specName, specCode, specLevel, specShape")->groupBy("specCode")->get()->getResult();
        dd($res);

        $res= $this->model->db->table("3report")->select("count(id) as cnt, specID, specName, specCode, specLevel, specShape")->groupBy("specID")->get()->getResult();
        dd($res);

    }


}