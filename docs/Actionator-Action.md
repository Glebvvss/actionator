Actionator\Action
===============Class ActionSingle atomic action (realizaton of "command" GoF pattern), which can be executed once and store inside yourself result of operation
* Class name:Action
* Namespace:Actionator* This is an **abstract** class* This class implements:[Actionator\ActionInterface](Actionator-ActionInterface.md)Properties
----------
###$resultprivate mixed $resultResult of executed action



* Visibility: **private**
###$executedprivate boolean $executed = falseAction executed identifier



* Visibility: **private**Methods
-------
###doneboolean Actionator\ActionInterface::done()Returns true if action already executed



* Visibility: **public*** This method is defined by[Actionator\ActionInterface](Actionator-ActionInterface.md)
###execute\Actionator\ActionInterface Actionator\ActionInterface::execute()Execute action



* Visibility: **public*** This method is defined by[Actionator\ActionInterface](Actionator-ActionInterface.md)
###resultmixed Actionator\ActionInterface::result(string|callable $format)Result of executed action. Can be prepared for client uses Format class name as first argument.

Format class must implement Actionator\Format\FormatInterface for correct working.

* Visibility: **public*** This method is defined by[Actionator\ActionInterface](Actionator-ActionInterface.md)#### Arguments*$format **string|callable**
###isFormatClassboolean Actionator\Action::isFormatClass(string $format)Returns true if provided format class implements Actionator\Format\FormatInterface



* Visibility: **private**#### Arguments*$format **string** -&lt;p&gt;format class name&lt;/p&gt;
###instructionmixed Actionator\Action::instruction()Source code of action, which can be executed. Returns result of operation if needed.



* Visibility: **protected*** This method is **abstract**.