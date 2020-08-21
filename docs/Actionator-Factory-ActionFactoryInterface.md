Actionator\Factory\ActionFactoryInterface
===============Interface ActionFactoryInterfaceFactory interface for make actions in your code* Interface name:ActionFactoryInterface
* Namespace:Actionator\Factory
* This is an **interface**Methods
-------
###make\Actionator\ActionInterface Actionator\Factory\ActionFactoryInterface::make(string $className, array $args)Create new action.



* Visibility: **public**#### Arguments*$className **string** -&lt;p&gt;class name of action. Action class must extends from Actionator\Action base abstract class&lt;/p&gt;*$args **array** -&lt;p&gt;dependencies of action, which will provided in constructor of target action&lt;/p&gt;