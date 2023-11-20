<?php 

    //? get title for evrey page
    function getTitle(){
        global $pageTitle;

        if(isset($pageTitle)){
            echo $pageTitle;
        }else{
            echo 'Default';
        }
    }

    //? redirect to home or other page
    function redirectHome($theMsg ,$url = null,$seconds = 3){
        
        $link = "";
        if($url === null){
            $url = 'index.php';
            $link = 'Homepage';
        }else{
            if($url == 'back'){
                $url = $_SERVER['HTTP_REFERER'];
                $link = 'previous page'; 
            }else{
                $link = str_replace(".php", "", $url);
            }
            
        }

        echo '<div class="alert  alert-info mt-3"> '.$theMsg.' <strong>'.$link.'</strong> '.$seconds.' seconds</div>';
        
        header("refresh:$seconds; url=$url");

        exit();
    }
