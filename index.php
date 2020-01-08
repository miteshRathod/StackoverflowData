<?php

function editWorkspaceJsData($post,$db_doutor){
    $result['failed_reason'] = '';
    $private_path = '../../books/';        
    $book_id = $post['bid'];
    $text = $post['text'];
    $final_array = array();
    $m = 0;
    $text = str_replace('\n\n<', '\n>', $text);
    
    $parents = explode('\n\n',$text);
    foreach ($parent as $children) 
    {
        
        $final_array1 = $final_array4 = $final_array5 = $final_array3 = array();
        if(strpos($children, '\n') !== false)
        {
            $final_array2 = explode('\n>',$children,2);
            $temp_array = explode('=',$final_array2[0]);
            $final_array1['title'] = trim($temp_array[0]);
            $final_array1['page'] = (int)trim($temp_array[1]);

            if($final_array1['page'] == '' || $final_array1['title'] == '')
            {
                $result['status'] = "failed";
                echo json_encode($result);
                die();
            }
            //echo $final_array4;
            $final_array4 = explode('\n>',$final_array2[1]);
            // echo "<pre>";
            // print_r($final_array4);
            //print_r($final_array4);
            $i = $j = $k = $l = 0;
            foreach ($final_array4 as $sub_child) 
            {
                
                //echo "<br>";
                $sub_child_final = array(); 
                
                if(strpos($sub_child, '\n&tab;>') !== false)
                {
                    $explode_array = explode('\n&tab;>',$sub_child,2);
                   
                    $temp_array = explode('=',$explode_array[0]);

                    $final_array1['children'][$i]['title'] = trim($temp_array[0]);
                    $final_array1['children'][$i]['page'] = (int)trim($temp_array[1]);

                    if($final_array1['children'][$i]['title'] == '' || $final_array1['children'][$i]['page'] == '')
                    {
                        $result['status'] = "failed";
                        echo json_encode($result);
                        die();
                    }

                    $sub_children1 = explode('\n&tab;>',$explode_array[1]);
                    

                    foreach ($sub_children1 as $sub_child2) 
                    {
                        $sub_child_final3 = array();
                        //$j = 0;
                        if(strpos($sub_child2, '\n&tab;&tab;>') !== false)
                        {
                            $explode_array = explode('\n&tab;&tab;>',$sub_child2,2);
                            $temp_array = explode('=',$explode_array[0]);

                            $final_array1['children'][$i]['children'][$j]['title'] = trim($temp_array[0]);
                            $final_array1['children'][$i]['children'][$j]['page'] = (int)trim($temp_array[1]);
                           
                            if($final_array1['children'][$i]['children'][$j]['title'] == '' || $final_array1['children'][$i]['children'][$j]['page'] == '')
                            {
                                $result['status'] = "failed";
                                echo json_encode($result);
                                die();
                            }
                            $sub_children2 = explode('\n&tab;&tab;>',$explode_array[1]);
                            
                            foreach ($sub_children2 as $sub_child3) 
                            {
                                $sub_child_final4 = array();
                               // $k = 0;
                                if(strpos($sub_child3, '\n&tab;&tab;&tab;>') !== false)
                                {
                                    $explode_array = explode('\n&tab;&tab;&tab;>',$sub_child3,2);
                                    $temp_array = explode('=',$explode_array[0]);

                                    $final_array1['children'][$i]['children'][$j]['children'][$k]['title'] = trim($temp_array[0]);
                                    $final_array1['children'][$i]['children'][$j]['children'][$k]['page'] = (int)trim($temp_array[1]);

                                    if($final_array1['children'][$i]['children'][$j]['children'][$k]['title'] == '' || $final_array1['children'][$i]['children'][$j]['children'][$k]['page'] == '')
                                    {
                                        $result['status'] = "failed";
                                        echo json_encode($result);
                                        die();
                                    }

                                    $sub_children3 = explode('\n&tab;&tab;&tab;>',$explode_array[1]);
                                    //$l = 0;
                                    foreach ($sub_children3 as $sub_child4)
                                    {
                                        $sub_child_final5 = array();
                                        //echo $sub_child4;
                                        $temp_array = explode('=',$sub_child4);
                                        
                                        $final_array1['children'][$i]['children'][$j]['children'][$k]['children'][$l]['title'] = trim($temp_array[0]);
                                        $final_array1['children'][$i]['children'][$j]['children'][$k]['children'][$l]['page'] = (int)trim($temp_array[1]);

                                        if($final_array1['children'][$i]['children'][$j]['children'][$k]['children'][$l]['title'] == '' || $final_array1['children'][$i]['children'][$j]['children'][$k]['children'][$l]['page'] == '')
                                        {
                                            $result['status'] = "failed";
                                            echo json_encode($result);
                                            die();
                                        }

                                        $l++;                
                                    }
                                    $k++;
                                }
                                else
                                {
                                    
                                    $temp_array = explode('=',$sub_child3);
                                    $final_array1['children'][$i]['children'][$j]['children'][$k]['title'] = trim($temp_array[0]);
                                    $final_array1['children'][$i]['children'][$j]['children'][$k]['page'] = (int)trim($temp_array[1]);
                                    if($final_array1['children'][$i]['children'][$j]['children'][$k]['title'] == '' || $final_array1['children'][$i]['children'][$j]['children'][$k]['page'] == '')
                                        {
                                            $result['status'] = "failed";
                                            echo json_encode($result);
                                            die();
                                        }
                                    $k++;
                                }
                                
                            }
                            $j++;
                        }
                        else
                        {
                            $temp_array = explode('=',$sub_child2);

                            $final_array1['children'][$i]['children'][$j]['title'] = trim($temp_array[0]);
                            $final_array1['children'][$i]['children'][$j]['page'] = (int)trim($temp_array[1]);
                            if($final_array1['children'][$i]['children'][$j]['title'] == '' || $final_array1['children'][$i]['children'][$j]['page'] == '')
                            {
                                $result['status'] = "failed";
                                echo json_encode($result);
                                die();
                            }
                            $j++;
                        }
                    }
                    $i++;
                }
                else
                {
                    $temp_array = explode('=',$sub_child);
                    $final_array1['children'][$i]['title'] = trim($temp_array[0]);
                    $final_array1['children'][$i]['page'] = (int)trim($temp_array[1]);  
                    if($final_array1['children'][$i]['title'] == '' || $final_array1['children'][$i]['page'] == '')
                    {
                        $result['status'] = "failed";
                        echo json_encode($result);
                        die();
                    }
                    $i++;
                }
            }
            
            $final_array[$m]=$final_array1;  
            $m++; 
        }
        else
        {
            //PArent will go here

            $temp_array = explode('=',$children);
            $final_array[$m]['title'] = trim($temp_array[0]);
            $final_array[$m]['page'] = (int)trim($temp_array[1]);
            if($final_array[$m]['title'] == '' || $final_array[$m]['page'] == '')
            {
                $result['status'] = "failed";
                echo json_encode($result);
                die();
            }
            $m++;
        }
    }
   
    $final_array6['children'] = $final_array; 
    $final_array6['enabled'] = 1;
   
    echo json_encode($final_array6);
}
