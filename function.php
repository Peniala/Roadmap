<?php

function createProject(){
    if(isset($_GET['name'])){

        $connex = new mysqli("localhost","mit","123456","Roadmap");

        if($connex->error){
            die;
        }
        else{
            $name = $_GET['name'];
            $target = $_GET['target'];
            $deadline = $_GET['deadline'];
            
            // echo $name." ".$target." ".$deadline;

            $cmd = "insert into Projects (name,target,deadline) values ('".$_GET['name']."','".$_GET['target']."','".$_GET['deadline']."')";
            // $cmd = "insert into Projects (name,target,deadline) values ('Exercice','Finir','2024-04-15')";
            
            $connex->query($cmd);
            
            $id_project = $connex->query("select id_project from Projects where name = '".$_GET['name']."'");

            $id = mysqli_fetch_assoc($id_project);

            $id_p = $id["id_project"];

            $i = 1;

            $step = "step".$i;

            while(isset($_GET[$step])){
                
                $descri = "descri".$i;
                $prio = "prio".$i;

                $connex->query("insert into Steps ( name,descri,priority,id_project) values ('".$_GET[$step]."','".$_GET[$descri]."','".$_GET[$prio]."','".$id_p."')");

                $i++;

                $step = "step".$i;
            }
            $connex->close();

        }

    }
}

function listeProjects(){
    $connex = new mysqli("localhost","mit","123456","Roadmap");

    if($connex->error){
        die;
    }

    $list = $connex->query("select * from Projects");

    $ls = [[]];

    while($l = mysqli_fetch_assoc($list)){
        $ls[] = $l;
    }

    $connex->close();

    return $ls;
}

function listeSteps($id_p){
    $connex = new mysqli("localhost","mit","123456","Roadmap");

    if($connex->error){
        die;
    }

    $list = $connex->query("select * from Steps where id_project = '".$id_p."'");

    $ls = [[]];

    while($l = mysqli_fetch_assoc($list)){
        $ls[] = $l;
    }

    $connex->close();

    return $ls;
}

function verifyDone($s){
    if($s == "done"){
        echo "checked disabled";
    }
}

function updateSteps(){
    if(isset($_GET["step"]) && isset($_GET["stat"])){
        $connex = new mysqli("localhost","mit","123456","Roadmap");

        if($connex->error){
            die;
        }

        $connex->query("update Steps set status = 'done' where id_step = ".$_GET["step"]);

        $connex->close();
    }
}

function countStepDone($id_p){
    $connex = new mysqli("localhost","mit","123456","Roadmap");

    if($connex->error){
        die;
    }
    
    $c = mysqli_fetch_assoc($connex->query("select count(*) from Steps where status = 'done' and id_project = ".$id_p));

    $connex->close();

    return $c["count(*)"];

}

function countStep($id_p){
    $connex = new mysqli("localhost","mit","123456","Roadmap");

    if($connex->error){
        die;
    }
    
    $c = mysqli_fetch_assoc($connex->query("select count(*) from Steps where id_project = ".$id_p));

    $connex->close();

    return $c["count(*)"];
}

function getPriority($p){
    if($p === 1){
        echo "Important and exigent step";
    }
    else if($p === 2){
        echo "Less important but exigent step";
    }
    else{
        echo "Less important and less exigent step";
    }
}
?>