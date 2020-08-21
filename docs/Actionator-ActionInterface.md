Actionator\ActionInterface
===============Base interface for actions* Interface name:ActionInterface
* Namespace:Actionator
* This is an **interface**Methods
-------
###execute\Actionator\ActionInterface Actionator\ActionInterface::execute()Execute action



* Visibility: **public**
###doneboolean Actionator\ActionInterface::done()Returns true if action already executed



* Visibility: **public**
###resultmixed Actionator\ActionInterface::result(string|callable $format)Result of executed action. Can be prepared for client uses Format class name as first argument.

Format class must implement Actionator\Format\FormatInterface for correct working.

* Visibility: **public**#### Arguments*$format **string|callable**