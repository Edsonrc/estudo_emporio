function doPost(actionName)
{
var hiddenControl = document.getElementById('action');

hiddenControl.value = actionName;
actionName.submit();
}


