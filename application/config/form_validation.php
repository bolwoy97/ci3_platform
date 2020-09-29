<?php
$config = array(
    'register' => array(
        array('field' => 'login','label' => 'Login',
        'rules' => 'trim|required|min_length[5]|max_length[30]|is_unique[users.login]|alpha_numeric'
        ),
        array('field' => 'email','label' => 'Email',
        'rules' => 'trim|required|valid_email|is_unique[users.email]|ends_with[@gmail.com]'
        ),
        array('field' => 'password','label' => 'Password',
        'rules' => 'trim|required|min_length[6]|matches[rpassword]'
        ),
        array('field' => 'rpassword','label' => 'Confirm password',
            'rules' => 'trim|required|min_length[6]'
                            ),     
        array('field' => 'terms','label' => '"Я согласен с правилами и условиями"',
                            'rules' => 'trim|required'
                                            ),        
        ),


    'login' => array(
                        array('field' => 'login','label' => 'Login',
                        'rules' => 'trim|required'
                        ),
                        array('field' => 'password','label' => 'Password',
                        'rules' => 'trim|required'
                        ),             
            ),


    'password_reset' => array(
                array('field' => 'password','password' => 'Password',
                'rules' => 'trim|required|min_length[6]|matches[rpassword]'
                ),
                array('field' => 'rpassword','label' => 'Confirm password',
                    'rules' => 'trim|required|min_length[6]'
                                    ),  
                ),   
                
                
                            
  );


 
   