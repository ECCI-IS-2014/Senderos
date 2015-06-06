<?php
class Language extends AppModel
{
    var $name = 'Language';
    var $displayField = 'name';
    var $validate = array('code' => array('notempty' => array('rule' => array('notempty'),),),
                          'name' => array('notempty' => array('rule' => array('notempty'),),),);
    
    public $hasMany = array('DocumentsLanguage');	//agregué esta línea
}
