
function searchFaculty() {
    var FacultyID = document.getElementById('SearchFaculty').value;
    if (FacultyID !== '') {
        window.location.href = 'admin_faculty_details.php?FacultyID=' + FacultyID;
    } else {
        alert('Please enter a valid Faculty ID.');
    }
}

function searchPersonnel() {
    var PersonnelID = document.getElementById('SearchPersonnel').value;
    if (PersonnelID !== '') {
        window.location.href = 'admin_personnel_details.php?PersonnelID=' + PersonnelID;
    } else {
        alert('Please enter a valid Personnel ID.');
    }
}

function searchUser() {
    var PersonnelID = document.getElementById('SearchPersonnel').value;
    if (PersonnelID !== '') {
        window.location.href = 'admin_user_details.php?PersonnelID=' + PersonnelID;
    } else {
        alert('Please enter a valid Personnel ID.');
    }
}
