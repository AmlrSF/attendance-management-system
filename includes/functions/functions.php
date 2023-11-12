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
        
        
        if($url === null){
            $url = 'index.php';
            $link = 'Homepage';
        }else{
            if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
                $url = $_SERVER['HTTP_REFERER'];
                $link = 'previous page'; 
            }else{
                $url = 'index.php';
                $link = 'Homepage';
            }
            
        }

       

        echo '<div class="alert  alert-info mt-3">'.$theMsg.'<strong>'.$link.'</strong> '.$seconds.' seconds</div>';
        
        header("refresh:$seconds; url=$url");

        exit();
    }
