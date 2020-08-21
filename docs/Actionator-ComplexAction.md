Actionator\ComplexAction
===============Class ComplexActionUses for group actions single single complex atomic command
* Class name:ComplexAction
* Namespace:Actionator* This class implements:[Actionator\ActionInterface](Actionator-ActionInterface.md)Properties
----------
###$executedprivate boolean $executed = falseAction executed identifier



* Visibility: **private**
###$actionsprivate array $actionsCollection of stored actions



* Visibility: **private**Methods
-------
###__constructmixed Actionator\ComplexAction::__construct(array $actions)ComplexAction constructor.



* Visibility: **public**#### Arguments*$actions **array**
###execute\Actionator\ActionInterface Actionator\ActionInterface::execute()Execute action



* Visibility: **public*** This method is defined by[Actionator\ActionInterface](Actionator-ActionInterface.md)
###doneboolean Actionator\ActionInterface::done()Returns true if action already executed



* Visibility: **public*** This method is defined by[Actionator\ActionInterface](Actionator-ActionInterface.md)
###resultmixed Actionator\ActionInterface::result(string|callable $format)Result of executed action. Can be prepared for client uses Format class name as first argument.

Format class must implement Actionator\Format\FormatInterface for correct working.

* Visibility: **public*** This method is defined by[Actionator\ActionInterface](Actionator-ActionInterface.md)#### Arguments*$format **string|callable**