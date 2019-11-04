let number;

function getNumber(id)
{
    number = id;

    let className = ".comment".concat(number);
    let comment = document.querySelector(className).textContent;
    document.querySelector("#editComment").value = comment;
}

function updateComment()
{
    let className = ".comment".concat(number);

    let comment = document.querySelector("#editComment").value;
    document.querySelector(className).innerHTML = comment;

    //alert("/meme/comment/edit/".concat(number));
    $.ajax({url: "/meme/comment/edit/".concat(number).concat("/").concat(comment)});
    
    document.querySelector(".alert").innerHTML = "<div class='alert alert-success alert-dismissible fade show alert' role='alert'><strong>Comment has been edited!</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
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

function sendComment()
{
    //walidacja
    
    var id = document.querySelector("#send-comment").dataset.id;
    var content = document.querySelector("#comment").value;
    var token = $('meta[name="csrf-token"]').attr('content');
    var userName = document.querySelector("#send-comment").dataset.username;

    $.ajax({

        type:'POST',
        url:"/meme/comment/add/".concat(id),
        dataType: 'JSON',
        data: {
            "_method": 'POST',
            "_token": token,
            "content": content,
        },
        success:function(data){
            console.log('success');
            console.log(data);
            
        },
        error:function(){

        },
    });

    var formattedDate = new Date().toISOString().slice(0,10);

    document.querySelector(".commentsList").insertAdjacentHTML('afterbegin', "<li><div id='comment{{ $comment->id }}' class='w-100 mb-2 mt-3 comment-list'><h4><i class='far fa-user-circle'></i><span class='comment-span'> ".concat(userName).concat("</span></h4><hr class='comment-hr'/><h5 class='mt-3 comment{{$comment->id}}'>".concat(content).concat("</h5><h5 class='mt-3'><i class='far fa-calendar-alt'></i> ").concat(formattedDate).concat("</div></li>")));
    document.querySelector("#comment").value="";
    document.querySelector("#chars").innerHTML="200";
    document.querySelector(".alert").innerHTML = "<div class='alert alert-success alert-dismissible fade show alert' role='alert'><strong>Comment added!</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}


   
