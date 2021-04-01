public function myAction()
{
…

$this->_template->assign(‘myVariable’, $myValue);
$this->_template->display(‘./modules/mymodule/MyTemplate.tpl’);
}
