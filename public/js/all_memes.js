let number;

function getNumber(id)
{
    number = id;
}

function changeStatus()
{
    let name = "mem".concat(number);
    document.getElementById(name).style.display = "none";
    $.ajax({url: '/meme/del/waiting/'.concat(number)});
    document.querySelector(".alert").innerHTML = "<div class='alert alert-success alert-dismissible fade show alert' role='alert'><strong>Status changed!</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}

function deleteMem()
{
    let name = "mem".concat(number);
    document.getElementById(name).style.display = "none";
    $.ajax({url: '/meme/delete/'.concat(number)});
    document.querySelector(".alert").innerHTML = "<div class='alert alert-success alert-dismissible fade show alert' role='alert'><strong>Mem has been delete!</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}

function like(meme_id)
{
    
    document.querySelector(".like".concat(meme_id)).disabled = true;
    document.querySelector(".notLike".concat(meme_id)).disabled = true;
        
    let number_like = meme_id.toString();
    let class_like = "meme".concat(number_like);
    let content = document.querySelector(".".concat(class_like)).innerHTML;
    let insert = parseInt(content, 10);
    insert = insert + 1;
    let text = insert.toString();
    document.querySelector(".".concat(class_like)).innerHTML = text;

    $.ajax({
        url: "/meme/like/".concat(number_like),
        type: "GET",
    });
   
}

function dislike(meme_id)
{
    document.querySelector(".like".concat(meme_id)).disabled = true;
    document.querySelector(".notLike".concat(meme_id)).disabled = true;
    
    let number_like = meme_id.toString();
    let class_like = "dislike".concat(number_like);
    let content = document.querySelector(".".concat(class_like)).innerHTML;
    let insert = parseInt(content, 10);
    insert = insert + 1;
    let text = insert.toString();
    document.querySelector(".".concat(class_like)).innerHTML = text;

    $.ajax({
        url: "/meme/dislike/".concat(number_like),
        type: "GET",
    });
}

