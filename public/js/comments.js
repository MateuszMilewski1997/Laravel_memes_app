let number;

/*window.onload = function() 
{
        if(document.querySelector(".back"))
        {
            window.history.back();
        }
        
};*/

function comment()
{
    alert("");
}

function getNumber(id)
{
    number = id;

    let className = ".comment".concat(number);
    let comment = document.querySelector(className).textContent;
    document.querySelector("#editComment").value = comment;
}

function delete_comment()
{
    let name = "comment".concat(number);
    document.getElementById(name).style.display = "none";
    $.ajax({url: '/meme/comments/delete/'.concat(number)});
    document.querySelector(".alert").innerHTML = "<div class='alert alert-success alert-dismissible fade show alert' role='alert'><strong>Comment has been delete!</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

}

function handle(e){
                
        let content = document.getElementById("comment").value;
        console.log(200 - content.length);
        document.getElementById('chars').innerText = 200 - content.length;

        if(e.keyCode === 13){
            e.preventDefault(); 
            document.getElementById("send-comment").click();
        }
}

