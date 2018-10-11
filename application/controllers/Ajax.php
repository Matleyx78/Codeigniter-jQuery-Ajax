<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Ajax extends Admin_Controller 
{
    //http://developer-paradize.blogspot.it/2013/12/how-to-use-ajax-with-jquery-and.html
    //https://github.com/ThingEngineer/Codeigniter-jQuery-Ajax
    function __construct()
    {
        parent::__construct();
        $this->load->library('ajaxlib');
        $this->load->model(
                        array(
                            'Ajax_model',
                            )
                        );
        
        $this->load->helper(
                        array(
                            'url',
                            'date'
                            )
                        );
    } 

 
    /*
     * show list as a table, get data from "test_model"
     * */
    function get_list_view(){
 
        //$this->load->model('test_model');
 
        $data = array();
 
        $data['title'] = 'Lorem ipsum';
        $data['list'] = $this->Ajax_model->get_data();
 
        $this->load->view('ajax/sample_table', $data);
 
    }
 
    function index(){
        $this->load->view('ajax/test_page');
    }

	function index2()
	{
		$this->load->view('ajax/ajax_test_view');
	}

	function get_something()
	{
		

		$arr['something'] = 'Something Good';

		if ($this->input->post('something_id') == '2')
		{
			$arr['something'] = 'Something Better';
		}

		$this->ajaxlib->output_ajax($arr);
	}    

	function comuni()
	{
		$data['regionidb'] = $this->Ajax_model->get_regioni();
                $regioni = '<option value="0">scegli...</option>';
			
				foreach ($data['regionidb'] as $row)
				{
					$regioni .= '<option value="' . $row['idRegione'] . '">' . utf8_encode($row['nomeRegione']) . '</option>';
				}
				
			$data['regioni'] = $regioni;
                $this->load->view('ajax/comuni',$data);
	}        
	function selectprov()
	{
            $reg = $this->input->post('id_regione');
            $provincedb = $this->Ajax_model->get_province($reg);
            $province = '<option value="0" class=\"form_control\" id=\"province\">scegli prov ...</option>';
			
				foreach ($provincedb as $row)
				{
					$province .= '<option value="' . $row['id_provincia'] . '" class=\"form_control\" id=\"province\">' . utf8_encode($row['prov_nome']) . '</option>';
				}		
            $data['province'] = $province;
            $this->ajaxlib->output_ajax($data['province']);
	}     

	function selectcom()
	{
            $com = $this->input->post('id_provincia');
            $comunidb = $this->Ajax_model->get_comuni($com);
            $comuni = '<option value="0"  class=\"form_control\" id=\"comuni\">scegli...</option>';
			
				foreach ($comunidb as $row)
				{
					$comuni .= '<option value="' . $row['id_comune'] . '" class=\"form_control\" id=\"comuni\">' . utf8_encode($row['com_nome']) . '</option>';
                                        //$comuni .= "<option value=". $row['Istat'] . '"> class=\"form_control\" id=\"comuni\">' . utf8_encode($row['Comune']) . '</option>';
				}		
            $data['comuni'] = $comuni;
            $this->ajaxlib->output_ajax($data['comuni']);
	}         

        function informazioni() {
        
		$data['regionidb'] = $this->Ajax_model->get_regioni();
                $regioni = "<option value=\"0\" class=\"form_control\" id=\"regioni\">scegli...</option>";
			
				foreach ($data['regionidb'] as $row)
				{
                                    
                                    
                                    $regioni .= "<option value=".$row['id_regione']." class=\"form_control\" id=\"regioni\">".utf8_encode($row['reg_nome'])."</option>
                                            ";
				}
				
			$data['regioni'] = $regioni;
    
           $this->load->library('form_validation');
           
 
            $this->form_validation->set_rules("regioni", "regioni", "required"); 
            $this->form_validation->set_rules("province", "province", "required"); 
            $this->form_validation->set_rules("comuni", "comuni", "required"); 



            if($this->form_validation->run())     
                {
                
                $params = array(
                
                    'dip_nome' => $this->input->post('regione'),
                    'dip_cognome' => $this->input->post('provincia'),
                    'obsoleto' => $this->input->post('comune'),
                    'dip_nomer' => $this->input->post('regioni'),
                    'dip_cognomer' => $this->input->post('province'),
                    'obsoletor' => $this->input->post('comuni'),

                    
                    );
    
        $data['comune'] = $params;
            $this->load->view('prova/prova',$data);
        }
        else
        {
            $this->load->view('ajax/comuni',$data);
        }
    } 
        
        
        
                                }