<?php
    //database connection in the other file 
    include_once 'database.php';

    //change time 
    if (isset($_POST["issuesubmit"])){

        print_r($_POST);
        $length=count($_POST["tab"]);
        $returnResult= $_POST["tab"];


        $tab_array= array();
        for ($i = 0; $i < $length; $i++){
            $each_array = $returnResult[$i];
            $tid = $each_array['tid'];
            array_push($tab_array, $tid);
        }

        $tab_array_unique = array_unique($tab_array);
        if ( $tab_array_unique === $tab_array){
            for ($i = 0; $i < $length; $i++){
                $each_array = $returnResult[$i];
                $tid = $each_array['tid'];
                $person = $each_array['person'];
                $projectID = $each_array['projectID'];
                $dateissue = $each_array['dateissue'];

                if ($tid == NULL or $person == NULL or $projectID == NULL or $dateissue == NULL){
                    header("Location: ../subpages/taballoc.php?value=toissue&error=emptyinputs");
                    exit();
                }

                $sqlcommand = "insert into taballoc (tID, person, dateIssue, 
                                issued, dateReturn, projectID, comment)  
                values ('$tid', '$person', '$dateissue', True, Null, '$projectID', Null);";

                mysqli_query($connection,$sqlcommand);
            }
            header("Location: ../subpages/taballoc.php?value=toissue");
            exit();
        }else{
            header("Location: ../subpages/taballoc.php?value=toissue&error=sametab");
            exit();
        }
    }
    else if(isset($_POST["returnsubmit"])){
        print_r($_POST);  
        $all_taID_array=$_POST["taID"];
        $all_datareturn_array=$_POST["datereturn"];
        $all_comment_array=$_POST["comments"];

        $returned_taID=array_keys($_POST["checkbox"]);

        $return_taID_index=array();

        foreach ($returned_taID as $each_taID){
            $index = array_search($each_taID, $all_taID_array);
            if (isset($index)){
                array_push($return_taID_index, $index);
            }
        }
        foreach ($return_taID_index as $each_index){
            $taID=$all_taID_array[$each_index];
            $dateReturn = $all_datareturn_array[$each_index];
            $comment = $all_comment_array[$each_index];

            $sqlcommand = "update taballoc tID set issued='false', dateReturn='$dateReturn', 
            comment='$comment' where taID='$taID'; ";
            
            mysqli_query($connection,$sqlcommand);
        }
        header("Location: ../subpages/taballoc.php?value=toreturn");
        exit();

    }