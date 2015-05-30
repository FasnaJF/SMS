/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Validating Empty Field
function check_empty() {
if(document.getElementById('category').value === "" ){
alert("Fill All Fields !");
} else {
document.getElementById('popform').submit();
alert("Form Submitted Successfully...");
}
}

// Validating Empty Field
function check_post_empty() {
if(document.getElementById('topic').value === "" 
    || document.getElementById('details').value === "" 
    || document.getElementById('link').value === "" 
){
alert("Fill All Fields !");
} else {
document.getElementById('popform').submit();
alert("Form Submitted Successfully...");
}
}


//Function To Display Popup
function div_show() {
document.getElementById('abc').style.display = "block";
}


//Function To Check Target Element
function check(e) {
var target = (e && e.target) || (event && event.srcElement);
var obj = document.getElementById('abc');
var obj2 = document.getElementById('popup');
var obj3 = document.getElementById('popupedit');
var close = document.getElementById('close');

//checkParent(target) ? obj.style.display = 'none' : null;
target === close ? obj.style.display = 'none' : null;
target === obj2 ? obj.style.display = 'block' : null;
target === obj3 ? obj.style.display = 'block' : null;

}

/*
//Function To Check Parent Node And Return Result Accordingly
function checkParent(t) {
while (t.parentNode) {
if (t === document.getElementById('abc')) {
    return false;
} else if (t === document.getElementById('close')) {
    return true;
}
    t = t.parentNode;
}
    return true;
}
*/

function changeReadOnly() 
{

	var el = document.getElementById("cat1");
	el.readOnly =false;
        
}

function confirmDelete(){
    var agree = confirm("Are you sure you want to delete this category?");
    if (agree){
         return true;
     }
    else{
         return false;
     }
}

function confirmUpdate(){
    var agree = confirm("Are you sure you want to update this post? ");
    if (agree){
        return true;
    }
    else{
        return false;
    }
}
function confirmUpdateCat(){
    var agree = confirm("Are you sure you want to update this Category? ");
    if (agree){
        return true;
    }
    else{
        return false;
    }
}
