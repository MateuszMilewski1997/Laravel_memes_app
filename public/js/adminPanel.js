let number;

function getNumber(id)
{
    number = id;
}

function getRole(id)
{
    number = id;
    let iduser = id.toString();
    element = document.getElementById(iduser);
    element.getAttribute("data-role");
    document.getElementById("select-role").value =  element.getAttribute("data-role");
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
