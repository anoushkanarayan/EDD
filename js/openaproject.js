function checkFunction() {
    var checkbox = document.getElementById("checkbox").checked;

    if(checkbox != true)
    {
        alert('You must agree to the terms to proceed.');
        return false;
    }
    else
    {
        return true;
    }
}

    