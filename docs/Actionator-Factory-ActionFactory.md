Actionator\Factory\ActionFactory
===============Class ActionFactorySimple action factory implementation
* Class name:ActionFactory
* Namespace:Actionator\Factory* This class implements:[Actionator\Factory\ActionFactoryInterface](Actionator-Factory-ActionFactoryInterface.md)Methods
-------
###make\Actionator\ActionInterface Actionator\Factory\ActionFactoryInterface::make(string $className, array $args)Create new action.



* Visibility: **public*** This method is defined by[Actionator\Factory\ActionFactoryInterface](Actionator-Factory-ActionFactoryInterface.md)#### Arguments*$className **string** -&lt;p&gt;class name of action. Action class must extends from Actionator\Action base abstract class&lt;/p&gt;*$args **array** -&lt;p&gt;dependencies of action, which will provided in constructor of target action&lt;/p&gt;