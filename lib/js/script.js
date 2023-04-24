
function hideshow() {
    var frm = document.addForm;
    if (frm.style.display == "block")
    { frm.style.display = "none" }
    else
        if (frm.style.display == "none")
        { frm.style.display = "block" }
}

function addcase() { //this function cleans and display the add case formulary

    //setInterval(getenglst, 90000);
    //setInterval(getenglst2, 90000);
    getenglst();
    getproducts();
    //getenglst2();
    document.addForm.style.display = "block";
    document.modForm.style.display = "none";
    document.delForm.style.display = "none";
    document.misForm.style.display = "none";
    document.addForm.reset();
    document.addForm.casetxt.focus();

    //getUser();

    //getlunch();
    //getexpert();
    //getnoavail();
    setTimeout('document.addForm.style.display="none";', 90000);


}
function modcase() {//this function cleans and display the modify case formulary
    //setInterval(getenglst, 90000);
    //setInterval(getenglst2, 90000);
    //getenglst();
    getenglst2();
    getproducts2();
    document.addForm.style.display = "none";
    document.modForm.style.display = "block";
    document.delForm.style.display = "none";
    document.misForm.style.display = "none";
    document.modForm.casetxt.focus();

    //getUser();
    //getlunch();
    //getexpert();
    //getnoavail();

    setTimeout('document.modForm.style.display="none";', 90000);

}

function delcase() {//this function cleans and display the delete case formulary

    document.addForm.style.display = "none";
    document.modForm.style.display = "none";
    document.delForm.style.display = "block";
    document.misForm.style.display = "none";
    document.delForm.reset();
    document.delForm.casetxt.focus();
    //getUser();
    //getlunch();
    //getexpert();
    //getnoavail();
}
function miscase() {//this function cleans and display the re-route case formulary

    document.addForm.style.display = "none";
    document.modForm.style.display = "none";

    document.delForm.style.display = "none";
    document.misForm.style.display = "block";

    //document.misForm.casetxt.focus();
    //getUser();
    //getlunch();
    //getexpert();
    //getnoavail();
}
function qMonitor() {//this function shows the available Qmonitor
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        AjaxQM = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        AjaxQM = new ActiveXObject("Microsoft.XMLHTTP");
    }

    AjaxQM.open("POST", "include/getQmon.php", true);
    AjaxQM.send();
    AjaxQM.onreadystatechange = function () {
        if (AjaxQM.readyState == 4 && AjaxQM.status == 200) {
            document.getElementById("QMName").innerHTML = AjaxQM.responseText;
            //document.getElementById("box2").innerHTML=xmlhttp.responseText;
        }
    }

}
//----------------------------------
function getUser() {//this function shows the available people
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("POST", "include/getAvailable.php", true);
    //xmlhttp.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2012 00:00:00 GMT");
    xmlhttp.send();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("box1").innerHTML = xmlhttp.responseText;
            //document.getElementById("box2").innerHTML=xmlhttp.responseText;
        }
    }
}
//----------------------------------
function getlunch() {//this function shows the people in lunch
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp2 = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp2.open("POST", "include/getlunch.php", true);
    //xmlhttp2.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2012 00:00:00 GMT");
    xmlhttp2.send();
    xmlhttp2.onreadystatechange = function () {
        if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
            document.getElementById("box2").innerHTML = xmlhttp2.responseText;
            //document.getElementById("box2").innerHTML=xmlhttp.responseText;
        }
    }
}
//----------------------------------
function getexpert() {//this function shows the people with expert role or technical leaders

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttpE = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttpE = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttpE.open("POST", "include/getexpert.php", true);
    xmlhttpE.send();
    xmlhttpE.onreadystatechange = function () {
        if (xmlhttpE.readyState == 4 && xmlhttpE.status == 200) {

            document.getElementById("box3").innerHTML = xmlhttpE.responseText;
            //document.getElementById("box2").innerHTML=xmlhttp.responseText;
        }
    }
}
//----------------------------------
function getnoavail() {//this function shows the people with status of not available, on vacations, or any other exception.

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp4 = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp4 = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp4.open("POST", "include/getnoavail.php", true);
    xmlhttp4.send();
    xmlhttp4.onreadystatechange = function () {
        if (xmlhttp4.readyState == 4 && xmlhttp4.status == 200) {
            document.getElementById("box4").innerHTML = xmlhttp4.responseText;
            //document.getElementById("box2").innerHTML=xmlhttp.responseText;

        }
    }
}

function getenglst() {//this function creates a dropdown menu with all the available engineers for the add form.

    var objeto = document.getElementById("premier");
    if (objeto) {
        objeto = document.getElementById("premier").value;

    }
    else { objeto = 1; }
    var producto = document.getElementById("displayStatus");
    if (producto) {
        producto = document.getElementById("displayStatus").value;

    }
    else { producto = 1; }
    if (objeto != "null") {
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp5 = new XMLHttpRequest();
            ajaxPremier = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            xmlhttp5 = new ActiveXObject("Microsoft.XMLHTTP");
            ajaxPremier = new ActiveXObject("Microsoft.XMLHTTP");
        }


        if (objeto == "No") {

            //--------------------------------
            xmlhttp5.open("GET", "include/getEngineerList.php?producto=" + producto, true);
            xmlhttp5.send();
            xmlhttp5.onreadystatechange = function () {
                if (xmlhttp5.readyState == 4 && xmlhttp5.status == 200) {

                    document.getElementById("addForm61").innerHTML = xmlhttp5.responseText;

                    //document.getElementById("box2").innerHTML=xmlhttp.responseText;*************************************

                }
            }
        }
        else {

            //--------------------------------
            ajaxPremier.open("POST", "include/getPremierList.php?producto=" + producto, true);
            ajaxPremier.send();
            ajaxPremier.onreadystatechange = function () {
                if (ajaxPremier.readyState == 4 && ajaxPremier.status == 200) {

                    document.getElementById("addForm61").innerHTML = ajaxPremier.responseText;

                    //document.getElementById("box2").innerHTML=xmlhttp.responseText;

                }
            }
        }

        //-------------------------
    }
}
function getenglst2() {//this function creates a dropdown menu with all the available engineers for the add form.
    var objeto = document.getElementById("premier2")
    var producto = document.getElementById("displayStatus");
    if (producto) {
        producto = document.getElementById("displayStatus").value;

    }
    else { producto = 1; }
    if (objeto != "null") {
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp0 = new XMLHttpRequest();
            ajaxPremier2 = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            xmlhttp0 = new ActiveXObject("Microsoft.XMLHTTP");
            ajaxPremier2 = new ActiveXObject("Microsoft.XMLHTTP");
        }

        if (document.getElementById("premier2").value == "No") {

            //--------------------------------
            xmlhttp0.open("POST", "include/getEngineerList.php?producto=" + producto, true);
            xmlhttp0.send();
            xmlhttp0.onreadystatechange = function () {
                if (xmlhttp0.readyState == 4 && xmlhttp0.status == 200) {

                    document.getElementById("addForm62").innerHTML = xmlhttp0.responseText;

                    //document.getElementById("box2").innerHTML=xmlhttp.responseText;

                }
            }
        }
        else {

            //--------------------------------
            ajaxPremier2.open("POST", "include/getPremierList.php?producto=" + producto, true);
            ajaxPremier2.send();
            ajaxPremier2.onreadystatechange = function () {
                if (ajaxPremier2.readyState == 4 && ajaxPremier2.status == 200) {

                    document.getElementById("addForm62").innerHTML = ajaxPremier2.responseText;

                    //document.getElementById("box2").innerHTML=xmlhttp.responseText;

                }
            }
        }
        //-------------------------
    }
}
//--------------------------------------------------------------
function getproducts() {//this function shows the people with status of not available, on vacations, or any other exception.

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        ajaxProducts = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        ajaxProducts = new ActiveXObject("Microsoft.XMLHTTP");
    }

    ajaxProducts.open("POST", "include/getProducts.php", true);
    ajaxProducts.send();
    ajaxProducts.onreadystatechange = function () {
        if (ajaxProducts.readyState == 4 && ajaxProducts.status == 200) {
            document.getElementById("product").innerHTML = ajaxProducts.responseText;
            //document.getElementById("box2").innerHTML=xmlhttp.responseText;

        }
    }
    getenglst();
}
function getproducts2() {//this

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        ajaxProducts = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        ajaxProducts = new ActiveXObject("Microsoft.XMLHTTP");
    }

    ajaxProducts.open("POST", "include/getProducts2.php", true);
    ajaxProducts.send();
    ajaxProducts.onreadystatechange = function () {
        if (ajaxProducts.readyState == 4 && ajaxProducts.status == 200) {
            document.getElementById("product2").innerHTML = ajaxProducts.responseText;
            //document.getElementById("box2").innerHTML=xmlhttp.responseText;

        }
    }
    getenglst();
}
//--------------------------------------------------------------
function showUser() //this function is loaded in the index onload() to fill out the information
{
    getUser();
    getlunch();
    //getexpert();
    getnoavail();
    qMonitor();


    setInterval(getUser, 45000);
    setInterval(getlunch, 120000);
    //setInterval(getexpert, 10000);
    setInterval(getnoavail, 120000);

    setInterval(qMonitor, 300000);
    /*showClock();*/
    //setInterval(getenglst, 90000);
    //	setInterval(getenglst2, 90000);
    //getenglst();
    //	getenglst2();

}
//function ShowUsersOnForm



function graphicAv(url) {//
    var Formulario = document.forms['misForm'];
    startdate = Formulario.datepicker3.value
    enddate = Formulario.datepicker4.value
    reportType = Formulario.reportType.value
    if (document.getElementById("reportType").value == "7") {
        engineer = Formulario.engineerlst.value
    }
    else { engineer = 0 }

    /*if (startdate > enddate) {
        alert("Please check the dates");
        return false;
    }*/
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xfecha = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xfecha = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xfecha.open("POST", url + "?startdate=" + startdate + "&enddate=" + enddate + "&reportType=" + reportType + "&engineer=" + engineer, true);
    xfecha.send();
    xfecha.onreadystatechange = function () {
        if (xfecha.readyState == 4 && xfecha.status == 200) {
            document.getElementById("grafico").innerHTML = xfecha.responseText;
            //document.getElementById("box2").innerHTML=xmlhttp.responseText;
        }
    }
}



function newCaseSubmit() {//this function submits the new case

    if (document.addForm.casetxt.value < 999999999) {
        alert("The case number must have at least 10 digits")

    }
    else {

        // var Formulario = document.getElementById("addForm");
        var Formulario = document.forms['addForm'];
        var longitudFormulario = Formulario.elements.length;
        var cadenaFormulario = "";
        var sepCampos;
        sepCampos = "";
        for (var i = 0; i <= Formulario.elements.length - 1; i++) {
            cadenaFormulario += sepCampos + Formulario.elements[i].name + '=' + encodeURI(Formulario.elements[i].value);
            sepCampos = "&";
        }
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            ajaxAddCase = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            ajaxAddCase = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajaxAddCase.open("POST", "include/insertCase.php", true);
        ajaxAddCase.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        //ajaxAddCase.send(null);

        ajaxAddCase.onreadystatechange = function () {
            if (ajaxAddCase.readyState == 4 && ajaxAddCase.status == 200) {
                document.getElementById("messages").innerHTML = ajaxAddCase.responseText;

            }
        }
        /*ajaxAddCase.open("POST","insertCase.php", true);*/
        ajaxAddCase.send(cadenaFormulario);
        getUser();
        getlunch();
        // getexpert();
        getnoavail();
        addcase();
        getenglst();
        getenglst2();
    }
}

function deleteCase() {//this function deletes the case from the DB

    if (document.delForm.casetxt.value < 999999999) {
        alert("The case number must have at least 10 digits")

    }
    else {
        var Formulario = document.forms['delForm'];
        var longitudFormulario = Formulario.elements.length;
        var cadenaFormulario = "";
        var sepCampos;
        sepCampos = "";
        for (var i = 0; i <= Formulario.elements.length - 1; i++) {
            cadenaFormulario += sepCampos + Formulario.elements[i].name + '=' + encodeURI(Formulario.elements[i].value);
            sepCampos = "&";
        }
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            ajaxdelCase = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            ajaxdelCase = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajaxdelCase.open("POST", "include/deleteCase.php", true);
        ajaxdelCase.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        //ajaxAddCase.send(null);

        ajaxdelCase.onreadystatechange = function () {
            if (ajaxdelCase.readyState == 4 && ajaxdelCase.status == 200) {
                //alert("The Case has");
                //responses=ajaxdelCase.responseText;
                //alert(responses);
                document.getElementById("messages").innerHTML = ajaxdelCase.responseText;

            }
        }
        /*ajaxAddCase.open("POST","insertCase.php", true);*/
        ajaxdelCase.send(cadenaFormulario);
        getUser();
        getlunch();
        // getexpert();
        getnoavail();
        delcase();
    }
}

function deleteException() {
    var Formulario = document.forms['delExc'];
    var longitudFormulario = Formulario.elements.length;
    var cadenaFormulario = "";
    var sepCampos;
    sepCampos = "";
    for (var i = 0; i <= Formulario.elements.length - 1; i++) {
        cadenaFormulario += sepCampos + Formulario.elements[i].name + '=' + encodeURI(Formulario.elements[i].value);
        sepCampos = "&";
    }
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        ajaxDelExc = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        ajaxDelExc = new ActiveXObject("Microsoft.XMLHTTP");
    }

    ajaxDelExc.open("POST", "include/delException.php", true);
    ajaxFindCase.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
    //ajaxAddCase.send(null);

    ajaxDelExc.onreadystatechange = function () {
        if (ajaxFindCase.readyState == 4 && ajaxDelExc.status == 200) {
            //alert("The Case has");
            //responses=ajaxdelCase.responseText;
            //alert(responses);
            document.getElementById("info").innerHTML = ajaxDelExc.responseText;

        }
    }
    /*ajaxAddCase.open("POST","insertCase.php", true);*/
    ajaxFindCase.send(cadenaFormulario);

}

function searchCase(Flag) {//this function searches if the case exists

    if (Flag == 1) {
        var Formulario = document.forms['delForm'];
        var textField = document.delForm.casetxt.value;
    }
    if (Flag == 2) {
        var Formulario = document.forms['modForm'];
        var textField = document.modForm.casetxt.value;
    }


    if (textField < 999999999) {
        alert("The case number must have at least 10 digits");
    }
    else {

        var longitudFormulario = Formulario.elements.length;
        var cadenaFormulario = "";
        var sepCampos;
        sepCampos = "";
        for (var i = 0; i <= Formulario.elements.length - 1; i++) {
            cadenaFormulario += sepCampos + Formulario.elements[i].name + '=' + encodeURI(Formulario.elements[i].value);
            sepCampos = "&";
        }
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            ajaxFindCase = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            ajaxFindCase = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajaxFindCase.open("POST", "include/searchCase.php", true);
        ajaxFindCase.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        //ajaxAddCase.send(null);

        ajaxFindCase.onreadystatechange = function () {
            if (ajaxFindCase.readyState == 4 && ajaxFindCase.status == 200) {
                //alert("The Case has");
                //responses=ajaxdelCase.responseText;
                //alert(responses);
                document.getElementById("messages").innerHTML = ajaxFindCase.responseText;

            }
        }
        /*ajaxAddCase.open("POST","insertCase.php", true);*/
        ajaxFindCase.send(cadenaFormulario);
        getUser();
        getlunch();
        // getexpert();
        getnoavail();
        // delcase();
    }
}



function onlyNumbers(evt) { //This function blocks any other carach
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    if (charCode == 13) {
        return false
    }
    return true;

}

function modifyCase() {//this function modify the case with the new data

    if (document.modForm.casetxt.value < 999999999) {
        alert("The case number must have at least 10 digits")

    }
    else {
        var Formulario = document.forms['modForm'];
        var longitudFormulario = Formulario.elements.length;
        var cadenaFormulario = "";
        var sepCampos;
        sepCampos = "";
        for (var i = 0; i <= Formulario.elements.length - 1; i++) {
            cadenaFormulario += sepCampos + Formulario.elements[i].name + '=' + encodeURI(Formulario.elements[i].value);
            sepCampos = "&";
        }
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            ajaxmodCase = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            ajaxmodCase = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajaxmodCase.open("POST", "include/modifyCase.php", true);
        ajaxmodCase.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        //ajaxAddCase.send(null);

        ajaxmodCase.onreadystatechange = function () {
            if (ajaxmodCase.readyState == 4 && ajaxmodCase.status == 200) {
                //alert("The Case has");
                //responses=ajaxdelCase.responseText;
                //alert(responses);
                document.getElementById("messages").innerHTML = ajaxmodCase.responseText;

            }
        }
        /*ajaxAddCase.open("POST","insertCase.php", true);*/
        ajaxmodCase.send(cadenaFormulario);
        getUser();
        getlunch();
        // getexpert();
        getnoavail();
        modcase();
    }
}

////////////////////////  Login Page functions - Start /////////////////////////////////

function getTeamList() {// Get the team list showed in the login page and misrouted form

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp7 = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp7 = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp7.open("POST", "include/getTeamList.php", true);
    xmlhttp7.send();
    xmlhttp7.onreadystatechange = function () {
        if (xmlhttp7.readyState == 4 && xmlhttp7.status == 200) {
            document.getElementById("LoginTeamSelectorCombobox").innerHTML = xmlhttp7.responseText;
            //document.getElementById("box2").innerHTML=xmlhttp.responseText;

        }
    }
}

function onLoadLoginPage() {
    getTeamList();
    //getErrorsLoginPage();
    validError();
    putFocus(username);
}

function putFocus(objectField) {
    objectField.focus();
}
//not in used
function getErrorsLoginPage() {// Get the team list showed in the login page and misrouted form
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        ajaxLoginError = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        ajaxLoginError = new ActiveXObject("Microsoft.XMLHTTP");
    }
    /*var user = encodeURIComponent(document.getElementById("username").value)
    var pass = encodeURIComponent(document.getElementById("passwordTB").value)
    var team = encodeURIComponent(document.getElementById("teamDropmenu").value)
    var params = "username=" + user + "passwordTB="+ pass + "teamDropmenu=" + team;*/

    ajaxLoginError.open("POST", "include/loginCheck.php", true);
    ajaxLoginError.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxLoginError.send();
    ajaxLoginError.onreadystatechange = function () {
        if (ajaxLoginError.readyState == 4 && ajaxLoginError.status == 200) {
            document.loginForm.submit();
        }
        document.getElementById("LoginErrorMessageLabel").innerHTML = ajaxLoginError.responseText;
    }
}

function submitForm() {
    document.loginForm.submit();
}

function validError() {
    if (location.href.match(/(\?|&)error($|&|=)/)) {
        document.getElementById("errorlbl").innerHTML = 'Username or password incorrect';
    } else {
        //document.getElementById("errorlbl").innerHTML = 'The username or password does not match';
    }
}

//not in used
function loginFieldsValidation() {

    if (document.loginForm.username.value == "") { //IF 1
        document.getElementById("errorlbl").innerHTML = 'Username is empty';
        putFocus(username);
        return false;
    } else { // else 1
        if (document.loginForm.passwordTB.value == "") { // IF 2
            document.getElementById("errorlbl").innerHTML = 'Password is empty';
            putFocus(passwordTB);
            return false;
        } else {
            return true;
            //window.location = "include/loginCheck.php";
            //submitForm();
        } return true;

    } //else 1 of the username validation
    return true;

} // end IF 1

function loginValidation() {
    //getErrorsLoginPage();
    if (loginFieldsValidation() == true) {
        document.loginForm.submit();
    }
    putFocus("username");
}


////////////////////////  Login Page functions - end /////////////////////////////////

/////////////////////////   Profile Page  - start //////////////////////////

/*function getUserStatusList(){// Get the status list showed in the profile page.
	
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
ajaxUserStatus=new XMLHttpRequest();
}
else
{// code for IE6, IE5
ajaxUserStatus=new ActiveXObject("Microsoft.XMLHTTP");
}

ajaxUserStatus.open("POST","include/getUserStatus.php",true);
ajaxUserStatus.send();
ajaxUserStatus.onreadystatechange=function()
{
if (ajaxUserStatus.readyState==4 && ajaxUserStatus.status==200)
{
document.getElementById("schTypeList").innerHTML=ajaxUserStatus.responseText;
//document.getElementById("box2").innerHTML=xmlhttp.responseText;

}
}
}*/

/*function getUserProfileUserName(){// Get the status list showed in the profile page.
	
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
ajaxUsername=new XMLHttpRequest();
}
else
{// code for IE6, IE5
ajaxUsername=new ActiveXObject("Microsoft.XMLHTTP");
}

ajaxUsername.open("POST","include/functions.php",true);
ajaxUsername.send();
ajaxUsername.onreadystatechange=test()
{
if (ajaxUsername.readyState==4 && ajaxUsername.status==200)
{
document.getElementById("name").innerHTML=ajaxUsername.responseText;
//document.getElementById("box2").innerHTML=xmlhttp.responseText;

}
}
}*/

function onLoadProfile() {
    qMonitor();
    //showClock();
    //getUserStatusList()
    //getUserProfileUserName();
}

function showClock() {
    x = setTimeout("showClock()", 1000);

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        ajaxClock = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        ajaxClock = new ActiveXObject("Microsoft.XMLHTTP");
    }

    ajaxClock.open("GET", "include/clock.php", true);
    ajaxClock.send();
    ajaxClock.onreadystatechange = function () {
        if (ajaxClock.readyState == 4 && ajaxClock.status == 200) {
            document.getElementById("TimeClock").innerHTML = ajaxClock.responseText;
            //document.getElementById("box2").innerHTML=xmlhttp.responseText;

        }
    }
}

function getSchedule(url, schId) {//this function shows the people with expert role or technical leaders
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp3 = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp3.open("POST", url + "?schtype=" + schId, true);
    xmlhttp3.send();
    xmlhttp3.onreadystatechange = function () {
        if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
            document.getElementById("schedule").innerHTML = xmlhttp3.responseText;
            //document.getElementById("box2").innerHTML=xmlhttp.responseText;
        }
    }
}

////////////////// pROFILE PAGE ///////////
function updateMyProfile() {//update info on my profile

    if (document.MyProfileForm.Name.value == "") {
        alert("The name to display cannot be empty")
    }
    if (document.MyProfileForm.Mail.value == "") {
        alert("The email field cannot be empty")
    }
    if (document.MyProfileForm.Phone.value == "") {
        alert("The phone ext field cannot be empty")
    }
    if (document.MyProfileForm.Bday.value == "") {
        alert("The name to display cannot be empty")
    }

    else {
        var Formulario = document.forms['MyProfileForm'];
        var longitudFormulario = Formulario.elements.length;
        var cadenaFormulario = "";
        var sepCampos;
        sepCampos = "";
        for (var i = 0; i <= Formulario.elements.length - 1; i++) {
            cadenaFormulario += sepCampos + Formulario.elements[i].name + '=' + encodeURI(Formulario.elements[i].value);
            sepCampos = "&";
        }
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            ajaxUpMyProfile = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            ajaxUpMyProfile = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajaxUpMyProfile.open("POST", "include/updateMyProfile.php", true);
        ajaxUpMyProfile.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');

        ajaxUpMyProfile.onreadystatechange = function () {
            if (ajaxdelCase.readyState == 4 && ajaxdelCase.status == 200) {
                document.getElementById("message").innerHTML = ajaxUpMyProfile.responseText;

            }
        }
        ajaxUpMyProfile.send(cadenaFormulario);
    }
}
//------- Maintenance-------

function createUser() {
    document.createUserF.style.display = "block";
    document.modifyUserF.style.display = "none";

}
function modifyUser() {
    getfulllst();
    document.modifyUserF.style.display = "block";
    document.createUserF.style.display = "none";

}

function getfulllst() {//this function creates a dropdown menu with all the available engineers for the add form.

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        ActiveFull = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        ActiveFull = new ActiveXObject("Microsoft.XMLHTTP");
    }

    ActiveFull.open("POST", "include/getActiveList.php", true);
    ActiveFull.send();
    ActiveFull.onreadystatechange = function () {
        if (ActiveFull.readyState == 4 && ActiveFull.status == 200) {

            document.getElementById("usrdrp").innerHTML = ActiveFull.responseText;
            //document.getElementById("box2").innerHTML=xmlhttp.responseText;
        }
    }
}

function fillModUsr() {
    user = document.modifyUserF.engineerlst.value;
    document.modifyUserF.txtUsrName.value = document.modifyUserF.engineerlst.value;
    var w = document.modifyUserF.engineerlst.selectedIndex;
    document.modifyUserF.txtDisplayName.value = document.modifyUserF.engineerlst.options[w].text;

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        rolesAjax = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        rolesAjax = new ActiveXObject("Microsoft.XMLHTTP");
    }

    rolesAjax.open("POST", "include/getActiveListbyUsr.php" + "?user=" + user, true);
    rolesAjax.send();
    rolesAjax.onreadystatechange = function () {
        if (rolesAjax.readyState == 4 && rolesAjax.status == 200) {
            document.getElementById("rolesContentM").innerHTML = rolesAjax.responseText;
            //    document.getElementById("rolesContent").innerHTML=rolesAjax.responseText;

            //document.getElementById("box2").innerHTML=xmlhttp.responseText;
        }
    }

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        ProductsAjax = new XMLHttpRequest();
    }
    else {// code for IE6, IE5
        ProductsAjax = new ActiveXObject("Microsoft.XMLHTTP");
    }

    ProductsAjax.open("POST", "include/getProductsByUsr.php" + "?user=" + user, true);
    ProductsAjax.send();
    ProductsAjax.onreadystatechange = function () {
        if (ProductsAjax.readyState == 4 && ProductsAjax.status == 200) {
            document.getElementById("productsContentM").innerHTML = ProductsAjax.responseText;
            //    document.getElementById("rolesContent").innerHTML=rolesAjax.responseText;

            //document.getElementById("box2").innerHTML=xmlhttp.responseText;
        }
    }

}

function createUser() {//this function deletes the case from the DB

    if (document.delForm.casetxt.value < 999999999) {
        alert("The case number must have at least 10 digits")

    }
    else {
        var Formulario = document.forms['createUserF'];
        var longitudFormulario = Formulario.elements.length;
        var cadenaFormulario = "";
        var sepCampos;
        sepCampos = "";
        for (var i = 0; i <= Formulario.elements.length - 1; i++) {
            cadenaFormulario += sepCampos + Formulario.elements[i].name + '=' + encodeURI(Formulario.elements[i].value);
            sepCampos = "&";
        }
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            ajaxUser = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            ajaxUser = new ActiveXObject("Microsoft.XMLHTTP");
        }

        ajaxUser.open("POST", "include/deleteCase.php", true);
        ajaxUser.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        //ajaxAddCase.send(null);

        ajaxUser.onreadystatechange = function () {
            if (ajaxUser.readyState == 4 && ajaxUser.status == 200) {

                document.getElementById("messages").innerHTML = ajaxUser.responseText;

            }
        }
        /*ajaxAddCase.open("POST","insertCase.php", true);*/
        ajaxUser.send(cadenaFormulario);

    }
}