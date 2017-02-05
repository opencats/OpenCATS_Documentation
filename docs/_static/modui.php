/* mymodule/MyModuleUI.php: */
class MyModuleUI extends UserInterface
{
public function __construct()
{
parent::__construct();
$this->_moduleDirectory = ‘mymodule’;
}
public function handleRequest()
{
$action = $this->getAction();
switch ($action)
{
case ‘myAction’:
$this->myAction();
break;
…
}
}
