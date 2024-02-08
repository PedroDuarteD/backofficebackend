<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;

class ProjectController extends Controller
{
    public function all(){
        $all = array();

        $models = ProjectModel::all();
        foreach($models as $model){
            array_push($all, array("id"=> $model->id,"name"=> $model->name,"desc"=> $model->description,"prod"=> $model->production,"show"=> $model->show,));
        }

        echo json_encode($all);
    }
    public function add(Request $request){

        $name = filter_var($request["name"], FILTER_SANITIZE_STRING);
        $desc = filter_var($request["desc"], FILTER_SANITIZE_STRING);
        $prod = filter_var($request["prod"], FILTER_SANITIZE_STRING);
        $show = filter_var($request["show"], FILTER_SANITIZE_STRING);

        if(!empty($name) && !empty($desc)  ){

          

            $create = new ProjectModel();
            $create->name = $name;
            $create->description = $desc;
            $create->production = (int) $prod;
            $create->show = (int)$show;
            $create->save();

            echo json_encode(array("res"=>"Success"));

        }else{
            echo json_encode(array("res"=>"Error","ans"=>"Falta parametros !"));
        }
    }

    public function updateVisibility(Request $request){
        
        $id = filter_var($request["id"], FILTER_SANITIZE_STRING);
        $type = filter_var($request["type"], FILTER_SANITIZE_STRING);
        $value = filter_var($request["value"], FILTER_SANITIZE_STRING);
        
        if(!empty($id) && !empty($type) && $value!="" ){
            if($type=="show"){
                $model = ProjectModel::find($id);
                $model->show = $value;
                $model->save();
                echo json_encode(array("res"=>"Success"));
            }else{
                $model = ProjectModel::find($id);
                $model->production = $value;
                $model->save();
                echo json_encode(array("res"=>"Success"));
            }
         

        }else{
            echo json_encode(array("res"=>"Error"));

        }
        
        

    }

    public function deleteProject(Request $request){
        
        $id = filter_var($request["id"], FILTER_SANITIZE_STRING);
        
        if(!empty($id)  ){
                $model = ProjectModel::find($id);
                $model->delete();
                echo json_encode(array("res"=>"Success"));

        }else{
            echo json_encode(array("res"=>"Error"));

        }
        
        

    }
}
