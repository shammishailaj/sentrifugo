<?php
/********************************************************************************* 
 *  This file is part of Sentrifugo.
 *  Copyright (C) 2014 Sapplica
 *   
 *  Sentrifugo is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Sentrifugo is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Sentrifugo.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  Sentrifugo Support <support@sentrifugo.com>
 ********************************************************************************/

class Default_Form_Organisationinfo extends Zend_Form
{
	public function init()
	{
	    $this->setMethod('post');		
		$this->setAttrib('id', 'formid');
		$this->setAttrib('enctype', 'multipart/form-data');
		$this->setAttrib('name','organisationinfo');
		$this->setAttrib('action',DOMAIN.'organisationinfo/edit');		

        $id = new Zend_Form_Element_Hidden('id');
		
		$orgname = new Zend_Form_Element_Text('organisationname');
        $orgname->setAttrib('maxLength', 50);
        $orgname->addFilter(new Zend_Filter_StringTrim());
        $orgname->setRequired(true);
        $orgname->addValidator('NotEmpty', false, array('messages' => 'Please enter organization name.'));  
        $orgname->addValidator("regex",true,array(                           
                           'pattern'=>'/^[a-zA-Z0-9.\- ?]+$/',
                           'messages'=>array(
                               
							   'regexNotMatch'=>'Please enter valid organization name.'
                           )
        	));	
		
	    $domain = new Zend_Form_Element_Multiselect('domain');
		
            $domain->setRequired(true);
		
                $domain->addValidator('NotEmpty', false, array('messages' => 'Please select domain.')); 
		$domain->setLabel('domain')
		->setMultiOptions(array(							
							'1'=>'Admin/Secretarial' ,
							'2'=>'Customer Service/ Call Centre/ BPO',
							'3'=> 'Finance & Accounts',
							'4' => 'Human Resources',
							'5' => 'IT',
							'6' => 'Legal',
							'7' => 'Marketing & Communications',
							'8' => 'Purchase/ Logistics/ Supply Chain',
							'9' => 'Sales/ Business Development',
							'10'  => 'Sales & Marketing & Advertisement'
							));
		
		
		$org_image_value = new Zend_Form_Element_Hidden('org_image_value');		
		$imgerr = new Zend_Form_Element_Hidden('imgerr');
		$imgerrmsg = new Zend_Form_Element_Hidden('imgerrmsg');
		
		$orgdescription = new Zend_Form_Element_Textarea('orgdescription');
        $orgdescription->setAttrib('rows', 10);
        $orgdescription->setAttrib('cols', 50);
		$orgdescription->setRequired(true);
        $orgdescription->addValidator('NotEmpty', false, array('messages' => 'Please enter organization description.'));  
		
	   
		$website = new Zend_Form_Element_Text('website');
        $website->setAttrib('maxLength', 50);
        $website->addFilter(new Zend_Filter_StringTrim());
        $website->setRequired(true);
		$website->addValidator('NotEmpty', false, array('messages' => 'Please enter website.'));  		
		$website->addValidator(new Zend_Validate_Uri());
        

		

        $totalemployees = new Zend_Form_Element_Select('totalemployees');
        $totalemployees->setRegisterInArrayValidator(false);
        $totalemployees->setMultiOptions(array(							
							'1'=>'20-50' ,
							'2'=>'51-100',
							'3'=>'101-500',
							'4'=>'501 -1000',
							'5' =>'> 1000'
							));
							
        $totalemployees->setRequired(true);
		$totalemployees->addValidator('NotEmpty', false, array('messages' => 'Please enter total employees.')); 					 
					 
		

        $org_startdate = new ZendX_JQuery_Form_Element_DatePicker('org_startdate');
		$org_startdate->setAttrib('readonly', 'true');
		$org_startdate->setAttrib('onfocus', 'this.blur()');
		$org_startdate->setOptions(array('class' => 'brdr_none'));
         					 
		
		
		$phonenumber = new Zend_Form_Element_Text('phonenumber');
        $phonenumber->addFilter(new Zend_Filter_StringTrim());
        $phonenumber->setRequired(true);
		$phonenumber->setAttrib('maxLength', 15);
        $phonenumber->addValidator('NotEmpty', false, array('messages' => 'Please enter phone number.'));  
		$phonenumber->addValidators(array(array('StringLength',false,
									  array('min' => 10,
											'max' => 15,
											'messages' => array(
											Zend_Validate_StringLength::TOO_LONG =>
											'Phone number must contain at most %max% characters.',
											Zend_Validate_StringLength::TOO_SHORT =>
											'Phone number must contain at least %min% characters.',
											)))));
		$phonenumber->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 'pattern' =>'/^[0-9-]+$/i',
								 'messages' => array(
										 
										 'regexNotMatch'=>'Please enter valid phone number.'
								 )
							 )
						 )
					 )); 		
					 
		$secondaryphone = new Zend_Form_Element_Text('secondaryphone');
		$secondaryphone->setAttrib('maxLength', 15);
        $secondaryphone->addFilter(new Zend_Filter_StringTrim());
		$secondaryphone->addValidators(array(array('StringLength',false,
									  array('min' => 10,
											'max' => 15,
											'messages' => array(
											Zend_Validate_StringLength::TOO_LONG =>
											'Secondary phone number must contain at most %max% characters.',
											Zend_Validate_StringLength::TOO_SHORT =>
											'Secondary phone number must contain at least %min% characters.',
											)))));
		$secondaryphone->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 'pattern' =>'/^[0-9-]+$/i',
								 'messages' => array(
										 
										 'regexNotMatch'=>'Please enter valid phone number.'
								 )
							 )
						 )
					 )); 
       
		
        	
		$faxnumber = new Zend_Form_Element_Text('faxnumber');
        $faxnumber->setAttrib('maxLength', 15);
        $faxnumber->addFilter(new Zend_Filter_StringTrim());
		$faxnumber->addValidators(array(array('StringLength',false,
									  array('min' => 10,
											'max' => 15,
											'messages' => array(
											Zend_Validate_StringLength::TOO_LONG =>
											'Fax number must contain at most %max% characters.',
											Zend_Validate_StringLength::TOO_SHORT =>
											'Fax number must contain at least %min% characters.',
											)))));
		$faxnumber->addValidators(array(
						 array(
							 'validator'   => 'Regex',
							 'breakChainOnFailure' => true,
							 'options'     => array( 
							 'pattern' =>'/^[0-9-]+$/i',
								 'messages' => array(
										 'regexNotMatch'=>'Please enter valid fax number.'
								 )
							 )
						 )
					 )); 
        
		$country = new Zend_Form_Element_Select('country');
        $country->setLabel('country');	
		$country->setRequired(true);
		$country->addValidator('NotEmpty', false, array('messages' => 'Please select country.')); 
		
		$country->setAttrib('onchange', 'displayParticularState(this,"state","state","")');
		    $countryModal = new Default_Model_Countries();
	    	$countriesData = $countryModal->fetchAll('isactive=1','country');
	    $country->addMultiOption('','Select country');
	    	foreach ($countriesData->toArray() as $data){
		$country->addMultiOption($data['country_id_org'],$data['country']);
	    	}
		$country->setRegisterInArrayValidator(false);	
		
		$state = new Zend_Form_Element_Select('state');
        $state->setAttrib('class', 'selectoption');
        $state->setAttrib('onchange', 'displayParticularCity(this,"city","city","")');
        $state->setRegisterInArrayValidator(false);
		$state->addMultiOption('','Select State');
        $state->setRequired(true);
		$state->addValidator('NotEmpty', false, array('messages' => 'Please select state.')); 
		
		$city = new Zend_Form_Element_Select('city');
        $city->setAttrib('class', 'selectoption');
		$city->setAttrib('onchange', 'displayCityCode(this)');
        $city->setRegisterInArrayValidator(false);
        $city->addMultiOption('','Select City');
		$city->setRequired(true);
		$city->addValidator('NotEmpty', false, array('messages' => 'Please select city.'));
		
		$address1 = new Zend_Form_Element_Textarea('address1');
        $address1->setAttrib('rows', 10);
        $address1->setAttrib('cols', 50);
		
        $address1->setRequired(true);
        $address1->addValidator('NotEmpty', false, array('messages' => 'Please enter main branch address.')); 
		
		$address2 = new Zend_Form_Element_Textarea('address2');
        $address2->setAttrib('rows', 10);
        $address2->setAttrib('cols', 50);
		
       
		$address3 = new Zend_Form_Element_Textarea('address3');
        $address3->setAttrib('rows', 10);
        $address3->setAttrib('cols', 50);
		
		
		$description = new Zend_Form_Element_Textarea('description');
        $description->setAttrib('rows', 10);
        $description->setAttrib('cols', 50);
		
		$orghead = new Zend_Form_Element_Select('orghead');
		$orghead->setLabel('orghead');	
		$orghead->setRequired(true);
		$orghead->addValidator('NotEmpty', false, array('messages' => 'Please select organization head.')); 
		$orghead->setAttrib('onchange', 'getdetailsoforghead(this)');	
		$orghead->setRegisterInArrayValidator(false);	
		
		$prevorgheadrm = new Zend_Form_Element_Select('prevorgheadrm');
		$prevorgheadrm->setLabel('orghead');	
		$prevorgheadrm->setRegisterInArrayValidator(false);	
		
		$rmflag = Zend_Controller_Front::getInstance()->getRequest()->getParam('rmflag',null);
		if($rmflag == '1')
		{
			$prevorgheadrm->setRequired(true);
			$prevorgheadrm->addValidator('NotEmpty', false, array('messages' => 'Please select reporting manager for current organization head.')); 		
		}
		
	
			
		$designation = new Zend_Form_Element_Text('designation');
        $designation->setAttrib('maxLength', 50);
        $designation->addFilter(new Zend_Filter_StringTrim());
        
        
		$designation->addValidator("regex",true,array(                           
                           'pattern'=>'/^[a-zA-Z.\- ?]+$/',
                           'messages'=>array(
                              
							   'regexNotMatch'=>'Please enter valid designation.'
                           )
        	));
		
		$employeeId = new Zend_Form_Element_Text("employeeId");
		$employeeId->setRequired("true");
		$employeeId->setLabel("Employee ID");        
		$employeeId->setAttrib("class", "formDataElement");
		$employeeId->setAttrib("readonly", "readonly");
		$employeeId->setAttrib('onfocus', 'this.blur()');		
		$employeeId->addValidator('NotEmpty', false, array('messages' => 'Identity codes are not configured yet.'));
		
		$prefix_id = new Zend_Form_Element_Select('prefix_id');
		$prefix_id->setLabel("Prefix");
		$prefix_id->setRegisterInArrayValidator(false);	
        
		
		$emprole = new Zend_Form_Element_Select("emprole");        
		$emprole->setRegisterInArrayValidator(false);
		$emprole->setRequired(true);		
		$emprole->setLabel("Role");
		$emprole->setAttrib("class", "formDataElement");
		$emprole->addValidator('NotEmpty', false, array('messages' => 'Please select role.'));
		
		$emailaddress = new Zend_Form_Element_Text("emailaddress");
		$emailaddress->setRequired(true);
		$emailaddress->addValidator('NotEmpty', false, array('messages' => 'Please enter email.'));
		
		$emailaddress->addValidator("regex",true,array(
                           
						    'pattern'=>'/^(?!.*\.{2})[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',                            
                           'messages'=>array(
                               'regexNotMatch'=>'Please enter valid email.'
                           )
        	));
		$emailaddress->setLabel("Email");
		$emailaddress->setAttrib("class", "formDataElement");              
		$emailaddress->addValidator(new Zend_Validate_Db_NoRecordExists(
															array('table' => 'main_users',
															'field' => 'emailaddress',
															'exclude'=>'id!="'.Zend_Controller_Front::getInstance()->getRequest()->getParam('orghead',0).'" and isactive!=0',                                                                        					        						
															)));
		$emailaddress->getValidator('Db_NoRecordExists')->setMessage('Email already exists.');
		
		$jobtitle = new Zend_Form_Element_Select('jobtitle_id');
		$jobtitle->setLabel("Job Title");
		$jobtitle->addMultiOption('','Select Job Title');
		$jobtitle->setAttrib('onchange', 'displayPositions(this,"position_id","")');
		$jobtitle->setRegisterInArrayValidator(false);	
        
		
		$position = new Zend_Form_Element_Select('position_id');
		$position->setLabel("Position");
		$position->addMultiOption('','Select Position');
		$position->setRegisterInArrayValidator(false);	
       
		
		$date_of_joining = new ZendX_JQuery_Form_Element_DatePicker('date_of_joining');
        $date_of_joining->setLabel("Date Of Joining");
		$date_of_joining->setOptions(array('class' => 'brdr_none'));	
		$date_of_joining->setRequired(true);
		$date_of_joining->setAttrib('readonly', 'true');
		$date_of_joining->setAttrib('onfocus', 'this.blur()');
        $date_of_joining->addValidator('NotEmpty', false, array('messages' => 'Please select date of joining.'));	
		
        $submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		$submit->setLabel('Save');
		
		
		 $this->addElements(array($id,$prevorgheadrm,$orgname,$imgerrmsg,$imgerr,$org_image_value,$domain,$orgdescription,$website,$totalemployees,$org_startdate,$phonenumber,$secondaryphone,$faxnumber,$country,$state,$city,$address1,$address2,$address3,$description,$orghead,$designation,$employeeId,$prefix_id,$emprole,$emailaddress,$jobtitle,$position,$date_of_joining,$submit));//$email,$secondaryemail,
		 
		 $this->setElementDecorators(array('ViewHelper')); 
		 $this->setElementDecorators(array('File'),array('org_image'));
		 $this->setElementDecorators(array('UiWidgetElement',),array('org_startdate','date_of_joining'));
		 
	}
}