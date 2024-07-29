<?php

namespace App\Controllers;

class Rating extends BaseController
{
    /**
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger):void
    {
        parent::initController($request, $response, $logger);
    }

    /**/
    public function speclist():string
    {
        if(!$this->session->has("auth")){
            return view("public/page",[
                "pageContent"   => view("public/Templates/Auth",[
                    "message"   => $this->session->getFlashdata("authError"),
                ]),
                "notHeaders"    =>  true,
            ]);
        }

        $rows  = $this->db
            ->table("edSpecs")
            ->join("edFaculties","edSpecs.facultyID = edFaculties.id","left")
            ->join("edForms","edSpecs.edForm = edForms.id","left")
            ->join("edLevels","edSpecs.edLevel = edLevels.id","left")

            ->where("edSpecs.places>",0)

            ->select("edSpecs.*")
            ->select("edFaculties.name FacultyName,edFaculties.alias FacultyAlias")
            ->select("edForms.name Form")
            ->select("edLevels.name Level")

            ->orderBy("edFaculties.departmentID")
            ->orderBy("edFaculties.sort")
            ->orderBy("edLevels.sort2")
            ->orderBy("edSpecs.code")

            ->get()
            ->getResult();

        $list= [];

        foreach($rows as $row){
            if(!isset($list[$row->facultyID]))
                $list[$row->facultyID]= (object)[
                    "name"      => $row->FacultyAlias??$row->FacultyName,
                    "levels"    => [],
                ];

            if(!isset($list[$row->facultyID]->levels[$row->edLevel]))
                $list[$row->facultyID]->levels[$row->edLevel]  = (object)[
                    "name"      => $row->Level,
                    "specs"     => [],
                ];

            if(!isset($list[$row->facultyID]->levels[$row->edLevel]->specs[$row->code]))
                $list[$row->facultyID]->levels[$row->edLevel]->specs[$row->code]  = (object)[
                    "name"      => $row->name,
                    "profiles"  => [],
                ];

            $list[$row->facultyID]->levels[$row->edLevel]->specs[$row->code]->profiles[$row->id]    = $row;
        }

        $pageContent    = view("public/Rating/SpecList",[
            "list"          => $list,
        ]);

        $includes=(object)[
            'js'=>[
            ],
            'css'=>[
                "css/public/ratings.css"
            ],
        ];
        return view("public/page",[
            "pageContent"       => $pageContent,
            "includes"          => $includes,
        ]);

    }

}