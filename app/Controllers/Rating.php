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
    public function speclist($type= "rating"):string
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
            ->join("dataSpec","dataSpec.op=edSpecs.id","left")
            ->join("edFaculties","edSpecs.facultyID = edFaculties.id","left")
            ->join("edForms","edSpecs.edForm = edForms.id","left")
            ->join("edLevels","edSpecs.edLevel = edLevels.id","left")

            ->where("edSpecs.places>",0)
            ->where("dataSpec.day","all")

            ->select("edSpecs.*,edSpecs.id specID")
            ->select("dataSpec.*")
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
                    "id"        => $row->facultyID,
                    "name"      => $row->FacultyAlias??$row->FacultyName,
                    "levels"    => [],
                ];

            if(!isset($list[$row->facultyID]->levels[$row->edLevel]))
                $list[$row->facultyID]->levels[$row->edLevel]  = (object)[
                    "id"        => $row->edLevel,
                    "name"      => $row->Level,
                    "specs"     => [],
                ];

            if(!isset($list[$row->facultyID]->levels[$row->edLevel]->specs[$row->code]))
                $list[$row->facultyID]->levels[$row->edLevel]->specs[$row->code]  = (object)[
                    "id"        => $row->code,
                    "name"      => $row->name,
                    "profiles"  => [],
                    "details"   => (object)[
                        "places"    => 0,
                        "pr1"       => 0,
                        "pr2"       => 0,
                        "pr3"       => 0,
                        "pr4"       => 0,
                        "pr5"       => 0,
                        "other"     => 0,
                        "total"     => 0,
                    ]
                ];

            $list[$row->facultyID]->levels[$row->edLevel]->specs[$row->code]->profiles[$row->specID]    = $row;

            foreach ($list[$row->facultyID]->levels[$row->edLevel]->specs[$row->code]->details as $filed=>$value)
                $list[$row->facultyID]->levels[$row->edLevel]->specs[$row->code]->details->{$filed}+= $row->{$filed};

        }

        $facultyID = current($list)->id;

        $pageContent    = view("public/Rating/Faculties",[
            "list"          => $list,
            "facultyID"     => $facultyID,
            "specListType"      => $type,
        ]);

        $includes=(object)[
            'js'=>[
                "js/public/rating.js",
                "js/public/specs-filter.js"
            ],
            'css'=>[
                "css/public/ratings.css",
                "css/public/spec-list.css"
            ],
        ];
        return view("public/page",[
            "pageContent"       => $pageContent,
            "includes"          => $includes,
        ]);

    }

}