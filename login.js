/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */
function showpw(id)
{
    var x = document.getElementById(id);
    console.log(x);
    if (x.type == "password")
    {
        x.type = "text";
    }
    else
    {
        x.type = "password";
    }

}