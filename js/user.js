var button = document.getElementById("user");
var userBox = document.getElementById("user-box");
var bool = 0;

button.onclick = function() 
{ 
    if(bool == 0)
    {
        open();
    }
    else
    {
        close();
    }
};

function open()
{
    bool = 1;
    userBox.style.visibility = "visible";
}

function close()
{
    bool = 0;
    userBox.style.visibility = "hidden";
}