<?php
namespace Neptune\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use AclManager\AclExtras;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class NeptuneHelper extends Helper {
	public $helpers = ["Form", "Html", "TinyAuth.AuthUser","Js"];
	protected $_user = null;
	
	public function beforeRender(){
		$this->_user = $this->request->Session()->read('Auth');
    }

	public function text($fieldName, $options = array()) {
		$myOptions['error']= array('attributes'=>array('wrap'=>'span', 'class'=>'help-block'));

		if(isset($options['label'])) {
			$myOptions['label'] = array('class'=>'control-label', 'text'=>$options['label']);			
		} else {
			$myOptions['label'] = array('class'=>'control-label');
		}
		if(empty($options['class'])) {
			$myOptions['class'] = 'form-control';				
		}

		if(!empty($options['inline'])) {
			$myOptions['after'] = '<span class="help-block">'.$options['inline'].'</span>';
			unset($options['inline']);
		}
		
		if(isset($options['icon'])) {	
			$options['beforeInput'] = '<div class="input-group"><span class="input-group-addon"><i class="fa fa-'.$options['icon'].'"></i></div>';
			$options['afterInput'] = '</div>';
			unset($options['icon']);
		}
		//debug($this->get('User.id'));
		
		//debug($this->Form->input($fieldName, array_merge($options, $myOptions)));
		return '<div class="form-group">'.$this->Form->input($fieldName, array_merge($options, $myOptions)).'</div>';				
	}
	/*public function inline_text($fieldName, $options = array()) {
		$myOptions['error']= array('attributes'=>array('wrap'=>'span', 'class'=>'help-block'));

		if(isset($options['label'])) {
			$myOptions['label'] = array('class'=>'control-label', 'text'=>$options['label']);			
		} else {
			$myOptions['label'] = array('class'=>'control-label');
		}
		if(empty($options['class'])) {
			$myOptions['class'] = 'form-control';				
		}

		if(!empty($options['inline'])) {
			$myOptions['after'] = '<span class="help-block">'.$options['inline'].'</span>';
			unset($options['inline']);
		}
		
		if(isset($options['icon'])) {	
			$options['beforeInput'] = '<div class="input-group"><span class="input-group-addon"><i class="fa fa-'.$options['icon'].'"></i></div>';
			$options['afterInput'] = '</div>';
			unset($options['icon']);
		}
		//debug($this->Form->input($fieldName, array_merge($options, $myOptions)));
		return $this->Form->input($fieldName, array_merge($options, $myOptions));				
	}*/
	
	public function text_icon($fieldName, $options = []) {
		$error = array('attributes'=>array('wrap'=>'span', 'class'=>'help-block'));
		
		$label='';
		if(isset($options['label'])) {
			$label = '<label>'.$options['label'].'</label>';			
		}
		$myOptions['class'] = 'form-control';
		$myOptions['label'] = false;
		
		if(!empty($options['inline'])) {
			$myOptions['after'] = '<span class="help-block">'.$options['inline'].'</span>';
			unset($options['inline']);
		}
	
		return '<div class="form-group">'.$label.'<div class="input-group"><div class="input-group-addon"><i class="fa fa-'.$options['icon'].'"></i></div>'.$this->Form->input($fieldName,$myOptions).'</div></div>';				
	}
	
	public function inline_text($fieldName, $options = []) {
		//$error = array('attributes'=>array('wrap'=>'span', 'class'=>'help-block'));
		
		$label='';
		/*if(isset($options['label'])) {
			$label = '<label>'.$options['label'].'</label>';			
		}*/
		$myOptions['class'] = 'form-control';
		$myOptions['label'] = false;
	
		return $this->Form->input($fieldName,array_merge($myOptions,$options));				
	}
	
	public function datepicker($field, $options=array()) {
		$options['type']='text';
		$label='';
		/*if(isset($options['label'])) {
			$label = '<label>'.$options['label'].'</label>';			
		}*/
		//$options['label']=false;
		if(isset($options['label'])) {
			$label = $options['label'];			
		} else {
			$label = false;
		}

		$labelOptions = array();
		if(isset($options['required']) && $options['required']) {
			$labelOptions = array('class'=>'required');
		}
		$options['label']=false;
		if(empty($options['class'])) {
			$options['class'] ='form-control mydatepicker';
		} else {
			$options['class'] .= 'form-control mydatepicker';
		}
		
		if(!empty($label)) {
			$output = $this->Form->label($field,$label, $labelOptions);
		} else {
			$output = $this->Form->label($field);
		}
		
		$output .= '<div class="input-group">'.$this->Form->input($field, $options).'<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span></div>';
		
		return $output;
	}

	public function inline_datepicker($field, $options=array()) {
		$options['type']='text';
		$label='';
		$options['label']=false;
		if(empty($options['class'])) {
			$options['class'] ='form-control mydatepicker';
		} else {
			$options['class'] .= 'form-control mydatepicker';
		}
		
		return '<div class="input-group">'.$this->Form->input($field, $options).'<span class="input-group-addon"><i class="fa fa-calendar-o"></i></span></div>';
	}
	
	/*public function datepicker($field) {
		$error = array('attributes'=>array('wrap'=>'span', 'class'=>'help-block'));
		$label='';
		if(isset($options['label'])) {
			$label = '<label>'.$field.'</label>';			
		}
		$myOptions['type'] = 'text';
		$myOptions['class'] = 'form-control datepicker';
		$myOptions['label'] = false;
		return '<div class="form-group">'.$label.'<div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar-o"></i></div>'.$this->Form->input($field,$myOptions).'</div></div>';
	}*/
	
	public function amount($field, $options=array()) {
		$label = '';
		if(!empty($options['label'])) {
			$label = $options['label'];
		}
		$options['label'] = false;
		$options['div']='input-group';
		if(empty($options['class'])) { $options['class'] ='form-control'; }
		$options['type'] ='text';
		$options['before'] = '<span class="input-group-addon"><i class="fa fa-rupee"></i></span>';
		if(!empty($label)) {
			$output = $this->Form->label($field,$label);
		} else {
			$output = $this->Form->label($field);
		}
		$output .= $this->Form->input($field, $options);
		return $output;
	}
	
	
	public function textarea($field, $options = array()) {
		$options['div']='form-group';
		$options['class']='col-sm-12';
		$options['type']="textarea";
		return $this->Form->input($field,$options);
	}

	public function password($field, $options = array()) {
		$options['div']='form-group';
		if(empty($options['class'])) { $options['class'] ='form-control'; }
		$options['type'] ='password';
		return $this->Form->input($field, $options);
	}

	public function select($field, $options = array()) {
		$options['class'] ='form-control';
		$options['type'] ='select';
		
		if(!isset($options['empty'])) { $options['empty'] ='- - -'; }
		return '<div class="form-group">'.$this->Form->input($field, $options).'</div>';
	}
	public function select2($field, $options = array()) {
		$options['class'] ='form-control select2';
		$options['type'] ='select';
		
		if(!isset($options['empty'])) { $options['empty'] ='- - -'; }
		//return '<br/>'.$this->Form->input($field, $options);
		return '<div class="form-group">'.$this->Form->input($field, $options).'</div>';
	}
	
	
	public function multiSelect($field, $options = array()) {
		$options['div']='form-group';
		$options['multiple'] = true;
		$options['class'] ='form-control select2-multiple';
		return $this->Form->input($field, $options);
	}

	public function button($title, $options = array()) {
		$options['class'] = 'btn green btn-sm';
		return $this->Form->button($title, $options);
	}

	public function link($title, $url=null, $options = array()) {
		if($this->AuthUser->hasAccess($url)) {
			return $this->Html->link($title, $url, $options);
		}
	}

	public function checkbox($field, $options = array()) {
		$out = '<br /><br />';
		$out .= '<div class="checkbox">';
		$out .= '<label">';
		$out .= $this->Form->checkbox($field, $options);
		$out .= $options['label'];
		$out .= '</label">';		
		$out .= '</div>';
		return $out;
	}
	
	public function addLink($url=null) {
		$options['class']='btn btn-outline-primary pull-right';
		$options['escape']=false;
		$options['id']='addBtn';
		if($this->AuthUser->hasAccess($url)) {
			return $this->Html->link(__('<span class="fa fa-plus"></span> Add'), $url ,$options);
		}
	}
	
	public function searchButton() {
		return '<a href="#" class="btn default btn-sm" data-target="#searchPanel" data-toggle="collapse" title="Search"><span class="glyphicon glyphicon-search"></span> Search</a>';
	}	

	public function editLink($url=null) {
		$options['class']='btn btn-info btn-sm';
		$options['escape']=false;
		$options['title']='Edit';
		if($this->AuthUser->hasAccess($url)) {
			return $this->Html->link(__('<span class="fa fa-pencil"></span>'), $url ,$options);
		}
	}
	
	public function viewLink($url=null) {
		$options['class']='btn btn-success btn-sm';
		$options['escape']=false;
		$options['title']='View';
		if($this->AuthUser->hasAccess($url)) {
			return $this->Html->link(__('<i class="fa fa-file-o"></i>'), $url ,$options);
		}
	}
	
	public function cancelLink($url=null) {
		$options['class']='btn btn-danger';
		$options['escape']=false;
		$options['type'] = 'button';
		$options['data-popout'] = true;
		//$options['data-toggle'] = 'confirmation';
		//$options['data-original-title'] = 'Are You Sure ?';
		$options['title']= 'Are You Sure ?';
		$options['confirm'] = 'Are you sure you want to Cancel ?';
		if($this->AuthUser->hasAccess($url)) {
			return $this->Html->link('<i class="fa fa-close"></i> Cancel', $url ,$options);
		}
	}
	
	public function backLink($url=null) {
		$options['class']='btn btn-info';
		$options['escape']=false;
		$options['type'] = 'button';
		if($this->AuthUser->hasAccess($url)) {
			return $this->Html->link(__('<i class="fa fa-angle-left"></i> Back'), $url ,$options);
		}
	}

	public function deleteLink($url=null) {
		$options['class']='btn btn-danger btn-sm';
		$options['escape']=false;
		$options['type'] = 'button';
		$options['data-popout'] = true;
		$options['data-toggle'] = 'confirmation';
		$options['confirm'] = __('Are you sure you want to delete?');
		$options['title']= 'Are You Sure ?';
		if($this->AuthUser->hasAccess($url)) {
			return $this->Form->postLink(__('<span class="fa fa-trash"></span>'),$url, $options);
		}
	}
	//<i class="icon-trash"></i>

	public function postLink($title, $url=null, $options) {
		$options['escape']=false;
		if($this->AuthUser->hasAccess($url)) {
			return $this->Form->postLink($title, $url ,$options);
		}
	}

	public function liLink($title, $url=null, $options=null) {
		if(!empty($url['plugin'])) {
			if($this->Acl->check(['Users' => ['id' => $this->get('User.id')]], 'controllers/'.$url['plugin'].'/'.$url['controller'].'/'.$url['action'])) {
				return "<li>".$this->Html->link($title, $url)."</li>";
			}
		} else {
			if($this->Acl->check(['Users' => ['id' => $this->get('User.id')]], 'controllers/'.$url['controller'].'/'.$url['action'])) {
				return "<li>".$this->Html->link($title, $url)."</li>";
			}
		}
		
		if($this->AuthUser->hasAccess($url)) {
			return "<li>".$this->Html->link($title, $url, $options)."</li>";
		}
	}
	
	public function Acl($title,$url) {
		
		//return $this->Acl->check(['Users' => ['id' => $Auth->user('id')]], 'controllers/'.$url['plugin'].'/'.$url['controller'].'/'.$url['action']));
		//debug($this->Acl->check(['Users' => ['id' => $Auth->user('id')]], 'controllers/auth/users/index'));
	} 
	
	/*public function email($field, $options=array()) {
		$label = '';
		if(!empty($options['label'])) {
			$label = $options['label'];
		}
		$options['label'] = false;
		$options['div']=false;
		$options['div']='input-group';
		if(empty($options['class'])) { $options['class'] ='form-control'; }
		$options['type'] ='text';
		$options['before'] = '<div class="input-group-addon"><i class="fa fa-envelope"></i></div>';
		if(!empty($label)) {
			$output = $this->Form->label($field,$label);
		} else {
			$output = $this->Form->label($field);
		}
		$output .= $this->Form->input($field, $options);
		return $output;
	}*/
	public function get($key = null) {
        if( empty($key) ) {
            return $this->_user;
        }
        if( strpos($key, '.') !== false ) {
            list($sessionKey, $field) = explode('.', $key);
            return isset($this->_user[$sessionKey][$field]) ? $this->_user[$sessionKey][$field] : null;
        }
        return null;
    }
}
