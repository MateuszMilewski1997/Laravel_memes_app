let number;

function getNumber(id)
{
    number = id;
}

function getRole(id)
{
  element = document.getElementById(id);
  let role = element.getAttribute("data-role");
  element = document.getElementById(role).selected = "true";  
}

function deleteUser()
{
  window.location.href = '/users/delete/'.concat(number);
}
function editRole()
{
  var role = document.querySelector("#exampleFormControlSelect1").value;
  window.location.href = '/users/role/'.concat(number).concat("/").concat(role);    
}
