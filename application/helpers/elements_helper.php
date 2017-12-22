<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('flash'))
{
    function flash($type, $msg, $bold = '')
    {
    	//type:success, info, warning, danger 
    	if($bold != ''){
    		$bold = '<strong>'.$bold.'!</strong> ';
    	}
        $flash = '<br>
        <div class="alert alert-'.$type.' alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  '.$bold.$msg.'
		</div>
        ';

        $ci=& get_instance();
        $ci->session->set_userdata('flash',$flash);
    }   
}

//Get the page entitlement/access, option = add,edit,view,delete
function isEntitle($option){
    $ci=& get_instance();
    $menuAccess = $ci->session->userdata('menuAccess');
    $method = $ci->uri->segment(1);
    //echo '<pre>'; print_r($menuAccess); die;
    if($menuAccess){
        foreach($menuAccess as $arr){
            $entList = explode(",", $arr['ENTITLEMENT']);
            if($arr['METHOD'] == $method && in_array($option,$entList)){
                return true;
            }
        }
    }
    return false;
}

function setReferer(){
    $ci=& get_instance();
    $referer = $ci->agent->referrer();
    if($referer){
        $arr = explode('/', $referer);
        if($arr[3] != 'login' && $arr[3] != 'register'){
            $ci->session->set_userdata('referer', $referer);
        } else {
            $ci->session->unset_userdata('referer');
        }
    }

}

function setPagination($total, $perPage){
    $ci=& get_instance();
    $ci->load->library('pagination');
    $ci->load->helper('url');

    $totalPages = $total > $perPage ? (($total % $perPage) != 0? (($total - ($total % $perPage)) / $perPage) + 1 : $total / $perPage) : 1;
    $config['base_url'] = base_url($ci->uri->uri_string().'?');
    $config['total_rows'] = $total;
    $config['per_page'] = $perPage;
    $config['page_query_string'] = TRUE;
    $config['enable_query_strings'] = TRUE;
    $config['query_string_segment'] = 'page';
    $config['use_page_numbers'] = TRUE;
    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';
    $config['num_links'] = 7;

    $config['full_tag_open'] = '<nav><ul class="pagination pagination-sm no-margin pull-right">';
    $config['first_tag_open'] = '<li>';
    $config['first_link'] = '<span aria-hidden="true">First</span>';
    $config['first_tag_close'] = '</li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['prev_link'] = '&lt;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';

    $config['next_link'] = '&gt;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';

    $config['last_tag_open'] = '<li>';
    $config['last_link'] = '<span aria-hidden="true">Last ( '.$totalPages.' )</span>';
    $config['last_tag_close'] = '</li>';
    $config['full_tag_close'] = '</ul></nav>';

    $ci->pagination->initialize($config);
    return $ci->pagination->create_links();
}