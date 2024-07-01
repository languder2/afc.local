<?php

namespace App\Controllers;
use App\Models\AFCModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class AFCController extends BaseController{
    private AFCModel $afc;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger); // TODO: Change the autogenerated stub
        $this->afc= model(AFCModel::class);
    }

    public function test(){
        $data= (object)[];


        $data->specs= $this->afc->getAFC(["specName","specProfile"],false,false,false,["specCode!="=>""],'specName',false);
        $this->afc->getValuesByList($data->specs,"codes",["specName","specProfile"],["specCode","COUNT(id) as cnt"],["specCode"]);
        $this->afc->getValuesByList($data->specs,"forms",["specName","specProfile"],["specShape","COUNT(id) as cnt"],["specCode"]);
        $this->afc->getValuesByList($data->specs,"levels",["specName","specProfile"],["specLevel","COUNT(id) as cnt"],["specCode"]);

        //$data->specs= $this->afc->getAFC("specCode",["specLevel","specShape","specName","specProfile"],false,false,["specCode!="=>""],'specCode',false);

        $data->totalApp= $this->afc->db->table($this->afc->table)->get()->getNumRows();
        $data->methodSubmitting= (object)[
            "total"=> $this->afc->getAFC("methodSubmitting",false,false,false,["methodSubmitting!="=>""],false,['methodSubmitting']),
//            "byDate"=> $this->afc->getAFC("methodSubmitting",false,true,false,["methodSubmitting!="=>""],false,['methodSubmitting']),
//          "byDateTime"=> $this->afc->getAFC("methodSubmitting",false,false,true,["methodSubmitting!="=>""],false,['methodSubmitting']),
        ];
        $data->edForms= (object)[
            "total"=> $this->afc->getAFC("specShape",false,false,false,["specShape!="=>""],false,['specShape']),
//            "byDate"=> $this->afc->getAFC("specShape",false,true,false,["specShape!="=>""],false,['specShape']),
//            "byDateTime"=> $this->afc->getAFC("specShape",false,false,true,["specShape!="=>""],false,['specShape']),
        ];

        $data->levels= $this->afc->getAFC("specLevel",false,false,false,false,false,false);
        $data->basis= $this->afc->getAFC("appBasis",false,false,false,["appBasis!="=>""],false,['appBasis']);
        $data->appStatus= $this->afc->getAFC("appStatus",false,false,false,false,false,false);
        $data->citizenship= $this->afc->getAFC("citizenship",false,false,false,false,false,false);
        $data->uStatus= $this->afc->getAFC("uStatus",false,false,false,false,false,false);
        $data->approval= $this->afc->getAFC("approval",false,false,false,false,false,false);

        return view("public/afc/Main",(array)$data);

    }

    public function summary():string|bool
    {
        $data= (object)[];
        $data->specs= $this->afc->getAFC(["specName","specProfile"],['specID'],["specCode!="=>""],'specName',false);
        $data->pageContent= view("public/afc/SpecsList",["list"=>$data->specs]);
        return  view("public/page",["pageContent"=>$data->pageContent]);
    }

    public function chartSpecByDays($specID):string|bool
    {
        $spec= $this->afc->db
            ->table($this->afc->table)
            ->select(["specName","specProfile"])
            ->where("specID",$specID)
            ->get()->getFirstRow("array");
        $totalRows= $this->afc->getAFC(["appDate"],false,$spec,"appDateTime",true);
        $formKeys= $this->afc->getAFC(["specShape"],false,$spec,"appDateTime");
        $formRows= $this->afc->getAFC(["appDate","specShape"],false,$spec,"appDateTime",true,"specShape",false);
        $levelKeys= $this->afc->getAFC(["specLevel"],false,$spec,"appDateTime");
        $levelRows= $this->afc->getAFC(["appDate","specLevel"],false,$spec,"appDateTime",true,"specLevel",false);

        $totals= [];
        $forms= [];
        $levels= [];

        $dates = $this->model->get_dates('2024-06-20', date("Y-m-d"),"d.m");
        foreach ($dates as $dk=>$day){
            $dates[$dk]= "'$day'";
            $totals[$day]= $totalRows[$day]??0;
            foreach ($formKeys as $key=>$row)
                $forms[$key][$day]= $formRows[$day][$row->specShape]??0;
            foreach ($levelKeys as $key=>$row)
                $levels[$key][$day]= $levelRows[$day][$row->specLevel]??0;
        }
        $formColors= [];
        foreach ($formKeys as $key=>$row){
            $formColors[$key]= $this->model->colors[$row->specShape];
        }

        $levelColors= [];
        foreach ($levelKeys as $key=>$row){
            $levelColors[$key]= $this->model->colors[$row->specLevel];
        }

        $dates= implode(",",$dates);
        $data= [
            "spec"=> (object)$spec,
            "dates"=>$dates,
            "totals"=>$totals,
            "formTitles"=>$formKeys,
            "forms"=>$forms,
            "levelTitles"=>$levelKeys,
            "levels"=>$levels,
            "formColors"=>$formColors,
            "levelColors"=>$levelColors,
            "formRows"=>$formRows,
            "levelRows"=>$levelRows,
        ];
        $pageContent= view("public/afc/SpecChart",$data);
        return  view("public/page",["pageContent"=>$pageContent]);
    }


}