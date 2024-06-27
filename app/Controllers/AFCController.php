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

        $data->totalApp= $this->afc->db->table($this->afc->table)->get()->getNumRows();
        $data->methodSubmitting= (object)[
            "total"=> $this->afc->getAFC("methodSubmitting",false,false,false,["methodSubmitting!="=>""],false,['methodSubmitting']),
            "byDate"=> $this->afc->getAFC("methodSubmitting",false,true,false,["methodSubmitting!="=>""],false,['methodSubmitting']),
            "byDateTime"=> $this->afc->getAFC("methodSubmitting",false,false,true,["methodSubmitting!="=>""],false,['methodSubmitting']),
        ];
        $data->edForms= (object)[
            "total"=> $this->afc->getAFC("specShape",false,false,false,["specShape!="=>""],false,['specShape']),
            "byDate"=> $this->afc->getAFC("specShape",false,true,false,["specShape!="=>""],false,['specShape']),
            "byDateTime"=> $this->afc->getAFC("specShape",false,false,true,["specShape!="=>""],false,['specShape']),
        ];

        $levels= $this->afc->getAFC("specLevel",['specID'],false,false,false,false,false);
        #test= 1;
        dd($data->totalApp,$levels);

    }


}